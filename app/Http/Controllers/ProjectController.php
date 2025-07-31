<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\hierarchy\CostCenterCategory;

class ProjectController extends Controller
{

    public function index(Request $request)
    {
        // $this->authorize('complaints');
        $ids         = $request->bulk_ids;
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        $property    = Project::when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);

        $data = [
            'main'   => $property,
            'search' => $search,

        ];
        return view("admin-views.projects.list", $data);
    }
    public function create()
    {

        $property_type  = PropertyType::all();

        $data = [
            "property_types"  => $property_type,
        ];
        return view("admin-views.projects.create", $data);
    }
    public function edit($id)
    {


        $project = Project::findOrFail($id);
        $property_type       = PropertyType::all();

        $data = [
            "property_types"       => $property_type,
            "project" => $project,

        ];
        return view("admin-views.projects.edit", $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'                  => 'required|max:255',
            'property_type_id'      => 'required',
            'location'              => 'required|max:255',
        ]);
        DB::beginTransaction();
        try {
            $project                    = Project::create([
                'name'                  => $request->name,
                'type'                  => $request->property_type_id,
                'location'              => $request->location,
                'area'                  => $request->area,
                'description'           => $request->description,
                'status'                => $request->status ?? 'active',
            ]);

            DB::commit();
            return redirect()->route("project.index")->with("success", translate('added_successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'                  => 'required',
            'property_type_id'      => 'required',
            'location'              => 'required',
        ]);
        // dd($request->all());
        DB::beginTransaction();
        try {

            $project                                               = Project::findOrFail($id);
            $is_update                                                         = $project->update([
                'name'                  => $request->name,
                'type'                  => $request->type,
                'location'              => $request->location,
                'area'                  => $request->area,
                'description'           => $request->description,
                'status'                => $request->status ?? 'active',
            ]);

            DB::commit();
            return redirect()->route("project.index")->with("success", translate('added_successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    public function show($id)
    {
        $property = Project::findOrFail($id);
        $data     = [
            'property' => $property,
        ];
        return view('admin-views.project.property.show', $data);
    }

    public function delete(Request $request)
    {
        $property = Project::findOrFail($request->id);
        Project::findOrFail($request->id)->delete();
        return redirect()->back()->with('success', translate('deleted_successfully'));
    }

    public function view_image($id)
    {
        $project = Project::with( 
            'floor_management',
            'floor_management.floor_main',
            'floor_management.unit_child', 
        )->findOrFail($id);
        // $project = Project::findOrFail($id);
        $data = [
            'project_item' => $project,
        ];
        return view('admin-views.projects.view_image', $data);
    }
}
