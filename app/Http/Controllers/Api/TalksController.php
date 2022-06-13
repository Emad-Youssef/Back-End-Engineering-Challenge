<?php

namespace App\Http\Controllers\Api;

use App\Models\Talk;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Api\NewTalk;
use App\Http\Controllers\Controller;
use App\Http\Resources\TalkResource;
use Illuminate\Support\Facades\Validator;

class TalksController extends Controller
{

    // POST baseurl/talksto add a talk
    public function new_talk(NewTalk $request)
    {
        try {
            $talk = Talk::create([
                'title' => $request->title,
                'abstract' => $request->abstract,
                'room_n'    => $this->generateRoomNumber(),
                'speaker_id' => $request->speaker_id,
            ]);
            $talk = new TalkResource($talk);
            return response()->api($talk, 0,  __('messages.created_successfully'));

        }catch (\Exception $exception){
            return response()->api([], 1,   __('messages.general_error'));
        }

    }

    function generateRoomNumber() {
        $number = mt_rand(1, 9999); // better than rand()

        // call the same function if the room exists already
        if ($this->roomNumberExists($number)) {
            return $this->generateRoomNumber();
        }

        // otherwise, it's valid and can be used
        return $number;
    }

    function roomNumberExists($number) {
        // query the database and return a boolean
        return Talk::where('room_n',$number)->exists();
    }

    // to add an attendee to a talk
    public function add_attendee_talk(Request $request, $id)
    {
        $talk = Talk::find($id);
        if (!$talk) {
            return response()->api([], 1,   __('Id not valid'));
        }
        $validator = Validator::make($request->all(),
        [
            'attendee_id' => ['required', 'exists:users,id'],
        ]);

        if($validator->fails()){
            return response()->api([], 1, $validator->errors()->first());
        }

        $talk->attendees()->syncWithoutDetaching($request->attendee_id);

        return response()->api([], 0,   __('Successfully added'));
    }
    
    // DELETE
    public function remove_attendee_talk($talk_id, $attendee_id)
    {
        $user = User::find($attendee_id);

        if (!$user) {
            return response()->api([], 1,   __('attendee_id not valid'));
        }

        $user->talks()->detach($talk_id);

        return response()->api([], 0, 'removed successfully');

    }

    // GET baseurl/talks to see all talks
    public function talks()
    {
        $talks = Talk::with(['speaker','attendees'])->paginate(10);

        $talks = TalkResource::collection($talks)->response()->getData(true);

        if(count($talks) < 1){
            return response()->api([], 0, __('messages.emptyDataMsg'));
        }

        return response()->api($talks);
    }

    // to see list of attendees at that talk
    public function talk_attendees($talk_id){

        $talk = Talk::with('attendees')->find($talk_id);

        if (!$talk) {
            return response()->api([], 1,   __('Id not valid'));
        }

        $talk = new TalkResource($talk);

        return response()->api($talk);
    }

}
