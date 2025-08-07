<?php
namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\FloorManagement;
use App\Models\Project;
use App\Models\UnitManagement;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;

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
        $customers   = Customer::when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);

        $data = [
            'main'   => $customers,
            'search' => $search,
            'route'  => 'customers',

        ];
        return view("admin-views.crm.customers.list", $data);
    }
    public function create()
    {
        $projects = Project::select('id', 'name')->get();
        $data     = [
            "projects" => $projects,
        ];
        return view("admin-views.crm.customers.create", $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'phone'      => 'required|string|max:20',
            'email'      => 'nullable|email|max:255',
            'job'        => 'nullable|string|max:255',
            'project_id' => 'nullable|exists:projects,id',
            'floor_id'   => 'nullable',
            'unit_id'    => 'nullable',
            'budget'     => 'nullable|numeric',
        ]);
        try {

            $customer = Customer::create([
                'name'          => $request->name,
                'phone'         => $request->phone,
                'email'         => $request->email,
                'job'           => $request->job,
                'project_id'    => $request->project_id,
                'floor_id'      => $request->floor_id,
                'unit_id'       => $request->unit_id,
                'budget'        => $request->budget,
                'added_by'      => auth()->id(),
                'assign_to'     => $request->assign_to,
            ]);
            Toastr::success(translate('added_successfully'));
            return to_route('customer.index')->with('success', translate('added_successfully'));
        } catch (Exception $ex) {
            return back()->with('error', $ex->getMessage())->withInput();
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
    public function get_unit_by_floor($id)
    {
        $units = UnitManagement::where('floor_management_id', $id)->get();

        return response()->json([
            'success' => true,
            'units'   => $units,
        ]);
    }

}
