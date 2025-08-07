<?php
namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Schedule;
use App\Models\CustomerLog;
use Illuminate\Http\Request;
use App\Models\CustomerReminder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Brian2694\Toastr\Facades\Toastr;

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


    public function customer_logs($id)
    {
        $query_param = '';

        $logs = CustomerLog::where('customer_id', $id)->with('employee:id,name', 'main_user:id,name', 'customer:id,name')->latest()->paginate()->appends($query_param);

        return view('admin-views.crm.customers.logs', compact('logs'));
    }
    public function add_customer_log(Request $request)
    {
        $request->validate([
            'customer_id_add_action' => 'required',
            'activity'               => 'required',
        ]);

        try {
            CustomerLog::create([
                'customer_id' => $request->customer_id_add_action,
                'date'        => today(),
                'time'        => now(),
                'activity'    => $request->activity,
                'notes'       => $request->note,
                'user_id'     => auth()->id(),
                'employee_id' => auth()->id(),
            ]);
            Toastr::success(translate('added_successfully'));
            return back()->with('success', translate('added_successfully'));
        } catch (Exception $ex) {
            return back()->with('error', $ex->getMessage());
        }
    }

    public function booking_status(Request $request)
    {
        // dd($request->all());
        $customer = Customer::findOrFail($request->customer_id_change_status);

        $request->validate([
            'booking_status'            => 'required',
            'customer_id_change_status' => 'required',
        ]);
        DB::beginTransaction();
        try {
            if ($request->booking_status == 'agreement') {
                $request->validate([
                    'booking_status'            => 'required',
                    'customer_id_change_status' => 'required',
                    'unit_price'                => 'required',
                    'advance_payment'           => 'required',
                    'years_count'               => 'required',
                ]);

                $customer->update([
                    'booking_status'                             => $request->booking_status,
                    'price'                                      => $request->unit_price,
                    'deposite'                                   => $request->deposite,
                    'advance_payment'                            => $request->advance_payment,
                    'quarterly_installments_start_from_the_date' => $request->quarterly_installments_start_from_the_date,
                ]);
                $customer->unit->update([
                    'booking_status'                             => $request->booking_status,
                    'price'                                      => $request->unit_price,
                    'deposite'                                   => $request->deposite,
                    'advance_payment'                            => $request->advance_payment,
                    'quarterly_installments_start_from_the_date' => $request->quarterly_installments_start_from_the_date,
                ]);
                $installment_count = (int) ($request->years_count * 4);
                $installment_value = ($request->unit_price - ($request->advance_payment + $request->deposite)) / $installment_count;
                $date              = Carbon::parse($request->quarterly_installments_start_from_the_date);
                
                for ($i = 1; $i <= $installment_count; $i++) {
                    Schedule::create([
                        'customer_id' => $request->customer_id_change_status,
                        'date'        => $date->copy()->addMonths(3 * ($i - 1)),
                        'value'       => $installment_value,
                        'status'      => null,
                    ]);
                }

            } elseif ($request->booking_status == 'booking') {
                $customer->update([
                    'booking_status'                             => $request->booking_status,
                    'price'                                      => $request->unit_price,
                    'deposite'                                   => $request->deposite,
                    'advance_payment'                            => $request->advance_payment,
                    'quarterly_installments_start_from_the_date' => $request->quarterly_installments_start_from_the_date,
                ]);
                $customer->unit->update([
                    'booking_status'                             => $request->booking_status,
                    'price'                                      => $request->unit_price,
                    'deposite'                                   => $request->deposite,
                    'advance_payment'                            => $request->advance_payment,
                    'quarterly_installments_start_from_the_date' => $request->quarterly_installments_start_from_the_date,
                ]);
            } else {
                $customer->update([
                    'booking_status' => $request->booking_status,
                ]);
                $customer->unit->update([
                    'booking_status' => $request->booking_status,
                ]);
            }

            Toastr::success(translate('updated_successfully'));
            DB::commit();
            return back()->with('success', translate('updated_successfully'));
        } catch (Exception $ex) {
            DB::rollBack();
            return back()->with('error', $ex->getMessage())->withInput();
        }

    }
}
