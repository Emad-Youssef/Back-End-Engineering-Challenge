<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'deviceId'  => 'required'
        ]);

        if ($validator->fails()) {
            return response()->api([], 1, $validator->errors()->first());
        }

        $credentials = $request->only(['email', 'password']);

        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $data['user'] = new UserResource($user);
            $data['token']  = $user->createToken($request->deviceId)->plainTextToken;
            return response()->api($data);
        }else {
            return response()->api([], 1, __('auth.failed'));
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'name' => 'required|max:100|min:2',
            'email' => 'required|email|unique:users,email',
            'company' => 'required|max:100|min:2',
            'bio'       => 'nullable|max:1000',
            'password' => 'required',
            'deviceId'  => 'required'
        ]);

        if($validator->fails()){
            return response()->api([], 1, $validator->errors()->first());
        }

        $request->merge(['password' => bcrypt($request->password)]);

        $user = User::create($request->all());

        $data['user'] = new UserResource($user);
        $data['token'] = $user->createToken($request->deviceId)->plainTextToken;

        return response()->api($data);
    }

    public function user()
    {
        $data['user'] = new UserResource(auth()->user('sanctum'));

        return response()->api($data);

    }// end of user

    public function logout(Request $request)
    {
        // $this->validate($request ,[
        //     'deviceId'  => 'required'
        // ]);

        // auth()->user()->tokens()->where('name', $request->deviceId)->delete();
        auth()->user()->tokens()->delete();
        return response()->api([], 0, __('auth.logut'));
    }
}
