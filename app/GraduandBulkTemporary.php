<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GraduandBulkTemporary extends Model
{
    protected $fillable  = ["matric_number", "cgpa","class_of_degree", "user_id"];
}