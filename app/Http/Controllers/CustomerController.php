<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Team;
use App\Models\User;
use App\Models\Floor;
use App\Models\Project;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\CustomerLog;
use Illuminate\Http\Request;
use App\Models\UnitManagement;
use App\Models\FloorManagement;
use App\Imports\CustomersImport;
use App\Models\CustomerReminder;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        // $this->authorize('complaints');
        // $ids = $request->bulk_ids;
        // if ($request->bulk_action_btn === 'update_status'  && is_array($ids) && count($ids)) {
        //     $data = ['status' => 1, 'worker' => $request->worker];
        //     Employee::whereIn('id', $ids)->update($data);
        //     return back()->with('success', translate('general.updated_successfully'));
        // }
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        if (auth()->check()) {
            $user = auth()->user();
            if ($user->role_id == 2) {
                $customers = Customer::when($request['search'], function ($q) use ($request) {
                    $key = explode(' ', $request['search']);
                    foreach ($key as $value) {
                        $q->Where('name', 'like', "%{$value}%")
                            ->orWhere('id', $value);
                    }
                })->where('assign_to_team', $user->team_id)->where('booking_status', '!=', 'agreement')
                    ->latest()->paginate()->appends($query_param);
            } elseif ($user->role_id == 3) {
                $customers = Customer::when($request['search'], function ($q) use ($request) {
                    $key = explode(' ', $request['search']);
                    foreach ($key as $value) {
                        $q->Where('name', 'like', "%{$value}%")
                            ->orWhere('id', $value);
                    }
                })->where('assign_to', $user->id)->where('booking_status', '!=', 'agreement')
                    ->whereDate('assign_date', '>=', Carbon::now()->subDays(14))
                    ->latest()->paginate()->appends($query_param);
            } elseif ($user->role_id == 1) {
                $customers = Customer::when($request['search'], function ($q) use ($request) {
                    $key = explode(' ', $request['search']);
                    foreach ($key as $value) {
                        $q->Where('name', 'like', "%{$value}%")
                            ->orWhere('id', $value);
                    }
                })->where(function ($q) {
                    $q->whereDate('assign_date', '<=', Carbon::now()->subDays(14))
                        ->orWhereNull('assign_date')
                        ->orWhere('booking_status', 'booking')
                        ->orWhere('booking_status', 'agreement');
                })
                    // ->whereDate('assign_date', '<=', Carbon::now()->subDays(14))->orWhere('assign_date' , null)->orWhere('booking_status' , 'agreement')
                    ->latest()->paginate()->appends($query_param);
            }
        }
        $teams = Team::select('id', 'name')->get();
        $data  = [
            'main'   => $customers,
            'search' => $search,
            'teams'  => $teams,
            'route'  => 'customers',

        ];
        return view("admin-views.crm.customers.list", $data);
    }
    public function create()
    {
        $projects = Project::select('id', 'name')->get();
        $teams    = Team::select('id', 'name')->get();

        $data = [
            "projects" => $projects,
            'teams'    => $teams,

        ];
        return view("admin-views.crm.customers.create", $data);
    }
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        $projects = Project::select('id', 'name')->get();
        $teams    = Team::select('id', 'name')->get();

        $floors = FloorManagement::select('id', 'floor_id', 'project_id')->where('project_id', $customer->project_id)->get();
        $units  = UnitManagement::select('id', 'floor_management_id', 'name', 'project_id')->where('floor_management_id', $customer->floor_id)->get();

        $data = [
            "customer" => $customer,
            "projects" => $projects,
            "teams"    => $teams,
            "floors"  => $floors,
            "units"   => $units,
        ];

        return view("admin-views.crm.customers.edit", $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'phone'      => 'required|string|max:20|unique:customers,phone',
            'email'      => 'nullable|email|max:255',
            'job'        => 'nullable|string|max:255',
            'project_id' => 'nullable|exists:projects,id',
            'floor_id'   => 'nullable',
            'unit_id'    => 'nullable',
            'budget'     => 'nullable|numeric',
        ]);
        DB::beginTransaction();
        try {
            $customer = Customer::create([
                'name'           => $request->name,
                'phone'          => $request->phone,
                'email'          => $request->email,
                'job'            => $request->job,
                'project_id'     => $request->project_id,
                'floor_id'       => $request->floor_id,
                'unit_id'        => $request->unit_id,
                'budget'         => $request->budget,
                'added_by'       => auth()->id(),
                'assign_to'      => $request->employee_id ?? null,
                'assign_to_team' => $request->team_id ?? null,
                'assign_date'    => now(),
            ]);
            if ($request->assign_note) {
                CustomerLog::create([
                    'customer_id' => $customer->id,
                    'date'        => today(),
                    'time'        => now(),
                    'activity'    => 'assign to',
                    'notes'       => $request->assign_note,
                    'user_id'     => auth()->id(),
                ]);
            }
            if ($request->reminder_at) {
                CustomerReminder::create([
                    'customer_id' => $customer->id,
                    'user_id'     => auth()->id(),
                    'note'        => $request->reminder_note,
                    'reminder_at' => $request->reminder_at,
                ]);
                CustomerLog::create([
                    'customer_id' => $customer->id,
                    'date'        => today(),
                    'time'        => now(),
                    'activity'    => 'add_reminder',
                    'notes'       => $request->reminder_note,
                    'user_id'     => auth()->id(),
                ]);
            }
            Toastr::success(translate('added_successfully'));
            DB::commit();
            return to_route('customer.index')->with('success', translate('added_successfully'));
        } catch (Exception $ex) {
            DB::rollBack();
            return back()->with('error', $ex->getMessage())->withInput();
        }
    }
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'phone'      => 'required|string|max:20|unique:customers,phone,' . $customer->id,
            'email'      => 'nullable|email|max:255',
            'job'        => 'nullable|string|max:255',
            'project_id' => 'nullable|exists:projects,id',
            'floor_id'   => 'nullable',
            'unit_id'    => 'nullable',
            'budget'     => 'nullable|numeric',
        ]);

        DB::beginTransaction();
        try {
            // تحديث بيانات العميل
            $customer->update([
                'name'           => $request->name,
                'phone'          => $request->phone,
                'email'          => $request->email,
                'job'            => $request->job,
                'project_id'     => $request->project_id,
                'floor_id'       => $request->floor_id,
                'unit_id'        => $request->unit_id,
                'budget'         => $request->budget,
                'assign_to'      => $request->employee_id ?? $customer->assign_to,
                'assign_to_team' => $request->team_id ?? $customer->assign_to_team,
            ]);

            if ($request->assign_note) {
                CustomerLog::create([
                    'customer_id' => $customer->id,
                    'date'        => today(),
                    'time'        => now(),
                    'activity'    => 'assign to',
                    'notes'       => $request->assign_note,
                    'user_id'     => auth()->id(),
                ]);
            }

            if ($request->reminder_at) {
                CustomerReminder::create([
                    'customer_id' => $customer->id,
                    'user_id'     => auth()->id(),
                    'note'        => $request->reminder_note,
                    'reminder_at' => $request->reminder_at,
                ]);
                CustomerLog::create([
                    'customer_id' => $customer->id,
                    'date'        => today(),
                    'time'        => now(),
                    'activity'    => 'add_reminder',
                    'notes'       => $request->reminder_note,
                    'user_id'     => auth()->id(),
                ]);
            }

            DB::commit();
            Toastr::success(translate('updated_successfully'));
            return to_route('customer.index')->with('success', translate('updated_successfully'));
        } catch (Exception $ex) {
            DB::rollBack();
            return back()->with('error', $ex->getMessage())->withInput();
        }
    }

    public function assign_to(Request $request)
    {
        $customer = Customer::findOrFail($request->customer_id_assign_to);
        $request->validate([
            'team_id'     => 'required',
            'employee_id' => 'required',
        ]);
        DB::beginTransaction();

        try {
            $customer->update([
                'assign_to_team' => $request->team_id,
                'assign_to'      => $request->employee_id,
                'assign_date'    => now(),
            ]);
            CustomerLog::create([
                'customer_id' => $request->customer_id_assign_to,
                'date'        => today(),
                'time'        => now(),
                'activity'    => 'assign to',
                'notes'       => $request->note,
                'user_id'     => auth()->id(),
            ]);
            Toastr::success(translate('assigned_successfully'));
            DB::commit();
            return back()->with('success', translate('added_successfully'));
        } catch (Exception $ex) {
            DB::rollBack();
            return back()->with('error', $ex->getMessage());
        }
    }

    public function get_floors_by_project($id)
    {
        $floors = FloorManagement::where('project_id', $id)->with('floor_main')->get();

        return response()->json([
            'success' => true,
            'floors'  => $floors,
        ]);
    }

    public function get_employee_by_team_id($id)
    {
        $employees = User::where('team_id', $id)->get();

        return response()->json([
            'success'   => true,
            'employees' => $employees,
        ]);
    }
    public function get_unit_by_floor($id)
    {
        $units = UnitManagement::where('floor_management_id', $id)->get();

        return response()->json([
            'success' => true,
            'units'   => $units,
        ]);
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls'
        ]);

        Excel::import(new CustomersImport, $request->file('file'));

        return redirect()->back()->with('success', translate('imported_successfully'));
    }

    public function delete(Request $request)
    {
        $id = $request->id;

        DB::beginTransaction();
        try {
            $customer = Customer::findOrFail($id);
            CustomerReminder::where('customer_id', $customer->id)->delete();
            CustomerLog::where('customer_id', $customer->id)->delete();

            $customer->delete();

            DB::commit();
            Toastr::success(translate('deleted_successfully'));
            return back()->with('success', translate('deleted_successfully'));
        } catch (Exception $ex) {
            DB::rollBack();
            return back()->with('error', $ex->getMessage());
        }
    }
}
