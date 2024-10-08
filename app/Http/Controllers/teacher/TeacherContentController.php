<?php

namespace App\Http\Controllers\teacher;

use App\Role;
use App\User;
use App\SmStaff;
use App\SmStudent;
use App\SmSubject;
use App\SmMarksGrade;
use App\SmAssignSubject;
use App\YearCheck;
use App\ApiBaseMethod;
use App\SmNotification;
use App\SmGeneralSettings;
use App\SmCourseRegistration;
use Illuminate\Http\Request;
use App\SmTeacherUploadContent;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\SmResultsUpload;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\RolePermission\Entities\InfixRole;

class TeacherContentController extends Controller
{

    public function __construct()
	{
        $this->middleware('PM');
	}

    public function uploadContent(Request $request)
    {
        $input = $request->all();
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $validator = Validator::make($input, [
                'content_title' => "required",
                'content_type' => "required",
                'upload_date' => "required",
                'description' => "required",
                'attach_file' => "sometimes|nullable|mimes:pdf,doc,docx,jpg,jpeg,png,txt",
            ]);
        }
        //as assignment, st study material, sy sullabus, ot others download

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
        }
        if (empty($request->input('available_for'))) {

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', 'Content Receiver not selected');
            }
        }

        try {
            $fileName = "";
            if ($request->file('attach_file') != "") {
                $maxFileSize = SmGeneralSettings::first('file_size')->file_size;
                $file = $request->file('attach_file');
                $fileSize =  filesize($file);
                $fileSizeKb = ($fileSize / 1000000);
                if($fileSizeKb >= $maxFileSize){
                    Toastr::error( 'Max upload file size '. $maxFileSize .' Mb is set in system', 'Failed');
                    return redirect()->back();
                }
                $file = $request->file('attach_file');
                $fileName = $request->input('created_by') . time() . "." . $file->getClientOriginalExtension();
                // $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/upload_contents/', $fileName);
                $fileName = 'public/uploads/upload_contents/' . $fileName;
            }
            // return $fileName;

            $uploadContents = new SmTeacherUploadContent();
            $uploadContents->content_title = $request->input('content_title');
            $uploadContents->content_type = $request->input('content_type');
            if ($request->input('available_for') == 'admin') {
                $uploadContents->available_for_admin = 1;
            } elseif ($request->input('available_for') == 'student') {
                if (!empty($request->input('all_classes'))) {
                    $uploadContents->available_for_all_classes = 1;
                } else {
                    $uploadContents->class = $request->input('class');
                    $uploadContents->section = $request->input('section');
                }
            }

            $uploadContents->upload_date = date('Y-m-d', strtotime($request->input('upload_date')));
            $uploadContents->description = $request->input('description');
            $uploadContents->upload_file = $fileName;
            $uploadContents->created_by = $request->input('created_by');
            $uploadContents->school_id = Auth::user()->school_id;
            $uploadContents->academic_id = getAcademicId();
            $results = $uploadContents->save();


            if ($request->input('content_type') == 'as') {
                $purpose = 'assignment';
            } elseif ($request->input('content_type') == 'st') {
                $purpose = 'Study Material';
            } elseif ($request->input('content_type') == 'sy') {
                $purpose = 'Syllabus';
            } elseif ($request->input('content_type') == 'ot') {
                $purpose = 'Others Download';
            }


            // foreach ($request->input('available_for') as $value) {
            if ($request->input('available_for') == 'admin') {
                $roles = InfixRole::where('id', '!=', 1)->where('id', '!=', 2)->where('id', '!=', 3)->where('id', '!=', 9)->where(function ($q) {
                $q->where('school_id', Auth::user()->school_id)->orWhere('type', 'System');
            })->get();

                foreach ($roles as $role) {
                    $staffs = SmStaff::where('role_id', $role->id)->get();
                    foreach ($staffs as $staff) {
                        $notification = new SmNotification;
                        $notification->user_id = $staff->id;
                        $notification->role_id = $role->id;
                        $notification->date = date('Y-m-d');
                        $notification->message = $purpose . ' updated';
                        $notification->school_id = Auth::user()->school_id;
                        $notification->academic_id = getAcademicId();
                        $notification->save();
                    }
                }
            }
            if ($request->input('available_for') == 'student') {
                if (!empty($request->input('all_classes'))) {
                    $students = SmStudent::select('id')->get();
                    foreach ($students as $student) {
                        $notification = new SmNotification;
                        $notification->user_id = $student->id;
                        $notification->role_id = 2;
                        $notification->date = date('Y-m-d');
                        $notification->message = $purpose . ' updated';
                        $notification->school_id = Auth::user()->school_id;
                        $notification->academic_id = getAcademicId();
                        $notification->save();
                    }
                } else {
                    $students = SmStudent::select('id')->where('class_id', $request->input('class'))->where('section_id', $request->input('section'))->get();
                    foreach ($students as $student) {
                        $notification = new SmNotification;
                        $notification->user_id = $student->id;
                        $notification->role_id = 2;
                        $notification->date = date('Y-m-d');
                        $notification->message = $purpose . ' updated';
                        $notification->school_id = Auth::user()->school_id;
                        $notification->academic_id = getAcademicId();
                        $notification->save();
                    }
                }
            }
            // }

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {

                $data = '';

                return ApiBaseMethod::sendResponse($data, null);
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function contentList(Request $request)
    {
        try {
            $content_list = DB::table('sm_teacher_upload_contents')
                ->where('available_for_admin', '<>', 0)
                ->get();
            $type = "as assignment, st study material, sy sullabus, ot others download";
            $data = [];
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data['content_list'] = $content_list->toArray();
                $data['type'] = $type;
                return ApiBaseMethod::sendResponse($data, null);
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function deleteContent(Request $request, $id)
    {
        try {
            $content = DB::table('sm_teacher_upload_contents')->where('id', $id)->delete();
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = '';
                return ApiBaseMethod::sendResponse($data, null);
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function courseList(){
        try {
            $staff_id = SmStaff::where('user_id',Auth::user()->id)->first()->id;
            $courses = SmAssignSubject::join('sm_subjects','sm_subjects.id','=','sm_assign_subjects.subject_id') 
                                        ->join('sm_classes','sm_classes.id','=','sm_assign_subjects.class_id') 
                                        ->where('teacher_id',$staff_id)->get();

            return view('backEnd.teacherPanel.view_courses', compact('courses'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    // public function uploadResults($id){
    //     try {
    //         $course_details = SmSubject::where('id', $id)->first();
    //         $students = SmCourseRegistration::select('sm_course_registrations.*', 'sm_course_registrations.id as cid','sm_students.*')->join('sm_students','sm_students.id','=','sm_course_registrations.student_id')->where('subject_id', $id)->get();
    //         //dd($students);
    //         return view('backEnd.teacherPanel.upload_results', compact('course_details','students'));
    //     } catch (\Exception $e) {
    //         Toastr::error('Operation Failed', 'Failed');
    //         return redirect()->back();
    //     }
    // }

    public function uploadResultsSingle($id){
        try {
            $course_details = SmSubject::where('id', $id)->first();
            $students = SmCourseRegistration::select('sm_course_registrations.*', 'sm_course_registrations.id as cid','sm_students.*')->join('sm_students','sm_students.id','=','sm_course_registrations.student_id')->where('subject_id', $id)->get();
            //dd($students);
            return view('backEnd.teacherPanel.upload_results', compact('course_details','students'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function updateScore(Request $request){
        $cid = $request->cid;
        $score = $request->score;
        $grade = SmMarksGrade::where([['percent_from', '<=', $score], ['percent_upto', '>=', $score]])->first();
        $grade_point = $request->units * $grade->gpa;
        $courseRegistration = SmCourseRegistration::find($cid);
        $courseRegistration->update(['score' => $score, 'grade' => $grade->grade_name, 'remark' => $grade->description, 'grade_point' => $grade_point, 'uploaded' => 1]);
        
        $course = $courseRegistration->course;

        SmResultsUpload::updateOrCreate([
                'subject_id' => $course->id,
                'class_id'  => $course->class_id,
                'academic_year_id'   => getAcademicId()
            ], [
                'subject_id' => $course->id,
                'class_id'  => $course->class_id,
                'academic_year_id'   => getAcademicId(),
            ]);

        return response()->json(['grade' => $grade->grade_name, 'remark' =>  $grade->description], 200);
    }

    public function onlineExamResults(){
            $present_date_time = date("Y-m-d H:i:s");
            $staff_id = SmStaff::where('user_id',Auth::user()->id)->first()->id;
            $courses = SmAssignSubject::join('sm_subjects','sm_subjects.id','=','sm_assign_subjects.subject_id') 
                                        ->join('sm_online_exams', 'sm_online_exams.subject_id','=','sm_assign_subjects.subject_id')
                                        ->where('teacher_id',$staff_id)
                                        ->select('sm_online_exams.id as eid', 'sm_subjects.*','sm_online_exams.*', 'sm_assign_subjects.*')->get();
            return view('backEnd.teacherPanel.online_exam_results', compact('courses','present_date_time'));
    }

    public function departmentResults(){
        $class_id = Auth::user()->staff->department->id;
        $results = SmResultsUpload::where('class_id', $class_id)->onlyPending()->get();
        return view('backEnd.teacherPanel.department_results', compact('results'));
    }

    

    public function acceptedDepartmentResults(){
        $class_id = Auth::user()->staff->department->id;
        $results = SmResultsUpload::where('class_id', $class_id)->onlyAccepted()->get();
        return view('backEnd.teacherPanel.accepted_department_results', compact('results'));
    }

    public function rejectedDepartmentResults(){
        $class_id = Auth::user()->staff->department->id;
        $results = SmResultsUpload::where('class_id', $class_id)->onlyRejected()->get();
        return view('backEnd.teacherPanel.rejected_department_results', compact('results'));
    }


    public function acceptResult($id){
        try{
            $result = SmResultsUpload::findOrFail($id);
            $result->update(['status' => 1]);
            Toastr::success('Operation Successful', 'Success');
			return redirect()->back();
        }catch(\Exception $e){
            Toastr::error("Operation Failed: {$e}", 'Failed');
            return redirect()->back();
        }
    }

    public function rejectResult($id){
        try{
            $result = SmResultsUpload::findOrFail($id);
            $result->update(['status' => 2]);
            Toastr::success('Operation Successful', 'Success');
			return redirect()->back();
        }catch(\Exception $e){
            Toastr::error("Operation Failed: {$e}", 'Failed');
            return redirect()->back();
        }
    }
}
