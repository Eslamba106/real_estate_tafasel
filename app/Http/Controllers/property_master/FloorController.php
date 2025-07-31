<?php

namespace App\Http\Controllers\property_master;

use App\Models\Floor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\property_master\FloorServices;
use Illuminate\Support\Facades\Log;

class FloorController extends Controller
{
    public $floor_services;
    public $model;
    public function __construct(FloorServices $floor_services){
        $this->floor_services = $floor_services;
    }
    public function index(Request $request){
        // $this->authorize('complaints');
        // $ids = $request->bulk_ids;
        // if ($request->bulk_action_btn === 'update_status'  && is_array($ids) && count($ids)) {
        //     $data = ['status' => 1, 'worker' => $request->worker];
        //     Floor::whereIn('id', $ids)->update($data);
        //     return back()->with('success', __('general.updated_successfully'));
        // }
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        $floor = Floor::when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);

        $data = [
            'main'              => $floor,
            'search'            => $search,
            'route'             => 'floor', 

        ];
        return view("admin-views.property_master.index" , $data);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required', 
        ]);
        try{
            $floor_services = $this->floor_services->storePropertyMasterModal($request);
            return redirect()->route('floor.index')->with('success',__('property_master.added_successfully'));
            }catch(\Exception $e){
                Log::error($e->getMessage());
                return redirect()->back()->with("error", $e->getMessage());
            }
    }
    public function edit($id){
        $floor_services = $this->floor_services->findOrFail($id);
        $data = [
            "main"                          => $floor_services,
            'route'                         => 'floor', 

        ];
        return view("admin-views.property_master.edit",  $data);
    }
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required', 
        ]);
        try{
            // $request->id = $id;
            $floor_services = $this->floor_services->updatePropertyMasterModal($request);
            return redirect()->route('floor.index')->with('success',__('property_master.updated_successfully'));
        }catch(\Exception $e){
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function delete(Request $request){
        $floor_services = $this->floor_services->findOrFail($request->id);
        // dd($floor_services);

        $floor_services_delete = $this->floor_services->deletePropertyMasterModal($request->id);
        ($floor_services_delete == true) ? redirect()->route("floor.index")->with("success",__('property_master.deleted_successfully'))
        : redirect()->back()->with('error',__('general.error_deleted'));
    }
    public function statusUpdate(Request $request)
    {
        // $this->authorize('edit_product');
        $main = Floor::findOrFail($request->id);
        $main->update([
            'status' => ($request->status == 1) ? 'active' : 'inactive',
        ]);
        return redirect()->back()->with('success',__('property_master.updated_successfully'));
    }

}
