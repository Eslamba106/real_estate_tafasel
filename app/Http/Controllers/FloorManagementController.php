<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\FloorManagement;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class FloorManagementController extends Controller
{
    public function index(Request $request)
    {
        // $this->authorize('floor_management');
        $ids              = $request->bulk_ids;
        $search           = $request['search'];
        $query_param      = $search ? ['search' => $request['search']] : '';
        $floor_management = FloorManagement::join('floors', 'floor_management.floor_id', '=', 'floors.id')->when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('floors.name', 'like', "%{$value}%")
                    ->orWhere('floor_management.id', $value);
            }
        })
            ->select('floor_management.*', 'floors.name as block_name')
            ->latest()->paginate()->appends($query_param);

        $data = [
            'floor_management' => $floor_management,
            'search'           => $search,

        ];
        return view("admin-views.floor_management.floor_management_list", $data);
    }
    public function create()
    {
        $project = Project::select('id' , 'name' )->get(); 
        $floors   = Floor::select('id' , 'name' )->get();
        $data     = [
            "projects" => $project,
            "floors"   => $floors, 
        ];

        return view("admin-views.floor_management.create")->with($data);

    }
    public function edit($id)
    {
        $old_floor = FloorManagement::findOrFail($id);
        $project  = Project::get(); 
        $floors    = Floor::get();
        $data      = [
            "projects"  => $project,
            "floors"    => $floors, 
            "old_floor" => $old_floor,
        ];

        return view("admin-views.floor_management.edit")->with($data);

    }
    public function store(Request $request)
    { 

        $rules = [
            'floors' => 'required|array',
            'project' => 'required', 
        ];
    
        foreach ($request->floors as $index => $floorId) {
            $rules["floors.$index"] = [
                'required',
                Rule::unique('floor_management', 'floor_id')  
                    ->where(function ($query) use ($request) {
                        return $query
                            ->where('project_id', $request->project) ;
                    })
            ];
        }
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        try {
            foreach ($request->floors as $floor) {
                $project = FloorManagement::create([
                    "floor_id"                  => $floor,
                    "project_id"                => $request->project, 
                ]);
            }
    
            return redirect()->route("floor_management.index")->with("success", __('project_master.added_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function update(Request $request , $id)
    { 
        $floor = FloorManagement::findOrFail($id);

        $request->validate([
            'floor'    => [
                'required',
                Rule::unique('floor_management', 'floor_id')
                    ->where(function ($query) use ($request) {
                        return $query->where('project_id', $request->project) ;
                    })
                    ->ignore($id)  
            ],
            'project' => 'required',
            'block'    => 'required',
        ]);
    
        try {
            $project = FloorManagement::findOrFail($id);
    
            $project->update([
                "floor_id"               => $request->floor,
                "project_id" => $request->project, 
            ]);
            return redirect()->route("floor_management.index")->with("success", __('general.updated_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

   

    public function statusUpdate(Request $request)
    {
        // $this->authorize('edit_subscription');
        $subscription = FloorManagement::findOrFail($request->id);
        $subscription->update([
            'status' => ($request->status == 1) ? 'active' : 'inactive',
        ]);
        return redirect()->back()->with('success', __('project_master.updated_successfully'));
    }
    public function delete(Request $request)
    {
        // $this->authorize('show_block');

        $floor = FloorManagement::findOrFail($request->id);
        $floor->delete();
        return redirect()->back()->with('success', __('general.deleted_successfully'));
    }
}
