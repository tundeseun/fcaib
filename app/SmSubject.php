<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SmSubject extends Model
{
    
    public function classes()
    {
        return $this->belongsTo(SmClass::class,'class_id');
    }

    public function sections()
    {
        return $this->belongsTo(SmSection::class,'section_id');
    }

    public function assigned()
    {
        return $this->hasOne(SmAssignSubject::class,'subject_id');
    }

    public function isTeacher(){
        return $this->assigned->teacher_id == Auth::user()->staff->id;
    }

    public function upload(){
        return $this->hasOne(SmResultsUpload::class,'subject_id');
    }


}