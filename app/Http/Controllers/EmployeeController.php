<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Services\EmployeeServices;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public $employee_services;
    public $model;
    public function __construct(EmployeeServices $employee_services)
    {
        $this->employee_services = $employee_services;
    }
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
        $employee    = User::when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);

        $data = [
            'main'        => $employee,
            'search'      => $search,
            'route'       => 'employee',
            'description' => 'no',
            'department'  => 'no',
            'code_status' => 'no',

        ];
        return view("admin-views.team.employee.index", $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'               => 'required|string',
            'code'               => 'required',
            'mobile_dail_code'   => 'required',
            'office_dail_code'   => 'required',
            'whatsapp_dail_code' => 'required',
            'mobile'             => 'required',
            'office'             => 'required',
            'whatsapp'           => 'required',
            'extension_no'       => 'required',
            'department_id'      => 'required',
            'employee_type_id'   => 'required',

        ]);
        $employee = DB::table('employees')->insert([
            'name'               => $request->name,
            'code'               => $request->code,
            'email'              => $request->email,
            'username'           => $request->username,
            'myname'             => $request->password,
            'password'           => Hash::make($request->password),
            'status'             => $request->status,
            'mobile_dail_code'   => $request->mobile_dail_code,
            'office_dail_code'   => $request->office_dail_code,
            'whatsapp_dail_code' => $request->whatsapp_dail_code,
            'mobile'             => $request->mobile,
            'office'             => $request->office,
            'whatsapp'           => $request->whatsapp,
            'extension_no'       => $request->extension_no,
            'department_id'      => $request->department_id,
            'employee_type_id'   => $request->employee_type_id,

        ]);
        Toastr::success('added_successfully');

        return to_route('employee.index')->with('success', translate('added_successfully'));
    }
    public function create()
    {
        $departments    = Team::get();

        $data = [
            "departments"    => $departments,
        ];
        return view("admin-views.team.employee.create", $data);
    }
    public function edit($id)
    {

        $employee       = DB::table('employees')->find($id);
        $departments    = DB::table('departments')->get();
        $employee_types = DB::table('employee_types')->get();

        $data = [
            "departments"    => $departments,
            'employee_types' => $employee_types,
            'employee'       => $employee,
            'department'     => 'no',

        ];
        return view("admin-views.team.employee.edit", $data);
    }
    public function update(Request $request, $id)
    {
        $old_employee = DB::table('employees')->where('id', $id)->first();
        DB::table('employees')
            ->where('id', $id)
            ->update([
                'name'               => (isset($request->name) && ! empty($request->name)) ? $request->name : $old_employee->name,
                'code'               => (isset($request->code) && ! empty($request->code)) ? $request->code : $old_employee->code,
                'username'           => (isset($request->username) && ! empty($request->username)) ? $request->username : $old_employee->username,
                'email'              => (isset($request->email) && ! empty($request->email)) ? $request->email : $old_employee->email,
                'myname'             => (isset($request->password) && ! empty($request->password)) ? $request->password : $old_employee->myname,
                'password'           => $request->filled('password') ? Hash::make($request->password) : $old_employee->password,
                'status'             => (isset($request->status) && ! empty($request->status)) ? $request->status : $old_employee->status,
                'mobile_dail_code'   => (isset($request->mobile_dail_code) && ! empty($request->mobile_dail_code)) ? $request->mobile_dail_code : $old_employee->mobile_dail_code,
                'office_dail_code'   => (isset($request->office_dail_code) && ! empty($request->office_dail_code)) ? $request->office_dail_code : $old_employee->office_dail_code,
                'whatsapp_dail_code' => (isset($request->whatsapp_dail_code) && ! empty($request->whatsapp_dail_code)) ? $request->whatsapp_dail_code : $old_employee->whatsapp_dail_code,
                'mobile'             => (isset($request->mobile) && ! empty($request->mobile)) ? $request->mobile : $old_employee->mobile,
                'office'             => (isset($request->office) && ! empty($request->office)) ? $request->office : $old_employee->office,
                'whatsapp'           => (isset($request->whatsapp) && ! empty($request->whatsapp)) ? $request->whatsapp : $old_employee->whatsapp,
                'extension_no'       => (isset($request->extension_no) && ! empty($request->extension_no)) ? $request->extension_no : $old_employee->extension_no,
                'department_id'      => (isset($request->department_id) && ! empty($request->department_id)) ? $request->department_id : $old_employee->department_id,
                'employee_type_id'   => (isset($request->employee_type_id) && ! empty($request->employee_type_id)) ? $request->employee_type_id : $old_employee->employee_type_id,
            ]);
        Toastr::success('updated_successfully');

        return to_route('employee.index')->with('success', translate('added_successfully'));
    }
    public function delete(Request $request)
    {
        $employee = Employee::find($request->id);
        if ($employee) {
            $employee->delete();
        }
        return redirect()->route("employee.index")->with("success", translate('deleted_successfully'));
    }

    public function statusUpdate(Request $request)
    {
        // $this->authorize('edit_subscription');
        $employee = User::findOrFail($request->id);
        $employee->update([
            'status' => ($request->status == 1) ? '1' : '0',
        ]);
        Toastr::success(translate('status_changed_successfully'));
        
        return redirect()->back()->with('success', translate('updated_successfully'));
    }
}
