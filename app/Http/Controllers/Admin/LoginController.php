<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    public function login()
    {
        return view('admin.auth.login_form');
    }

    public function login_admin(LoginRequest $request)
    {
        // return $request->all();
        $remember_me = $request->has('remember_me') ? true : false;
        if(auth()->guard('admin')->attempt(['email' => $request->email, 'password' => $request->password],$remember_me))
        {
            return redirect()->route('admin.home');
        }

        return redirect()->back()->with(['error' =>  __('messages.login_error')]);
    }

    //logout function

    public function logout()
    {
        auth()->guard('admin')->logout();

        return redirect()->route('admin.login');
    }
}
