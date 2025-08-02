<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use App\Services\TeamServices;
use Illuminate\Support\Facades\Log;
use Brian2694\Toastr\Facades\Toastr;

class TeamController extends Controller
{
    public $team_services;
    public $model;
    public function __construct(TeamServices $team_services)
    {
        $this->team_services = $team_services;
    }
    public function index(Request $request)
    {
        // $this->authorize('complaints');
        // $ids = $request->bulk_ids;
        // if ($request->bulk_action_btn === 'update_status'  && is_array($ids) && count($ids)) {
        //     $data = ['status' => 1, 'worker' => $request->worker];
        //     Team::whereIn('id', $ids)->update($data);
        //     return back()->with('success', translate('general.updated_successfully'));
        // }
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        $team = Team::when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);

        $data = [
            'main'              => $team,
            'search'            => $search,
            'route'             => 'team',
        ];
        return view("admin-views.property_master.index", $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        try {
            $team_services = $this->team_services->storePropertyMasterModal($request);
            Toastr::success('added_successfully'); 
            return redirect()->route('team.index')->with('success', translate('added_successfully'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function edit($id)
    {
        $team_services = $this->team_services->findOrFail($id);
        $data = [
            "main"                          => $team_services,
            'route'                         => 'team',

        ];
        return view("admin-views.property_master.edit",  $data);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        try {
            // $request->id = $id;
            $team_services = $this->team_services->updatePropertyMasterModal($request);
            // $team_services->update([
            //     'members'   => json_encode($request['modules']),
            // ]);
            Toastr::success('updated_successfully');

            return redirect()->route('team.index')->with('success', translate('updated_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function delete(Request $request)
    {
        $team_services = $this->team_services->findOrFail($request->id);
        // dd($team_services);

        $team_services_delete = $this->team_services->deletePropertyMasterModal($request->id);
        ($team_services_delete == true) ? redirect()->route("team.index")->with("success", translate('deleted_successfully'))
            : redirect()->back()->with('error', translate('error_deleted'));
    }
    public function statusUpdate(Request $request)
    {
        // $this->authorize('edit_product');
        $main = Team::findOrFail($request->id);
        $main->update([
            'status' => ($request->status == 1) ? 'active' : 'inactive',
        ]);
        return redirect()->back()->with('success', translate('updated_successfully'));
    }
}
