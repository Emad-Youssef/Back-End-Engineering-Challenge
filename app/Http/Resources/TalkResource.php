<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TalkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'title' => $this->title,
            'abstract' => $this->abstract,
            'room' => $this->room_n,
            // 'speaker' => new UserResource($this->speaker),
            'speaker' => new UserResource($this->whenLoaded('speaker')),
            'attendees'    => AttendeesResource::collection($this->whenLoaded('attendees')),

        ];
    }
}
