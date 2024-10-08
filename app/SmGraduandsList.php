<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmGraduandsList extends Model
{
    protected $fillable = [
        'class_id',
        'student_id',
        'session',
        'cgpa',
        'class_of_degree',
        'matric_number',
        'academic_id'
    ];
}
