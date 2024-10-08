<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmRoomList extends Model
{
    public function dormitory(){
    	return $this->belongsTo('App\SmDormitoryList', 'dormitory_id');
    }

    public function roomType(){
    	return $this->belongsTo('App\SmRoomType', 'room_type_id');
    }

    public function allocations(){
        return $this->hasMany('App\SmRoomAllocation', 'room_id');
    }

    public function isAvailable(): bool
    {
        return SmRoomAllocation::whereRoomId($this->id)->count() >= $this->number_of_bed;
    }

    public function scopeOnlyAvailable($query)
	{
		return $query->where('taken', 0);
	}
}
