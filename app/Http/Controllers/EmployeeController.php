<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Services\EmployeeServices;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\AdminRole;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
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
        // dd($request->all());
        $request->validate([
            'name'                  => 'required|string',
            'username'              => 'required|unique:users,username',
            'email'                 => 'nullable|unique:users,email',
            'password'              => 'required|min:5',
            'role_id'               => 'required',


        ]);
        try {
            $employee = DB::table('users')->insert([
                'name'               => $request->name,
                'username'           => $request->username,
                'role_id'            => $request->role_id,
                'password'           => Hash::make($request->password),
                'email'              => $request->email,
                'phone'              => $request->phone,
                'my_name'             => $request->password,
                'team_id'            => $request->team_id,
                'created_at'         => now(),
            ]);
            Toastr::success(translate('added_successfully'));
            return to_route('employee.index')->with('success', translate('added_successfully'));
        } catch (Exception $ex) {
            return back()->with('error', $ex->getMessage())->withInput();
        }
    }
    public function create()
    {
        $departments    = Team::get();
        $roles          = AdminRole::get();
        $data = [
            "departments"       => $departments,
            "roles"             => $roles,
        ];
        return view("admin-views.team.employee.create", $data);
    }
    public function edit($id)
    {

        $employee       = User::findOrFail($id);
        $departments    = Team::get();
        $roles          = AdminRole::get();

        $data = [
            "departments"           => $departments,
            "roles"                 => $roles,
            "employee"              => $employee,
        ];
        return view("admin-views.team.employee.edit", $data);
    }
    public function update(Request $request, $id)
    {
        $employee = User::findOrFail($id);
        $request->validate([
            'name'                  => 'required|string',
            'username'              => 'required',
            'email'                 => 'nullable|unique:users,email',
            'password'              => 'required|min:5',
            'role_id'               => 'required',


        ]);
        try {
            $employee->update([
                'name'               => $request->name,
                'username'           => $request->username,
                'role_id'            => $request->role_id,
                'password'           => Hash::make($request->password),
                'email'              => $request->email,
                'phone'              => $request->phone,
                'my_name'            => $request->password,
                'team_id'            => $request->team_id,
                'created_at'         => now(),
            ]);
        Toastr::success(translate('updated_successfully'));
            return to_route('employee.index')->with('success', translate('updated_successfully'));
        } catch (Exception $ex) {
            return back()->with('error', $ex->getMessage())->withInput();
        }
 
    }
    public function delete(Request $request)
    {
        $employee = User::find($request->id);
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
