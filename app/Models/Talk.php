<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Talk extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'abstract',
        'room_n',
        'speaker_id',
    ];

    public function speaker(){
        return $this->belongsTo(User::class, 'speaker_id');
    }

    public function attendees()
    {
        return $this->belongsToMany(User::class, 'attendee_talks')->withPivot('created_at')->withTimestamps();
    }
}
