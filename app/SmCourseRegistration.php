<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class SmCourseRegistration extends Model
{
    protected $fillable = [
        'subject_id',
        'student_id',
        'semester',
        'score',
        'section',
        'grade_point',
        'uploaded',
        'remark',
        'grade'
    ];

    public function subjects(){
        return $this->hasMany('App\SmSubject', 'id','subject_id');
    }

    static function getExamResult($student_id, $semester, $section){

          return SmCourseRegistration::where('student_id', '=', $student_id)
                                      ->where('uploaded','=',1)
                                      ->where('section', '=', $section)
                                      ->where('semester', '=', $semester)
                                      ->join('sm_subjects', function($join){
                                            $join->on( 'sm_course_registrations.subject_id', '=', 'sm_subjects.id');
                                      })
                                      ->get();
    }

    static function cgpa($student_id){
       $grade_points =  SmCourseRegistration::where('student_id','=',$student_id)->where('uploaded','=',1)->sum('grade_point');
       $credit_units = SmCourseRegistration::where('student_id', '=', $student_id)
                                            ->where('uploaded','=',1)
                                            ->join('sm_subjects', function($join){
                                                  $join->on( 'sm_course_registrations.subject_id', '=', 'sm_subjects.id');
                                            })
                                            ->sum('units');
        return $grade_points/($credit_units ?: 1);
    }

    public function course(){
        return $this->belongsTo(SmSubject::class, 'subject_id');
    }
}
