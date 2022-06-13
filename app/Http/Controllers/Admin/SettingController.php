<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\Setting\GeneralSettings;

class SettingController extends Controller
{
    public $model_view_folder;

    //default namespace view files

    public function __construct()
    {
        $this->middleware(['permission:settings_read'])->only(['index', 'socialLinks', 'socialLogin']);
        return $this->model_view_folder = 'admin.settings';
    }

    public function general()
    {
        $title = __('site.general_settings');
        return view($this->model_view_folder.'.general', compact('title'));

    }// end of index

    public function store(GeneralSettings $request)
    {
        try {
            $requestData = $request->except(['_token', '_method']);

            if ($request->logo) {
                Storage::disk('local')->delete('public/uploads/settings/' . setting('logo'));
                $request->logo->store('public/uploads/settings');
                $requestData['logo'] = $request->logo->hashName();
            }

            if ($request->fav_icon) {
                Storage::disk('local')->delete('public/uploads/settings/' . setting('fav_icon'));
                $request->fav_icon->store('public/uploads/settings');
                $requestData['fav_icon'] = $request->fav_icon->hashName();
            }

            setting($requestData)->save();

            // return redirect()->back();
            session()->flash('success', __('messages.updateed_successfully'));
            return response()->json([
                'route' => route('admin.settings.general')
            ]);

        }catch (\Exception $exception){
            return session()->flash('error', __('messages.general_error'));
        }

    }// end of store


}
