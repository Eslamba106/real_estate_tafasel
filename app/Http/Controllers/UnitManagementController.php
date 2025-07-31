<?php

namespace App\Http\Controllers;

use App\Models\View;
use App\Models\Project;
use App\Models\UnitType;
use App\Models\UnitParking;
use Illuminate\Http\Request;
use App\Models\UnitCondition;
use App\Models\UnitManagement;
use App\Models\FloorManagement;
use App\Models\UnitDescription;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;

class UnitManagementController extends Controller
{
    public function index(Request $request)
    {
        // $this->authorize('unit_management');
        $ids = $request->bulk_ids;
        $search = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        $unit_management = UnitManagement::when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%");
            }
        })
            // ->select('unit_management.*', 'units.name as block_name')
            ->latest()->paginate()->appends($query_param);

        $data = [
            'unit_management' => $unit_management,
            'search' => $search,
        ];
        return view("admin-views.unit_management.unit_management_list", $data);
    }

    public function create()
    {
        // $this->authorize('create_unit_management');

        $projects = Project::get();
        $floors = FloorManagement::get();
        $unit_types = UnitType::get();
        $unit_conditions = UnitCondition::get();
        $unit_descriptions = UnitDescription::get();
        $views = View::get();
        $unit_parkings = UnitParking::get();
        $data = [
            "projects" => $projects,
            "floors" => $floors,
            "unit_types" => $unit_types,
            "unit_conditions" => $unit_conditions,
            "unit_descriptions" => $unit_descriptions,
            "unit_parkings" => $unit_parkings,
            "views" => $views,
        ];

        return view("admin-views.unit_management.create")->with($data);
    }

    public function store(Request $request)
    {

        
            $request->validate([
                'project'                      => 'required',
                'floor'                         => 'required',
                'name'                          => 'required', 
            ]);
DB::beginTransaction();
        try {
            $unit_management = UnitManagement::create([
                'project_id'                                    => $request->project,
                'floor_management_id'                           => $request->floor,
                'name'                                          => $request->name,
                'unit_description_id'                           => $request->unit_description,
                'unit_type_id'                                  => $request->unit_type,
                'unit_condition_id'                             => $request->unit_condition,
                'unit_parking_id'                               => $request->unit_parking,
                'view_id'                                       => $request->view,
                'price'                                         => $request->price,
                'room_counts'                                   => $request->room_counts,
                'bath_room_counts'                              => $request->bath_room_counts,
                'ratio'                                         => $request->ratio,
                'area'                                          => $request->area,
            ]);
                Toastr::success(translate('added_successfully'));

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with("error", $e->getMessage());
        }
        return redirect()->route('unit_management.index')->with('success', translate('added_successfully'));
    }

    public function edit($id)
    {
        // $this->authorize('edit_unit_management');
        $selected_unit = UnitManagement::findOrFail($id);
        $projects = Project::get();
        $floors = FloorManagement::get();
        $unit_types = UnitType::get();
        $unit_conditions = UnitCondition::get();
        $unit_descriptions = UnitDescription::get();
        $views = View::get();
        $unit_parkings = UnitParking::get();
        $data = [
            "projects" => $projects,
            "floors" => $floors,
            "unit_types" => $unit_types,
            "unit_conditions" => $unit_conditions,
            "unit_descriptions" => $unit_descriptions,
            "unit_parkings" => $unit_parkings,
            "views" => $views,
            "selected_unit" => $selected_unit,
        ];
        return view("admin-views.unit_management.edit")->with($data);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
         $request->validate([
                'project'                      => 'required',
                'floor'                         => 'required',
                'name'                          => 'required', 
            ]);
        try {
            $selected_unit = UnitManagement::findOrFail($id);
            $selected_unit->update([
                'project_id'                                    => $request->project,
                'floor_management_id'                           => $request->floor,
                'name'                                          => $request->name,
                'unit_description_id'                           => $request->unit_description,
                'unit_type_id'                                  => $request->unit_type,
                'unit_condition_id'                             => $request->unit_condition,
                'unit_parking_id'                               => $request->unit_parking,
                'view_id'                                       => $request->view,
                'price'                                         => $request->price,
                'room_counts'                                   => $request->room_counts,
                'bath_room_counts'                              => $request->bath_room_counts,
                'ratio'                                         => $request->ratio,
                'area'                                          => $request->area,
            ]);
                Toastr::success(translate('updated_successfully'));
            return redirect()->route('unit_management.index')->with('success', translate('added_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    public function statusUpdate(Request $request)
    {
        $this->authorize('change_unit_management_status');
        $subscription = UnitManagement::findOrFail($request->id);
        $subscription->update([
            'status' => ($request->status == 1) ? 'active' : 'inactive',
        ]);
        return redirect()->back()->with('success', translate('updated_successfully'));
    }


    public function getFloorsByProject(Request $request)
    {
        $floors = FloorManagement::where('project_id', $request->project_id)->with('floor_main:id,name')->get();

        return response()->json(['floors' => $floors]);
    }
}
