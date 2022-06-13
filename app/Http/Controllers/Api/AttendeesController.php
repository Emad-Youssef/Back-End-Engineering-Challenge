<?php

namespace App\Http\Controllers\Api;

use App\Models\Talk;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Api\NewTalk;
use App\Http\Controllers\Controller;
use App\Http\Resources\TalkResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\AttendeesResource;
use Illuminate\Support\Facades\Validator;

class AttendeesController extends Controller
{


    // POST baseurl/attendees to add an attendee
    public function new_attendee(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'name' => 'required|max:100|min:2',
            'email' => 'required|email|unique:users,email',
            'company' => 'required|max:100|min:2',
            'bio'       => 'nullable|max:1000',
            'password' => 'required',
        ]);
        if($validator->fails()){
            return response()->api([], 1, $validator->errors()->first());
        }

        try {

            $request->merge(['password' => bcrypt($request->password)]);

            $user = User::create($request->all());

            $data['user'] = new UserResource($user);
            return response()->api($data, 0,  __('messages.created_successfully'));

        }catch (\Exception $exception){
            return response()->api([], 1,   __('messages.general_error'));
        }

    }
    
    // GET to see all attendees
    public function attendees()
    {
        $attendees = User::paginate(10);

        $attendees = UserResource::collection($attendees)->response()->getData(true);

        if(count($attendees) < 1){
            return response()->api([], 0, __('messages.emptyDataMsg'));
        }

        return response()->api($attendees);
    }


}
