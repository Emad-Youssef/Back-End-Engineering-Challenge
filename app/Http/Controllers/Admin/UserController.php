<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\DataTables\UserDatatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreUser;
use App\Http\Requests\Admin\User\UpdateUser;

class UserController extends Controller
{
    public $model_view_folder;

    //default namespace view files

    public function __construct()
    {
        $this->middleware(['permission:users_read'])->only('index');
        $this->middleware(['permission:users_create'])->only('create');
        $this->middleware(['permission:users_update'])->only('edit');
        $this->middleware(['permission:users_delete'])->only(['destroy','bulkDelete','delete']);
        return $this->model_view_folder = 'admin.users';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserDatatables $user)
    {
        $title  = __('site.users');
        return $user->render($this->model_view_folder.'.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = __('site.add_user');
        return view($this->model_view_folder.'.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            session()->flash('success', __('messages.added_successfully'));
            return response()->json([
                'route' => route('admin.users.index')
            ]);

        }catch (\Exception $exception){
            return session()->flash('error', __('messages.general_error'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = __('site.edit_user');
        $user = User::find($id);
        if(!$user){
            session()->flash('error', __('messages.this_item_does_not_exist'));
            return back();
        }
        return view($this->model_view_folder.'.edit', compact('title','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, $id)
    {
        try {
            $user = User::find($id);
            if(!$user){
                return session()->flash('error', __('messages.this_item_does_not_exist'));
            }
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            session()->flash('success', __('messages.updateed_successfully'));
            return response()->json([
                'route' => route('admin.users.index')
            ]);

        }catch (\Exception $exception){
            return session()->flash('error', __('messages.general_error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        try {
            $this->delete($user);
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

                $user = User::FindOrFail($recordId);
                $this->delete($user);

            }//end of for each
            return response()->json([
                'message' => __('messages.deleted_successfully')
            ]);
        }catch (\Exception $exception){
            return session()->flash('error', __('messages.general_error'));
        }

    }// end of bulkDelete

    private function delete(User $user)
    {
        $user->delete();

    }
    // end of delete
    // public function destroy($id)
    // {
    //     try {
    //         $user = User::find($id);
    //         $user->delete();
    //         return response()->json([
    //             'message' => __('messages.deleted_successfully')
    //         ]);
    //     }catch (\Exception $exception){
    //         return session()->flash('error', __('messages.general_error'));
    //     }
    // }
}
