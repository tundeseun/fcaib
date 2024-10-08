<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmClassTime extends Model
{

    public function examSchedules()
    {
        return $this->hasMany(SmExamSchedule::class,'exam_period_id');
    }

    public function routineUpdates()
    {
        return $this->hasMany(SmClassRoutineUpdate::class,'class_period_id');
    }
    public function studentRoutineUpdates()
    {
        return $this->hasMany(SmClassRoutineUpdate::class,'class_period_id')->where('class_id', $this->class_id)
            ->where('section_id', $this->section_id);
    }
}
