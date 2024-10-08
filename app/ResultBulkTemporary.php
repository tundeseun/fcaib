<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultBulkTemporary extends Model
{
    protected $fillable  = ['matric_number', 'score', 'user_id'];
}