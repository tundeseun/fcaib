<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmRoomAllocation extends Model
{
    protected $fillable = [
        'user_id', 'room_id', 'expires_at'
    ];

    public function room(){
    	return $this->belongsTo('App\SmRoomList', 'room_id');
    }

    public function user(){
    	return $this->belongsTo('App\Models\User', 'user_id');
    }
}
