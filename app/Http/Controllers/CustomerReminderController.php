<?php
namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerLog;
use App\Models\CustomerReminder;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerReminderController extends Controller
{
    public function add_reminder(Request $request)
    {
        $customer = Customer::whereId($request->customer_id)->first();
        $request->validate([
            'customer_id' => 'required',
            'reminder_at' => 'required',
        ]);
        DB::beginTransaction();
        try {
            CustomerReminder::create([
                'customer_id' => $request->customer_id,
                'user_id'     => auth()->id(),
                'note'        => $request->note,
                'reminder_at' => $request->reminder_at,
            ]);
            CustomerLog::create([
                'customer_id' => $request->customer_id,
                'date'        => today(),
                'time'        => now(),
                'activity'    => 'add_reminder',
                'notes'       => $request->note,
                'user_id'     => auth()->id(),
            ]);
            Toastr::success(translate('added_successfully'));
            DB::commit();
            return back()->with('success', translate('added_successfully'));
        } catch (Exception $ex) {
            DB::rollBack();
            return back()->with('error', $ex->getMessage());
        }
    }

    public function index(Request $request)
    {
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
      
            
        $reminders = CustomerReminder::with('customer')
            ->where('user_id', auth()->id())
            ->whereDate('reminder_at', now()->toDateString())
            ->where('notified', false)
            ->orderBy('reminder_at')
            ->latest()->paginate()->appends($query_param);

        return view('admin-views.reminders.index', compact('reminders'));
    }

    public function markAsDone($id)
    {
        $reminder = CustomerReminder::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $reminder->update(['notified' => true]);

        return back()->with('success', translate('reminder_closed'));
    }
}
