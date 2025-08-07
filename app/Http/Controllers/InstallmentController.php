<?php
namespace App\Http\Controllers;

use App\Models\Schedule;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InstallmentController extends Controller
{
    public function list(Request $request)
    {

        $search       = $request['search'];
        $query_param  = $search ? ['search' => $request['search']] : '';
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth   = Carbon::now()->endOfMonth();
        $installments = Schedule::when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            $q->whereHas('customer', function ($query) use ($key) {
                foreach ($key as $value) {
                    $query->where('name', 'like', "%{$value}%");
                }
            });
        })->whereNull('status')
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->latest()
            ->paginate()
            ->appends($query_param);
        $data = [
            'installments' => $installments,
            'search'       => $search,

        ];
        return view("admin-views.crm.installments.installments", $data);
    }
    public function installments($id)
    {
        $query_param = '';

        $installments = Schedule::where('customer_id', $id)->with('customer:id,name,phone')->latest()->paginate()->appends($query_param);

        return view('admin-views.crm.installments.installments', compact('installments'));
    }
    public function accept_installment($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->update([
            'status' => 1,
        ]);
        Toastr::success(translate('paid_successfully'));
        return back()->with('success', translate('paid_successfully'));
    }
}
