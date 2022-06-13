<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Roles\RoleRequest;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public $model_view_folder;
    public function __construct()
    {
        $this->middleware('permission:roles_read')->only(['index']);
        $this->middleware('permission:roles_create')->only(['create', 'store']);
        $this->middleware('permission:roles_update')->only(['edit', 'update']);
        $this->middleware('permission:roles_delete')->only(['destroy','bulkDelete','delete']);
        return $this->model_view_folder = 'admin.roles';

    }// end of __construct

    public function index()
    {
        $title = __('site.roles');
        return view($this->model_view_folder.'.index', compact('title'));

    }// end of index

    public function data()
    {
        $roles = Role::whereNotIn('name', ['super_admin'])
            ->withCount(['users']);

        return DataTables::of($roles)
            ->addColumn('record_select', $this->model_view_folder.'.datatables.record_select')
            ->editColumn('created_at', function (Role $role) {
                return $role->created_at->format('Y-m-d');
            })
            ->addColumn('actions', $this->model_view_folder.'.datatables.action')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data

    public function create()
    {
        $title = __('site.add_roles');
        return view($this->model_view_folder.'.create',compact('title'));

    }// end of create

    public function store(RoleRequest $request)
    {

        try {
            $role = Role::create($request->only(['name']));
            $role->attachPermissions($request->permissions);
            session()->flash('success', __('messages.added_successfully'));
            return response()->json([
                'route' => route('admin.roles.index')
            ]);

        }catch (\Exception $exception){
            return session()->flash('error', __('messages.general_error'));
        }

    }// end of store

    public function edit(Role $role)
    {
        $title = __('site.edit_roles');
        return view($this->model_view_folder.'.edit', compact('title','role'));

    }
    // end of edit

    public function update(RoleRequest $request, Role $role)
    {
        if(!$role){
            return session()->flash('error', __('messages.this_item_does_not_exist'));
        }
        try {
            $role->update($request->only(['name']));
            $role->syncPermissions($request->permissions);
            session()->flash('success', __('messages.updateed_successfully'));
            return response()->json([
                'route' => route('admin.roles.index')
            ]);
        }catch (\Exception $exception){
            return session()->flash('error', __('messages.general_error'));
        }

    }// end of update

    public function destroy(Role $role)
    {

        try {
            $this->delete($role);
            return response()->json([
                'message' => __('messages.deleted_successfully')
            ]);
        }catch (\Exception $exception){
            return session()->flash('error', __('messages.general_error'));
        }
    }// end of destroy

    public function bulkDelete()
    {
        try {
            foreach (json_decode(request()->record_ids) as $recordId) {

                $role = Role::FindOrFail($recordId);
                $this->delete($role);

            }//end of for each
            return response()->json([
                'message' => __('messages.deleted_successfully')
            ]);
        }catch (\Exception $exception){
            return session()->flash('error', __('messages.general_error'));
        }

    }// end of bulkDelete

    private function delete(Role $role)
    {
        $role->delete();

    }// end of delete

}
