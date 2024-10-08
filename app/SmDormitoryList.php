<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmDormitoryList extends Model
{
    public function rooms(){
        return $this->hasMany(SmRoomList::class, 'dormitory_id');
    }
}
