<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class SmExamSchedule extends Model
{
    public function examSchedule(){
    	return $this->hasMany('App\SmExamScheduleSubject', 'exam_schedule_id', 'id');
    }

    public function exam(){
    	return $this->belongsTo('App\SmExam', 'exam_id', 'id');
    }

    public function class(){
		return $this->belongsTo('App\SmClass', 'class_id', 'id');
	}
	public function section(){
        return $this->belongsTo('App\SmSection', 'section_id', 'id');
    }
    public function className(){
        return $this->belongsTo('App\SmClass', 'class_id', 'id');
    }

    public function classRoom(){
        return $this->belongsTo('App\SmClassRoom', 'room_id', 'id');
    }

    public function subject(){
        return $this->belongsTo('App\SmSubject', 'subject_id', 'id');
    }


    public static function assignedRoutine($class_id, $section_id, $exam_id, $subject_id, $exam_period_id){
        try {
            return SmExamSchedule::where('class_id', $class_id)
            ->where('section_id', $section_id)
            ->where('exam_term_id', $exam_id)
            ->where('subject_id', $subject_id)
            ->where('exam_period_id', $exam_period_id)
           
            ->where('school_id',Auth::user()->school_id)
            ->first();
        } catch (\Exception $e) {
            $data=[];
            return $data;
        }
    }

    public static function assignedRoutineSubject($class_id, $section_id, $exam_id, $subject_id){
        try {
            return SmExamSchedule::where('class_id', $class_id)
            ->where('section_id', $section_id)
            ->where('exam_term_id', $exam_id)
            ->where('subject_id', $subject_id)
           
            ->where('school_id',Auth::user()->school_id)
            ->first();
        } catch (\Exception $e) {
            $data=[];
            return $data;
        }
    }

    public static function assigned_date_wise_exams($exam_period_id, $exam_term_id, $date){
        
        try {
            return SmExamSchedule::where('exam_period_id', $exam_period_id)->where('date', $date)->where('exam_term_id', $exam_term_id)->get();
        } catch (\Exception $e) {
            $data=[];
            return $data;
        }
    }

    public static function assignedRoutineSubjectStudent($class_id, $section_id, $exam_id, $subject_id, $exam_period_id){
        
        try {
            return SmExamSchedule::where('class_id', $class_id)->where('section_id', $section_id)->where('exam_term_id', $exam_id)->where('subject_id', $subject_id)->where('exam_period_id', $exam_period_id)->first();
        } catch (\Exception $e) {
            $data=[];
            return $data;
        }
    }

    public static function examScheduleSubject($class_id, $section_id, $exam_id, $exam_period_id, $date){
        
        try {
            return SmExamSchedule::where('class_id', $class_id)->where('section_id', $section_id)
            ->where('exam_term_id', $exam_id)->where('exam_period_id', $exam_period_id)
            ->where('date', $date)
            ->first();
        } catch (\Exception $e) {
            $data=[];
            return $data;
        }
    }

    public static function getSchedules($day, $class_id, $section_id){
        return SmExamSchedule::where('sm_exam_schedules.class_id', $class_id)
                             ->where('sm_exam_schedules.section_id', $section_id)
                             ->where('sm_exam_schedules.day',$day)
                             ->join('sm_subjects','sm_subjects.id','sm_exam_schedules.subject_id')
                             ->join('sm_class_rooms','sm_class_rooms.id','sm_exam_schedules.room_id')
                             ->select('sm_exam_schedules.*', 'sm_subjects.subject_name', 'sm_subjects.subject_code', 'sm_class_rooms.room_no')
                             ->get();
    }


}
