<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmResultsUpload extends Model
{

    protected $fillable = ['subject_id','class_id','academic_year_id','status'];

    public function department(){
        return $this->belongsTo(SmClass::class, 'class_id');
    }

    public function course(){
        return $this->belongsTo(SmSubject::class, 'subject_id');
    }

    public function getStatusAttribute($value)
    {
        // return match($value){
        //     0 => 'Pending',
        //     1 => 'Accepted',
        //     2 => 'Rejected'
        // };
    }

    public function scopeOnlyPending($query){
        return $query->whereStatus(0);
    }

    public function scopeOnlyAccepted($query){
        return $query->whereStatus(1);
    }

    public function scopeOnlyRejected($query){
        return $query->whereStatus(2);
    }
}
