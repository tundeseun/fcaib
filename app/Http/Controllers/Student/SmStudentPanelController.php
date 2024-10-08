<?php

namespace App\Http\Controllers\Student;

use File;
use App\Role;
use App\User;
use DateTime;
use App\SmBook;
use App\SmExam;
use ZipArchive;
use App\SmClass;
use App\SmEvent;
use App\SmRoute;
use App\SmStaff;
use App\SmHoliday;
use App\SmSection;
use App\SmStudent;
use App\SmSubject;
use App\SmVehicle;
use App\SmWeekend;
use App\YearCheck;
use App\SmExamType;
use App\SmHomework;
use App\SmRoomList;
use App\SmRoomType;
use App\SmBaseSetup;
use App\SmBookIssue;
use App\SmClassTime;
use App\SmLeaveType;
use App\SmFeesAssign;
use App\SmMarksGrade;
use App\SmOnlineExam;
use App\ApiBaseMethod;
use App\SmLeaveDefine;
use App\SmNoticeBoard;
use App\SmAcademicYear;
use App\SmExamSchedule;
use App\SmLeaveRequest;
use App\SmNotification;
use App\SmStudentGroup;
use App\SmAssignSubject;
use App\SmAssignVehicle;
use App\SmDormitoryList;
use App\SmLibraryMember;
use App\SmGeneralSettings;
use App\SmStudentCategory;
use App\SmStudentDocument;
use App\SmStudentTimeline;
use App\SmStudentAttendance;
use App\SmCourseRegistration;
use Illuminate\Http\Request;
use App\SmFeesAssignDiscount;
use App\SmExamScheduleSubject;
use Illuminate\Support\Carbon;
use App\SmClassOptionalSubject;
use App\SmTeacherUploadContent;
use App\SmOptionalSubjectAssign;
use App\SmStudentTakeOnlineExam;
use App\SmUploadHomeworkContent;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use Modules\RolePermission\Entities\InfixRole;
use Modules\OnlineExam\Entities\InfixOnlineExam;
use App\Notifications\StudentHomeworkSubmitNotification;
use App\Services\Remita\Remita;
use App\SmAddIncome;
use App\SmFeesPayment;
use App\SmRoomAllocation;
use App\SmSession;
use NumberFormatter;

class SmStudentPanelController extends Controller
{

    public function __construct()
    {
        $this->middleware('PM');
        // User::checkAuth();
    }

    public function studentMyAttendanceSearchAPI(Request $request, $id = null)
    {

        $input = $request->all();

        $validator = Validator::make($input, [
            'month' => "required",
            'year' => "required",
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $student_detail = SmStudent::where('user_id', $id)->first();

            $year = $request->year;
            $month = $request->month;
            if ($month < 10) {
                $month = '0' . $month;
            }
            $current_day = date('d');

            $days = cal_days_in_month(CAL_GREGORIAN, $month, $request->year);
            $days2 = '';
            if ($month != 1) {
                $days2 = cal_days_in_month(CAL_GREGORIAN, $month - 1, $request->year);
            } else {
                $days2 = cal_days_in_month(CAL_GREGORIAN, $month, $request->year);
            }
            // return  $days2;
            $previous_month = $month - 1;
            $previous_date = $year . '-' . $previous_month . '-' . $days2;
            $previousMonthDetails['date'] = $previous_date;
            $previousMonthDetails['day'] = $days2;
            $previousMonthDetails['week_name'] = date('D', strtotime($previous_date));
            $attendances = SmStudentAttendance::where('student_id', $student_detail->id)
                ->where('attendance_date', 'like', '%' . $request->year . '-' . $month . '%')
                ->select('attendance_type', 'attendance_date')
                ->where('school_id', Auth::user()->school_id)->get();

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data['attendances'] = $attendances;
                $data['previousMonthDetails'] = $previousMonthDetails;
                $data['days'] = $days;
                $data['year'] = $year;
                $data['month'] = $month;
                $data['current_day'] = $current_day;
                $data['status'] = 'Present: P, Late: L, Absent: A, Holiday: H, Half Day: F';
                return ApiBaseMethod::sendResponse($data, null);
            }
            //Test
            return view('backEnd.studentPanel.student_attendance', compact('attendances', 'days', 'year', 'month', 'current_day'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }



    public function studentMyAttendanceSearch(Request $request, $id = null)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'month' => "required",
            'year' => "required",
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $login_id = $id;
            } else {
                $login_id = Auth::user()->id;
            }
            $student_detail = SmStudent::where('user_id', $login_id)->first();

            $year = $request->year;
            $month = $request->month;
            $current_day = date('d');

            $days = cal_days_in_month(CAL_GREGORIAN, $request->month, $request->year);

            $attendances = SmStudentAttendance::where('student_id', $student_detail->id)->where('attendance_date', 'like', $request->year . '-' . $request->month . '%')->where('school_id', Auth::user()->school_id)->get();
            $academic_years = SmAcademicYear::where('active_status', '=', 1)->where('school_id', Auth::user()->school_id)->get();
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data['attendances'] = $attendances;
                $data['days'] = $days;
                $data['year'] = $year;
                $data['month'] = $month;
                $data['current_day'] = $current_day;
                return ApiBaseMethod::sendResponse($data, null);
            }

            return view('backEnd.studentPanel.student_attendance', compact('attendances', 'days', 'year', 'month', 'current_day', 'student_detail', 'academic_years'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function studentMyAttendancePrint($month, $year)
    {
        try {
            $login_id = Auth::user()->id;
            $student_detail = SmStudent::where('user_id', $login_id)->first();
            $current_day = date('d');
            $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $attendances = SmStudentAttendance::where('student_id', $student_detail->id)->where('attendance_date', 'like', $year . '-' . $month . '%')->where('school_id', Auth::user()->school_id)->get();
            $customPaper = array(0, 0, 700.00, 1000.80);
            $pdf = PDF::loadView(
                'backEnd.studentPanel.my_attendance_print',
                [
                    'attendances' => $attendances,
                    'days' => $days,
                    'year' => $year,
                    'month' => $month,
                    'current_day' => $current_day,
                    'student_detail' => $student_detail
                ]
            )->setPaper('A4', 'landscape');
            return $pdf->stream('my_attendance.pdf');
            //return view('backEnd.studentPanel.student_attendance', compact('attendances', 'days', 'year', 'month', 'current_day', 'student_detail'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function studentDashboard(Request $request, $id = null)
    {
        try {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $user_id = $id;
            } else {
                $user = Auth::user();

                if ($user) {
                    $user_id = $user->id;
                } else {
                    $user_id = $request->user_id;
                }
            }

            $student_detail = SmStudent::where('user_id', $user_id)->first();




            $fees_assigneds = SmFeesAssign::where('student_id', $student_detail->id)
                ->where('school_id', Auth::user()->school_id)
                ->get();

            $accomodation = SmRoomList::where('sm_room_lists.id', $student_detail->room_id)
                ->join('sm_dormitory_lists', function ($join) {
                    $join->on('sm_dormitory_lists.id', '=', 'sm_room_lists.dormitory_id');
                })
                ->first();

            $fees_discounts = SmFeesAssignDiscount::where('student_id', $student_detail->id)

                ->where('school_id', Auth::user()->school_id)
                ->get();

            $documents = SmStudentDocument::where('student_staff_id', $student_detail->id)
                ->where('type', 'stu')

                ->where('school_id', Auth::user()->school_id)
                ->get();


            return view(
                'backEnd.studentPanel.my_profile',
                compact(
                    'accomodation',
                    'student_detail',
                    'fees_assigneds',
                    'fees_discounts',
                    'documents'
                )
            );
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }


    public function studentUpdate(Request $request)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::beginTransaction();
        try {

            $student = SmStudent::find($request->id);
            if ($request->photo) {
                $file = $request->file('photo');
                $images = Image::make($file)->insert($file);
                if (file_exists($student->photo)) {
                    unlink($student->photo);
                }
                $name = md5($file->getClientOriginalName() . time()) . "." . "png";
                $images->save('public/uploads/student/' . $name);
                $imageName = 'public/uploads/student/' . $name;
                $student->student_photo = $imageName;
            }
            $student->mobile = $request->phone_number;
            $student->bloodgroup_id = $request->blood_group;
            $student->religion_id = $request->religion;
            $student->height = $request->height;
            $student->weight = $request->weight;
            $student->current_address = $request->current_address;
            $student->save();
            DB::commit();


            // session null
            $update_stud = SmStudent::where('user_id', $student->user_id)->first('student_photo');
            Session::put('profile', $update_stud->student_photo);
            Session::put('fathers_photo', '');
            Session::put('mothers_photo', '');
            Session::put('guardians_photo', '');

            Toastr::success('Operation successful', 'Success');
            return redirect('student-profile');
        } catch (\Exception $e) {
            return $e->getMessage();
            DB::rollback();
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function studentProfileUpdate(Request $request, $id = null)
    {
        try {
            $student = SmStudent::find($id);



            $classes = SmClass::where('active_status', '=', '1')->where('school_id', Auth::user()->school_id)->get();

            $religions = SmBaseSetup::where('active_status', '=', '1')->where('base_group_id', '=', '2')->get();
            $blood_groups = SmBaseSetup::where('active_status', '=', '1')->where('base_group_id', '=', '3')->get();
            $genders = SmBaseSetup::where('active_status', '=', '1')->where('base_group_id', '=', '1')->get();
            $route_lists = SmRoute::where('active_status', '=', '1')->where('school_id', Auth::user()->school_id)->get();
            $vehicles = SmVehicle::where('active_status', '=', '1')->where('school_id', Auth::user()->school_id)->get();
            $dormitory_lists = SmDormitoryList::where('active_status', '=', '1')->where('school_id', Auth::user()->school_id)->get();
            $driver_lists = SmStaff::where([['active_status', '=', '1'], ['role_id', 9]])->where('school_id', Auth::user()->school_id)->get();
            $categories = SmStudentCategory::where('school_id', Auth::user()->school_id)->get();
            $groups = SmStudentGroup::where('school_id', Auth::user()->school_id)->get();
            $sessions = SmAcademicYear::where('active_status', '=', '1')->where('school_id', Auth::user()->school_id)->get();
            $siblings = SmStudent::where('parent_id', $student->parent_id)->where('school_id', Auth::user()->school_id)->get();

            return view('backEnd.studentPanel.my_profile_update', compact('student', 'classes', 'religions', 'blood_groups', 'genders', 'route_lists', 'vehicles', 'dormitory_lists', 'categories', 'groups', 'sessions', 'siblings', 'driver_lists'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function studentProfile(Request $request, $id = null)
    {

        //try {
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $user_id = $id;
        } else {
            $user = Auth::user();

            if ($user) {
                $user_id = $user->id;
            } else {
                $user_id = $request->user_id;
            }
        }

        $student_detail = SmStudent::where('user_id', $user_id)->first();

        $fees_assigneds = SmFeesAssign::where('student_id', $student_detail->id)->where('school_id', Auth::user()->school_id)->get();
        $fees_discounts = SmFeesAssignDiscount::where('student_id', $student_detail->id)->where('school_id', Auth::user()->school_id)->get();

        $timelines = SmStudentTimeline::where('staff_student_id', $student_detail->id)->where('type', 'stu')->where('visible_to_student', 1)->where('school_id', Auth::user()->school_id)->get();
        $exams = SmExamSchedule::where('class_id', $student_detail->class_id)->where('section_id', $student_detail->section_id)->where('school_id', Auth::user()->school_id)->get();
        $grades = SmMarksGrade::where('active_status', 1)->where('school_id', Auth::user()->school_id)->get();

        $totalSubjects = SmAssignSubject::where('class_id', '=', $student_detail->class_id)->where('section_id', '=', $student_detail->section_id)->where('school_id', Auth::user()->school_id)->get();

        $totalNotices = SmNoticeBoard::where('active_status', '=', 1)->where('is_published', '=', 1)->where('school_id', Auth::user()->school_id)->get();

        $time_zone_setup = SmGeneralSettings::join('sm_time_zones', 'sm_time_zones.id', '=', 'sm_general_settings.time_zone_id')
            ->where('school_id', Auth::user()->school_id)->first();
        date_default_timezone_set($time_zone_setup->time_zone);


        $now = date('H:i:s');

        if (moduleStatusCheck('OnlineExam') == TRUE) {
            $online_exams = InfixOnlineExam::where('active_status', 1)->where(
                'status',
                1
            )->where('class_id', $student_detail->class_id)->where('section_id', $student_detail->section_id)
                // ->where('date', 'like', date('Y-m-d'))->where('start_time', '<', $now)->where('end_time', '>', $now)
                ->where('school_id', Auth::user()->school_id)->get();
        } else {
            $online_exams = SmOnlineExam::where('active_status', 1)->where(
                'status',
                1
            )->where('class_id', $student_detail->class_id)->where('section_id', $student_detail->section_id)
                // ->where('date', 'like', date('Y-m-d'))->where('start_time', '<', $now)->where('end_time', '>', $now)
                ->where('school_id', Auth::user()->school_id)->get();
        }




        $teachers = SmAssignSubject::select('teacher_id')->where('class_id', $student_detail->class_id)
            ->where('section_id', $student_detail->section_id)->distinct('teacher_id')->where('school_id', Auth::user()->school_id)->get();


        $month = date('m');
        $year = date('Y');
        // return $year;

        $attendances = SmStudentAttendance::where('student_id', $student_detail->id)
            ->where('attendance_date', 'like', $year . '-' . $month . '%')
            ->where('attendance_type', '=', 'P')->where('school_id', Auth::user()->school_id)->get();
        // return $attendances;


        $holidays = SmHoliday::where('active_status', 1)

            ->where('school_id', Auth::user()->school_id)
            ->get();



        $events = SmEvent::where('active_status', 1)

            ->where('school_id', Auth::user()->school_id)
            ->where(function ($q) {
                $q->where('for_whom', 'All')->orWhere('for_whom', 'Student');
            })
            ->get();


        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['student_detail'] = $student_detail->toArray();
            $data['fees_assigneds'] = $fees_assigneds->toArray();
            $data['fees_discounts'] = $fees_discounts->toArray();
            $data['exams'] = $exams->toArray();
            $data['grades'] = $grades->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }

        return view('backEnd.studentPanel.studentProfile', compact('totalSubjects', 'totalNotices', 'online_exams', 'teachers', 'attendances', 'student_detail', 'fees_assigneds', 'fees_discounts', 'exams', 'grades', 'events', 'holidays'));
        /*        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }*/
    }

    public function studentsDocumentApi(Request $request, $id)
    {
        try {
            $student_detail = SmStudent::where('user_id', $id)->first();
            $documents = SmStudentDocument::where('student_staff_id', $student_detail->id)->where('type', 'stu')
                ->select('title', 'file')
                ->where('school_id', Auth::user()->school_id)->get();

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = [];
                $data['student_detail'] = $student_detail->toArray();
                $data['documents'] = $documents->toArray();
                return ApiBaseMethod::sendResponse($data, null);
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function classRoutine(Request $request, $id = null)
    {
        try {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $user_id = $id;
            } else {
                $user = Auth::user();

                if ($user) {
                    $user_id = $user->id;
                } else {
                    $user_id = $request->user_id;
                }
            }

            $student_detail = SmStudent::where('user_id', $user_id)->first();
            //return $student_detail;
            $class_id = $student_detail->class_id;
            $section_id = $student_detail->section_id;

            $sm_weekends = SmWeekend::orderBy('order', 'ASC')->where('active_status', 1)->where('school_id', Auth::user()->school_id)->get();

            $class_times = SmClassTime::where('type', 'class')->where('school_id', Auth::user()->school_id)->get();

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = [];
                $data['student_detail'] = $student_detail->toArray();
                // $data['class_id'] = $class_id;
                // $data['section_id'] = $section_id;
                // $data['sm_weekends'] = $sm_weekends->toArray();
                // $data['class_times'] = $class_times->toArray();

                $weekenD = SmWeekend::all();
                foreach ($weekenD as $row) {
                    $data[$row->name] = DB::table('sm_class_routine_updates')
                        ->select('sm_class_times.period', 'sm_class_times.start_time', 'sm_class_times.end_time', 'sm_subjects.subject_name', 'sm_class_rooms.room_no')
                        ->join('sm_classes', 'sm_classes.id', '=', 'sm_class_routine_updates.class_id')
                        ->join('sm_sections', 'sm_sections.id', '=', 'sm_class_routine_updates.section_id')
                        ->join('sm_class_times', 'sm_class_times.id', '=', 'sm_class_routine_updates.class_period_id')
                        ->join('sm_subjects', 'sm_subjects.id', '=', 'sm_class_routine_updates.subject_id')
                        ->join('sm_class_rooms', 'sm_class_rooms.id', '=', 'sm_class_routine_updates.room_id')

                        ->where([
                            ['sm_class_routine_updates.class_id', $class_id], ['sm_class_routine_updates.section_id', $section_id], ['sm_class_routine_updates.day', $row->id],
                        ])->where('sm_class_routine_updates.academic_id', getAcademicId())->where('sm_classesschool_id', Auth::user()->school_id)->get();
                }

                return ApiBaseMethod::sendResponse($data, null);
            }

            return view('backEnd.studentPanel.class_routine', compact('class_times', 'class_id', 'section_id', 'sm_weekends'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function studentResult($id)
    {
        try {
            $levels = SmCourseRegistration::where('student_id', '=', $id)
                ->where('uploaded', '=', 1)
                ->join('sm_sections', function ($join) {
                    $join->on('sm_course_registrations.section', '=', 'sm_sections.id');
                })
                ->groupBy('section')
                ->get();
            $current_section = SmStudent::where('id', $id)->first()->section_id;
            return view('backEnd.studentPanel.student_result', compact('levels', 'id', 'current_section'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function studentExamSchedule()
    {
        try {
            $student_detail = Auth::user()->student;
            $exam_dates = SmExamSchedule::where('class_id', $student_detail->class_id)->where('section_id', $student_detail->section_id)->groupby('day')->get();
            return view('backEnd.studentPanel.exam_schedule', compact('exam_dates'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function studentExamScheduleSearch(Request $request)
    {
        $request->validate([
            'exam' => 'required',
        ]);

        try {
            $student_detail = Auth::user()->student;

            $assign_subjects = SmAssignSubject::where('class_id', $student_detail->class_id)->where('section_id', $student_detail->section_id)
                ->where('school_id', Auth::user()->school_id)->get();

            if ($assign_subjects->count() == 0) {
                Toastr::error('No Subject Assigned.', 'Failed');
                return redirect('student-exam-schedule');
            }

            $exams = SmExam::where('active_status', 1)->where('school_id', Auth::user()->school_id)->get();
            $class_id = $student_detail->class_id;
            $section_id = $student_detail->section_id;
            $exam_id = $request->exam;

            $exam_types = SmExamType::where('school_id', Auth::user()->school_id)->where('active_status', 1)->get();
            $exam_periods = SmClassTime::where('type', 'exam')->where('school_id', Auth::user()->school_id)->get();
            $exam_schedule_subjects = "";
            $assign_subject_check = "";

            return view('backEnd.studentPanel.exam_schedule', compact('exams', 'assign_subjects', 'class_id', 'section_id', 'exam_id', 'exam_schedule_subjects', 'assign_subject_check', 'exam_types', 'exam_periods'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function studentExamScheduleApi(Request $request, $id)
    {
        try {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $student_detail = SmStudent::where('user_id', $id)->first();
                // $assign_subjects = SmAssignSubject::where('class_id', $student_detail->class_id)->where('section_id', $student_detail->section_id)->where('school_id',Auth::user()->school_id)->get();
                $exam_schedule = DB::table('sm_exam_schedules')
                    ->join('sm_students', 'sm_students.class_id', '=', 'sm_exam_schedules.class_id')
                    ->join('sm_exam_types', 'sm_exam_types.id', '=', 'sm_exam_schedules.exam_term_id')
                    ->join('sm_exam_schedule_subjects', 'sm_exam_schedule_subjects.exam_schedule_id', '=', 'sm_exam_schedules.id')
                    ->join('sm_subjects', 'sm_subjects.id', '=', 'sm_exam_schedules.subject_id')
                    ->select('sm_subjects.subject_name', 'sm_exam_schedule_subjects.start_time', 'sm_exam_schedule_subjects.end_time', 'sm_exam_schedule_subjects.date', 'sm_exam_schedule_subjects.room', 'sm_exam_schedules.class_id', 'sm_exam_schedules.section_id')
                    //->where('sm_students.class_id', '=', 'sm_exam_schedules.class_id')

                    ->where('sm_exam_schedules.section_id', '=', $student_detail->section_id)
                    ->where('sm_exam_schedulesacademic_id', getAcademicId())->where('sm_exam_schedules.school_id', Auth::user()->school_id)->get();
                return ApiBaseMethod::sendResponse($exam_schedule, null);
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function studentViewExamSchedule($id)
    {
        try {
            $user = Auth::user();
            $student_detail = SmStudent::where('user_id', $user->id)->first();
            $class = SmClass::find($student_detail->class_id);
            $section = SmSection::find($student_detail->section_id);
            $assign_subjects = SmExamScheduleSubject::where('exam_schedule_id', $id)->where('school_id', Auth::user()->school_id)->get();

            return view('backEnd.examination.view_exam_schedule_modal', compact('class', 'section', 'assign_subjects'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function studentMyAttendance()
    {
        try {
            $academic_years = SmAcademicYear::where('active_status', '=', 1)->where('school_id', Auth::user()->school_id)->get();
            // return $academic_years;
            return view('backEnd.studentPanel.student_attendance', compact('academic_years'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function studentHomework(Request $request, $id = null)
    {
        try {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $student_detail = SmStudent::where('user_id', $id)->first();

                $class_id = $student_detail->class->id;
                $subject_list = SmAssignSubject::where([['class_id', $class_id], ['section_id', $student_detail->section_id]])->where('school_id', Auth::user()->school_id)->get();

                $i = 0;
                foreach ($subject_list as $subject) {
                    $homework_subject_list[$subject->subject->subject_name] = $subject->subject->subject_name;
                    $allList[$subject->subject->subject_name] = DB::table('sm_homeworks')
                        ->leftjoin('sm_subjects', 'sm_subjects.id', '=', 'sm_homeworks.subject_id')
                        ->where('class_id', $student_detail->class_id)->where('section_id', $student_detail->section_id)
                        ->where('subject_id', $subject->subject_id)->where('sm_homeworks.school_id', Auth::user()->school_id)->get()->toArray();;
                }

                foreach ($allList as $single) {
                    foreach ($single as $singleHw) {
                        $std_homework = DB::table('sm_homework_students')
                            ->select('homework_id', 'complete_status')
                            ->where('homework_id', '=', $singleHw->id)
                            ->where('student_id', '=', $student_detail->id)
                            ->where('complete_status', 'C')

                            ->where('sm_homework_students.school_id', Auth::user()->school_id)
                            ->first();

                        $d['description'] = $singleHw->description;
                        $d['subject_name'] = $singleHw->subject_name;
                        $d['homework_date'] = $singleHw->homework_date;
                        $d['submission_date'] = $singleHw->submission_date;
                        $d['evaluation_date'] = $singleHw->evaluation_date;
                        $d['file'] = $singleHw->file;
                        $d['marks'] = $singleHw->marks;

                        if (!empty($std_homework)) {
                            $d['status'] = 'C';
                        } else {
                            $d['status'] = 'I';
                        }
                        $kijanidibo[] = $d;
                    }
                }
                // return $kijanidibo;

                $homeworkLists = SmHomework::where('class_id', $student_detail->class_id)->where('section_id', $student_detail->section_id)
                    ->where('school_id', Auth::user()->school_id)->get();
            } else {
                $user = Auth::user();
                $student_detail = SmStudent::where('user_id', $user->id)->first();
                $homeworkLists = SmHomework::where('class_id', $student_detail->class_id)->where('section_id', $student_detail->section_id)
                    ->where('sm_homeworks.academic_id', getAcademicId())->where('school_id', Auth::user()->school_id)->get();
            }
            $data = [];

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {

                $data = $kijanidibo;
                return ApiBaseMethod::sendResponse($data, null);
            }
            // return getAcademicId();
            return view('backEnd.studentPanel.student_homework', compact('homeworkLists', 'student_detail'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function studentHomeworkView($class_id, $section_id, $homework_id)
    {
        try {
            $homeworkDetails = SmHomework::where('class_id', '=', $class_id)->where('section_id', '=', $section_id)->where('id', '=', $homework_id)->first();
            return view('backEnd.studentPanel.studentHomeworkView', compact('homeworkDetails', 'homework_id'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function addHomeworkContent($homework_id)
    {
        try {
            return view('backEnd.studentPanel.addHomeworkContent', compact('homework_id'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function deleteViewHomeworkContent($homework_id)
    {
        try {

            return view('backEnd.studentPanel.deleteHomeworkContent', compact('homework_id'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function deleteHomeworkContent($homework_id)
    {
        try {
            //    return $homework_id;
            $user = Auth::user();
            $student_detail = SmStudent::where('user_id', $user->id)->first();
            $contents = SmUploadHomeworkContent::where('student_id', $student_detail->id)->where('homework_id', $homework_id)->get();
            foreach ($contents as $key => $content) {
                if ($content->file != "") {
                    if (file_exists($content->file)) {
                        unlink($content->file);
                    }
                }
                $content->delete();
            }

            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function uploadHomeworkContent(Request $request)
    {
        // $input = $request->all();
        // $validator = Validator::make($input, [
        //     'files' => "mimes:pdf,doc,docx,jpg,jpeg,png,mp4,mp3,txt",
        // ]);


        // if ($validator->fails()) {
        //     Toastr::warning('Unsupported file upload', 'Failed');
        //     return redirect()->back();
        // }

        if ($request->file('files') == "") {
            Toastr::error('No file uploaded', 'Failed');
            return redirect()->back();
        }
        try {
            $user = Auth::user();
            $student_detail = SmStudent::where('user_id', $user->id)->first();
            $data = [];
            foreach ($request->file('files') as $key => $file) {
                $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/homeworkcontent/', $fileName);
                $fileName = 'public/uploads/homeworkcontent/' . $fileName;
                $data[$key] = $fileName;
            }
            $all_filename = json_encode($data);
            $content = new SmUploadHomeworkContent();
            $content->file = $all_filename;
            $content->student_id = $student_detail->id;
            $content->homework_id = $request->id;
            $content->school_id = Auth::user()->school_id;
            $content->academic_id = getAcademicId();
            $content->save();

            $homework_info = SmHomeWork::find($request->id);
            $teacher_info = $teacher_info = User::find($homework_info->created_by);

            $notification = new SmNotification;
            $notification->user_id = $teacher_info->id;
            $notification->role_id = $teacher_info->role_id;
            $notification->date = date('Y-m-d');
            $notification->message = Auth::user()->student->full_name . ' ' . app('translator')->get('lang.submitted_homework');
            $notification->school_id = Auth::user()->school_id;
            $notification->save();

            try {
                $user = User::find($teacher_info->id);
                Notification::send($user, new StudentHomeworkSubmitNotification($notification));
            } catch (\Exception $e) {
                Log::info($e->getMessage());
            }

            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function uploadContentView(Request $request, $id)
    {
        try {
            $ContentDetails = SmTeacherUploadContent::where('id', $id)->where('school_id', Auth::user()->school_id)->first();
            return view('backEnd.studentPanel.uploadContentDetails', compact('ContentDetails'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }


    public function studentAssignment()
    {
        try {
            $user = Auth::user();

            $student_detail = SmStudent::where('user_id', $user->id)->first();

            $uploadContents = SmTeacherUploadContent::where('content_type', 'as')
                ->where(function ($query) use ($student_detail) {
                    $query->where('available_for_all_classes', 1)
                        ->orWhere([['class', $student_detail->class_id], ['section', $student_detail->section_id]]);
                })->where('school_id', Auth::user()->school_id)->get();
            if (Auth()->user()->role_id != 1) {
                if ($user->role_id == 2) {
                    SmNotification::where('user_id', $user->student->id)->where('role_id', 2)->update(['is_read' => 1]);
                }
            }

            $uploadContents2 = SmTeacherUploadContent::where('content_type', 'as')
                ->where('class', $student_detail->class_id)

                ->where('school_id', Auth::user()->school_id)
                ->get();

            return view('backEnd.studentPanel.assignmentList', compact('uploadContents', 'uploadContents2'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function studentAssignmentApi(Request $request, $id)
    {
        try {
            $student_detail = SmStudent::where('user_id', $id)->first();
            $uploadContents = SmTeacherUploadContent::where('content_type', 'as')
                ->select('content_title', 'upload_date', 'description', 'upload_file')
                ->where(function ($query) use ($student_detail) {
                    $query->where('available_for_all_classes', 1)
                        ->orWhere([['class', $student_detail->class_id], ['section', $student_detail->section_id]]);
                })->where('school_id', Auth::user()->school_id)->get();

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = [];
                $data['student_detail'] = $student_detail->toArray();
                $data['uploadContents'] = $uploadContents->toArray();
                return ApiBaseMethod::sendResponse($data, null);
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function studentStudyMaterial()
    {

        try {
            $user = Auth::user();
            $student_detail = SmStudent::where('user_id', $user->id)->first();

            $uploadContents = SmTeacherUploadContent::where('content_type', 'st')
                ->where(function ($query) use ($student_detail) {
                    $query->where('available_for_all_classes', 1)
                        ->orWhere([['class', $student_detail->class_id], ['section', $student_detail->section_id]]);
                })->where('school_id', Auth::user()->school_id)->get();

            return view('backEnd.studentPanel.studyMetarialList', compact('uploadContents'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function studentSyllabus()
    {
        try {
            $user = Auth::user();
            $student_detail = SmStudent::where('user_id', $user->id)->first();

            $uploadContents = SmTeacherUploadContent::where('content_type', 'sy')
                ->where(function ($query) use ($student_detail) {
                    $query->where('available_for_all_classes', 1)
                        ->orWhere([['class', $student_detail->class_id], ['section', $student_detail->section_id]]);
                })->where('school_id', Auth::user()->school_id)->get();

            $uploadContents2 = SmTeacherUploadContent::where('content_type', 'ot')
                ->where('class', $student_detail->class_id)

                ->where('school_id', Auth::user()->school_id)
                ->get();

            return view('backEnd.studentPanel.studentSyllabus', compact('uploadContents', 'uploadContents2'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function othersDownload()
    {
        try {
            $user = Auth::user();
            $student_detail = SmStudent::where('user_id', $user->id)->first();
            $uploadContents = SmTeacherUploadContent::where('content_type', 'ot')
                ->where(function ($query) use ($student_detail) {
                    $query->where('available_for_all_classes', 1)
                        ->orWhere([['class', $student_detail->class_id], ['section', $student_detail->section_id]]);
                })->where('school_id', Auth::user()->school_id)->get();

            $uploadContents2 = SmTeacherUploadContent::where('content_type', 'ot')
                ->where('class', $student_detail->class_id)

                ->where('school_id', Auth::user()->school_id)
                ->get();



            return view('backEnd.studentPanel.othersDownload', compact('uploadContents', 'uploadContents2'));
        } catch (\Exception $e) {

            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function studentSubject()
    {
        try {
            $user = Auth::user();
            $student_detail = SmStudent::where('user_id', $user->id)->first();
            $assignSubjects = SmAssignSubject::where('class_id', $student_detail->class_id)->where('section_id', $student_detail->section_id)->where('school_id', Auth::user()->school_id)->get();
            return view('backEnd.studentPanel.student_subject', compact('assignSubjects'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    //Student Subject API
    public function studentSubjectApi(Request $request, $id)
    {
        try {
            $student = SmStudent::where('user_id', $id)->first();
            $assignSubjects = DB::table('sm_assign_subjects')
                ->leftjoin('sm_subjects', 'sm_subjects.id', '=', 'sm_assign_subjects.subject_id')
                ->leftjoin('sm_staffs', 'sm_staffs.id', '=', 'sm_assign_subjects.teacher_id')
                ->select('sm_subjects.subject_name', 'sm_subjects.subject_code', 'sm_subjects.subject_type', 'sm_staffs.full_name as teacher_name')
                ->where('sm_assign_subjects.class_id', '=', $student->class_id)
                ->where('sm_assign_subjects.section_id', '=', $student->section_id)
                ->where('sm_assign_subjects.academic_id', getAcademicId())->where('sm_assign_subjects.school_id', Auth::user()->school_id)->get();
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = [];
                $data['student_subjects'] = $assignSubjects->toArray();
                return ApiBaseMethod::sendResponse($data, null);
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    //student panel Transport
    public function studentTransport()
    {
        try {
            $user = Auth::user();
            $student_detail = SmStudent::where('user_id', $user->id)->first();

            // $routes = SmAssignVehicle::where('active_status', 1)->where('school_id',Auth::user()->school_id)->get();
            $routes = SmAssignVehicle::join('sm_vehicles', 'sm_assign_vehicles.vehicle_id', 'sm_vehicles.id')
                ->join('sm_students', 'sm_vehicles.id', 'sm_students.vechile_id')
                ->where('sm_assign_vehicles.active_status', 1)
                ->where('sm_students.user_id', Auth::user()->id)
                ->where('sm_assign_vehicles.school_id', Auth::user()->school_id)
                ->get();


            return view('backEnd.studentPanel.student_transport', compact('routes', 'student_detail'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function studentTransportViewModal($r_id, $v_id)
    {
        try {
            $vehicle = SmVehicle::find($v_id);
            $route = SmRoute::find($r_id);
            return view('backEnd.studentPanel.student_transport_view_modal', compact('route', 'vehicle'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }



    public function studentBookList()
    {
        try {
            $books = SmBook::where('active_status', 1)
                ->orderBy('id', 'DESC')
                ->where('school_id', Auth::user()->school_id)->get();
            return view('backEnd.studentPanel.studentBookList', compact('books'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function studentBookIssue()
    {
        try {
            $user = Auth::user();
            $student_detail = SmStudent::where('user_id', $user->id)->first();
            // $books = SmBook::select('id', 'book_title')->where('active_status', 1)->where('school_id',Auth::user()->school_id)->get();
            // $subjects = SmSubject::select('id', 'subject_name')->where('active_status', 1)->where('school_id',Auth::user()->school_id)->get();
            $library_member = SmLibraryMember::where('member_type', 2)->where('student_staff_id', $student_detail->user_id)->first();
            if (empty($library_member)) {
                Toastr::error('You are not library member ! Please contact with librarian', 'Failed');
                return redirect()->back();
                // return redirect()->back()->with('message-danger', 'You are not library member ! Please contact with librarian');
            }
            $issueBooks = SmBookIssue::where('member_id', $library_member->student_staff_id)
                ->leftjoin('sm_books', 'sm_books.id', 'sm_book_issues.book_id')
                ->leftjoin('library_subjects', 'library_subjects.id', 'sm_books.book_subject_id')
                ->where('sm_book_issues.issue_status', 'I')
                ->where('sm_book_issues.school_id', Auth::user()->school_id)
                ->get();

            return view('backEnd.studentPanel.studentBookIssue', compact('issueBooks'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function studentNoticeboard(Request $request)
    {
        try {
            $data = [];
            $allNotices = SmNoticeBoard::where('active_status', 1)->where('inform_to', 'LIKE', '%2%')
                ->orderBy('id', 'DESC')
                ->where('school_id', Auth::user()->school_id)->get();
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data['allNotices'] = $allNotices->toArray();
                return ApiBaseMethod::sendResponse($data, null);
            }
            return view('backEnd.studentPanel.studentNoticeboard', compact('allNotices'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function studentTeacher()
    {
        try {
            $user = Auth::user();
            $student_detail = SmStudent::where('user_id', $user->id)->first();
            $teachers = SmAssignSubject::select('teacher_id')->where('class_id', $student_detail->class_id)
                ->where('section_id', $student_detail->section_id)->distinct('teacher_id')->where('school_id', Auth::user()->school_id)->get();
            return view('backEnd.studentPanel.studentTeacher', compact('teachers'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function studentTeacherApi(Request $request, $id)
    {
        try {
            $student = SmStudent::where('user_id', $id)->first();

            $assignTeacher = DB::table('sm_assign_subjects')
                ->leftjoin('sm_subjects', 'sm_subjects.id', '=', 'sm_assign_subjects.subject_id')
                ->leftjoin('sm_staffs', 'sm_staffs.id', '=', 'sm_assign_subjects.teacher_id')
                //->select('sm_subjects.subject_name', 'sm_subjects.subject_code', 'sm_subjects.subject_type', 'sm_staffs.full_name')
                ->select('sm_staffs.full_name', 'sm_staffs.email', 'sm_staffs.mobile')
                ->where('sm_assign_subjects.class_id', '=', $student->class_id)
                ->where('sm_assign_subjects.section_id', '=', $student->section_id)
                ->where('sm_assign_subjects.school_id', Auth::user()->school_id)->get();

            $class_teacher = DB::table('sm_class_teachers')
                ->join('sm_assign_class_teachers', 'sm_assign_class_teachers.id', '=', 'sm_class_teachers.assign_class_teacher_id')
                ->join('sm_staffs', 'sm_class_teachers.teacher_id', '=', 'sm_staffs.id')
                ->where('sm_assign_class_teachers.class_id', '=', $student->class_id)
                ->where('sm_assign_class_teachers.section_id', '=', $student->section_id)
                ->where('sm_assign_class_teachers.active_status', '=', 1)
                ->select('full_name')
                ->first();
            $settings = SmGeneralSettings::find(1);
            if (@$settings->phone_number_privacy == 1) {
                $permission = 1;
            } else {
                $permission = 0;
            }

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = [];
                $data['teacher_list'] = $assignTeacher->toArray();
                $data['class_teacher'] = $class_teacher;
                $data['permission'] = $permission;
                return ApiBaseMethod::sendResponse($data, null);
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }


    public function studentLibrary(Request $request, $id)
    {
        try {
            $student = SmStudent::where('user_id', $id)->first();
            $issueBooks = DB::table('sm_book_issues')
                ->leftjoin('sm_books', 'sm_books.id', '=', 'sm_book_issues.book_id')
                ->where('sm_book_issues.member_id', '=', $student->user_id)
                ->where('sm_book_issues.school_id', Auth::user()->school_id)->get();
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = [];
                $data['issueBooks'] = $issueBooks->toArray();
                return ApiBaseMethod::sendResponse($data, null);
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function studentDormitoryApi(Request $request)
    {
        try {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $studentDormitory = DB::table('sm_room_lists')
                    ->join('sm_dormitory_lists', 'sm_room_lists.dormitory_id', '=', 'sm_dormitory_lists.id')
                    ->join('sm_room_types', 'sm_room_lists.room_type_id', '=', 'sm_room_types.id')
                    ->select('sm_dormitory_lists.dormitory_name', 'sm_room_lists.name as room_number', 'sm_room_lists.number_of_bed', 'sm_room_lists.cost_per_bed', 'sm_room_lists.active_status')->where('sm_room_lists.school_id', Auth::user()->school_id)->get();

                return ApiBaseMethod::sendResponse($studentDormitory, null);
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function studentTimelineApi(Request $request, $id)
    {
        try {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                //$timelines = SmStudentTimeline::where('staff_student_id', $id)->first();
                $timelines = DB::table('sm_student_timelines')
                    ->leftjoin('sm_students', 'sm_students.id', '=', 'sm_student_timelines.staff_student_id')
                    ->where('sm_student_timelines.type', '=', 'stu')
                    ->where('sm_student_timelines.active_status', '=', 1)
                    ->where('sm_students.user_id', '=', $id)
                    ->select('title', 'date', 'description', 'file', 'sm_student_timelines.active_status')
                    ->where('sm_student_timelines.academic_id', getAcademicId())->where('sm_students.school_id', Auth::user()->school_id)->get();
                return ApiBaseMethod::sendResponse($timelines, null);
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function examListApi(Request $request, $id)
    {
        try {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {

                $student = SmStudent::where('user_id', $id)->first();
                // return  $student;
                $exam_List = DB::table('sm_exam_types')
                    ->join('sm_exams', 'sm_exams.exam_type_id', '=', 'sm_exam_types.id')
                    ->where('sm_exams.class_id', '=', $student->class_id)
                    ->where('sm_exams.section_id', '=', $student->section_id)
                    ->distinct()
                    ->select('sm_exam_types.id as exam_id', 'sm_exam_types.title as exam_name')
                    ->where('sm_exam_types.school_id', Auth::user()->school_id)->get();
                return ApiBaseMethod::sendResponse($exam_List, null);
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function examScheduleApi(Request $request, $id, $exam_id)
    {
        try {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $student = SmStudent::where('user_id', $id)->first();
                $exam_schedule = DB::table('sm_exam_schedules')
                    ->join('sm_exam_types', 'sm_exam_types.id', '=', 'sm_exam_schedules.exam_term_id')
                    // ->join('sm_exam_types','sm_exam_types.id','=','sm_exam_schedules.exam_term_id' )
                    ->join('sm_subjects', 'sm_subjects.id', '=', 'sm_exam_schedules.subject_id')
                    ->join('sm_class_rooms', 'sm_class_rooms.id', '=', 'sm_exam_schedules.room_id')
                    ->join('sm_class_times', 'sm_class_times.id', '=', 'sm_exam_schedules.exam_period_id')
                    ->where('sm_exam_schedules.exam_term_id', '=', $exam_id)
                    ->where('sm_exam_schedules.school_id', '=', $student->school_id)
                    ->where('sm_exam_schedules.class_id', '=', $student->class_id)
                    ->where('sm_exam_schedules.section_id', '=', $student->section_id)
                    ->where('sm_exam_schedules.active_status', '=', 1)
                    ->select('sm_exam_types.id', 'sm_exam_types.title as exam_name', 'sm_subjects.subject_name', 'date', 'sm_class_rooms.room_no', 'sm_class_times.start_time', 'sm_class_times.end_time')
                    ->where('sm_exam_schedules.school_id', Auth::user()->school_id)->get();
                return ApiBaseMethod::sendResponse($exam_schedule, null);
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function examResultApi(Request $request, $id, $exam_id)
    {
        try {
            $data = [];

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $student = SmStudent::where('user_id', $id)->first();
                $exam_result = DB::table('sm_result_stores')
                    ->join('sm_exam_types', 'sm_exam_types.id', '=', 'sm_result_stores.exam_type_id')
                    ->join('sm_exams', 'sm_exams.id', '=', 'sm_exam_types.id')
                    ->join('sm_subjects', 'sm_subjects.id', '=', 'sm_result_stores.subject_id')
                    ->where('sm_exams.id', '=', $exam_id)
                    ->where('sm_result_stores.school_id', '=', $student->school_id)
                    ->where('sm_result_stores.class_id', '=', $student->class_id)
                    ->where('sm_result_stores.section_id', '=', $student->section_id)
                    ->where('sm_result_stores.student_id', '=', $student->id)
                    ->select('sm_exams.id', 'sm_exam_types.title as exam_name', 'sm_subjects.subject_name', 'sm_result_stores.total_marks as obtained_marks', 'sm_exams.exam_mark as total_marks', 'sm_result_stores.total_gpa_grade as grade')
                    ->where('sm_exams.school_id', Auth::user()->school_id)->get();

                $data['exam_result'] = $exam_result->toArray();
                $data['pass_marks'] = 0;

                return ApiBaseMethod::sendResponse($data, null);
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function updatePassowrdStoreApi(Request $request)
    {
        try {
            $user = User::find($request->id);

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {


                if (Hash::check($request->current_password, $user->password)) {

                    $user->password = Hash::make($request->new_password);
                    $result = $user->save();
                    $msg = "Password Changed Successfully ";
                    return ApiBaseMethod::sendResponse(null, $msg);
                } else {
                    $msg = "You Entered Wrong Current Password";
                    return ApiBaseMethod::sendError(null, $msg);
                }
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    function leaveApply(Request $request)
    {
        try {
            $user = Auth::user();

            if ($user) {
                $my_leaves = SmLeaveDefine::where('role_id', $user->role_id)->where('user_id', $user->id)->where('school_id', Auth::user()->school_id)->get();
                $apply_leaves = SmLeaveRequest::where('staff_id', $user->id)->where('role_id', $user->role_id)->where('active_status', 1)->where('school_id', Auth::user()->school_id)->get();
                // return $apply_leaves;
                $leave_types = SmLeaveDefine::where('role_id', $user->role_id)->where('user_id', $user->id)->where('active_status', 1)->where('school_id', Auth::user()->school_id)->get();
            } else {
                $my_leaves = SmLeaveDefine::where('role_id', $request->role_id)->where('school_id', Auth::user()->school_id)->get();
                $apply_leaves = SmLeaveRequest::where('role_id', $request->role_id)->where('active_status', 1)->where('school_id', Auth::user()->school_id)->get();
                $leave_types = SmLeaveDefine::where('role_id', $request->role_id)->where('active_status', 1)->where('school_id', Auth::user()->school_id)->get();
            }

            return view('backEnd.student_leave.apply_leave', compact('apply_leaves', 'leave_types', 'my_leaves'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function leaveStore(Request $request)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $request->validate([
            'apply_date' => "required",
            'leave_type' => "required",
            'leave_from' => 'required|before_or_equal:leave_to',
            'leave_to' => "required",
            'attach_file' => "sometimes|nullable|mimes:pdf,doc,docx,jpg,jpeg,png,txt",
        ]);
        try {
            $maxFileSize = SmGeneralSettings::first('file_size')->file_size;
            $file = $request->file('attach_file');
            $fileSize =  filesize($file);
            $fileSizeKb = ($fileSize / 1000000);
            if ($fileSizeKb >= $maxFileSize) {
                Toastr::error('Max upload file size ' . $maxFileSize . ' Mb is set in system', 'Failed');
                return redirect()->back();
            }
            $input = $request->all();
            $fileName = "";
            if ($request->file('attach_file') != "") {
                $file = $request->file('attach_file');
                $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/leave_request/', $fileName);
                $fileName = 'public/uploads/leave_request/' . $fileName;
            }
            $user = Auth()->user();
            if ($user) {
                $login_id = $user->id;
                $role_id = $user->role_id;
            } else {
                $login_id = $request->login_id;
                $role_id = $request->role_id;
            }
            $apply_leave = new SmLeaveRequest();
            $apply_leave->staff_id = $login_id;
            $apply_leave->role_id = $role_id;
            $apply_leave->apply_date = date('Y-m-d', strtotime($request->apply_date));
            $apply_leave->leave_define_id = $request->leave_type;
            $apply_leave->type_id = $request->leave_type;
            $apply_leave->leave_from = date('Y-m-d', strtotime($request->leave_from));
            $apply_leave->leave_to = date('Y-m-d', strtotime($request->leave_to));
            $apply_leave->approve_status = 'P';
            $apply_leave->reason = $request->reason;
            $apply_leave->file = $fileName;
            $apply_leave->academic_id = getAcademicId();
            $apply_leave->school_id = Auth::user()->school_id;
            $result = $apply_leave->save();

            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function pendingLeave(Request $request)
    {
        try {
            $apply_leaves = SmLeaveRequest::where([['active_status', 1], ['approve_status', 'P']])->where('school_id', Auth::user()->school_id)->get();
            $leave_types = SmLeaveType::where('active_status', 1)->where('school_id', Auth::user()->school_id)->get();
            $roles = InfixRole::where('id', 2)->where(function ($q) {
                $q->where('school_id', Auth::user()->school_id)->orWhere('type', 'System');
            })->get();
            $pendingRequest = SmLeaveRequest::where('sm_leave_requests.active_status', 1)
                ->select('sm_leave_requests.id', 'full_name', 'apply_date', 'leave_from', 'leave_to', 'reason', 'file', 'sm_leave_types.type', 'approve_status')
                ->join('sm_leave_defines', 'sm_leave_requests.leave_define_id', '=', 'sm_leave_defines.id')
                ->join('sm_staffs', 'sm_leave_requests.staff_id', '=', 'sm_staffs.id')
                ->leftjoin('sm_leave_types', 'sm_leave_requests.type_id', '=', 'sm_leave_types.id')
                ->where('sm_leave_requests.approve_status', '=', 'P')
                ->where('sm_leave_requests.academic_id', getAcademicId())->where('sm_leave_requests.school_id', Auth::user()->school_id)->get();
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = [];
                $data['pending_request'] = $pendingRequest->toArray();
                return ApiBaseMethod::sendResponse($data, null);
            }
            return view('backEnd.student_leave.pending_leave', compact('apply_leaves', 'leave_types', 'roles'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function studentLeaveEdit(request $request, $id)
    {
        try {
            $user = Auth::user();
            if ($user) {
                $my_leaves = SmLeaveDefine::where('role_id', $user->role_id)->where('school_id', Auth::user()->school_id)->get();
                $apply_leaves = SmLeaveRequest::where('role_id', $user->role_id)->where('active_status', 1)->where('school_id', Auth::user()->school_id)->get();
                $leave_types = SmLeaveDefine::where('role_id', $user->role_id)->where('active_status', 1)->where('school_id', Auth::user()->school_id)->get();
            } else {
                $my_leaves = SmLeaveDefine::where('role_id', $request->role_id)->where('school_id', Auth::user()->school_id)->get();
                $apply_leaves = SmLeaveRequest::where('role_id', $request->role_id)->where('active_status', 1)->where('school_id', Auth::user()->school_id)->get();
                $leave_types = SmLeaveDefine::where('role_id', $request->role_id)->where('active_status', 1)->where('school_id', Auth::user()->school_id)->get();
            }
            $apply_leave = SmLeaveRequest::find($id);
            return view('backEnd.student_leave.apply_leave', compact('apply_leave', 'apply_leaves', 'leave_types', 'my_leaves'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $request->validate([
            'apply_date' => "required",
            'leave_type' => "required",
            'leave_from' => 'required|before_or_equal:leave_to',
            'leave_to' => "required",
            'file' => "sometimes|nullable|mimes:pdf,doc,docx,jpg,jpeg,png",
        ]);
        try {
            $maxFileSize = SmGeneralSettings::first('file_size')->file_size;
            $file = $request->file('attach_file');
            $fileSize =  filesize($file);
            $fileSizeKb = ($fileSize / 1000000);
            if ($fileSizeKb >= $maxFileSize) {
                Toastr::error('Max upload file size ' . $maxFileSize . ' Mb is set in system', 'Failed');
                return redirect()->back();
            }
            $fileName = "";
            if ($request->file('attach_file') != "") {
                $apply_leave = SmLeaveRequest::find($request->id);
                if (file_exists($apply_leave->file)) unlink($apply_leave->file);
                $file = $request->file('attach_file');
                $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/leave_request/', $fileName);
                $fileName = 'public/uploads/leave_request/' . $fileName;
            }


            $user = Auth()->user();

            if ($user) {
                $login_id = $user->id;
                $role_id = $user->role_id;
            } else {
                $login_id = $request->login_id;
                $role_id = $request->role_id;
            }

            $apply_leave = SmLeaveRequest::find($request->id);
            $apply_leave->staff_id = $login_id;
            $apply_leave->role_id = $role_id;
            $apply_leave->apply_date = date('Y-m-d', strtotime($request->apply_date));
            $apply_leave->leave_define_id = $request->leave_type;
            $apply_leave->leave_from = date('Y-m-d', strtotime($request->leave_from));
            $apply_leave->leave_to = date('Y-m-d', strtotime($request->leave_to));
            $apply_leave->approve_status = 'P';
            $apply_leave->reason = $request->reason;
            if ($fileName != "") {
                $apply_leave->file = $fileName;
            }
            $result = $apply_leave->save();
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect('student-apply-leave');
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    function DownlodTimeline($file_name)
    {

        try {
            $file = public_path() . '/uploads/student/timeline/' . $file_name;
            if (file_exists($file)) {
                return Response::download($file);
            } else {
                Toastr::error('File not found', 'Failed');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    function DownlodDocument($file_name)
    {

        try {
            $file = public_path() . '/uploads/homework/' . $file_name;
            if (file_exists($file)) {
                return Response::download($file);
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    function DownlodContent($file_name)
    {
        try {
            $file = public_path() . '/uploads/upload_contents/' . $file_name;
            if (file_exists($file)) {
                return Response::download($file);
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    function DownlodStudentDocument($file_name)
    {
        try {
            $file = public_path() . '/uploads/student/document/' . $file_name;
            if (file_exists($file)) {
                return Response::download($file);
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function downloadHomeWorkContent($id, $student_id)
    {
        try {
            $student = SmStudent::where('id', $student_id)->first();
            if (Auth::user()->role_id == 2) {
                $student = SmStudent::where('user_id', $student_id)->first();
            }
            $hwContent = SmUploadHomeworkContent::where('student_id', $student->id)->where('homework_id', $id)->get();
            // $file_array= json_decode($hwContent->file, true);
            // $files = $file_array;
            // $zipname = 'Homework_Content_'.time().'.zip';
            // $zip = new ZipArchive;
            // $zip->open($zipname, ZipArchive::CREATE);
            //     foreach ($files as $file) {
            //         $zip->addFile($file);
            //     }
            // $zip->close();
            // header('Content-Type: application/zip');
            // header('Content-disposition: attachment; filename='.$zipname);
            // header('Content-Length: ' . filesize($zipname));
            // readfile($zipname);
            // File::delete($zipname);


            $file_paths = [];
            foreach ($hwContent as $key => $files_row) {
                $only_files = json_decode($files_row->file);
                foreach ($only_files as $second_key => $upload_file_path) {
                    $file_paths[] = $upload_file_path;
                }
            }
            $zip_file_name = str_replace(' ', '_', time() . '.zip'); // Name of our archive to download


            $new_file_array = [];
            foreach ($file_paths as $key => $file) {

                $file_name_array = explode('/', $file);
                $file_original = $file_name_array[array_key_last($file_name_array)];
                $new_file_array[$key]['path'] = $file;
                $new_file_array[$key]['name'] = $file_original;
            }
            $public_dir = public_path('uploads/homeworkcontent');
            $zip = new ZipArchive;
            if ($zip->open($public_dir . '/' . $zip_file_name, ZipArchive::CREATE) === TRUE) {
                // Add Multiple file   
                foreach ($new_file_array as $key => $file) {
                    $zip->addFile($file['path'], @$file['name']);
                }
                $zip->close();
            }

            $zip_file_url = asset('public/uploads/homeworkcontent/' . $zip_file_name);
            session()->put('homework_zip_file', $zip_file_name);

            return Redirect::to($zip_file_url);
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function courseRegistration()
    {
        if (generalSetting()->course_registration == 0) {
            Toastr::error('Course Registration not Allowed', 'Failed');
            return redirect()->back();
        } else {
            // if (Auth::user()->student->owes()) {
            //     Toastr::error('Payment of school fees is required', 'Failed');
            //     return redirect('student-fees');
            // }

        try {
            $user = Auth::user();
            $session = SmAcademicYear::find(getAcademicId());
            $student_detail = SmStudent::where('user_id', $user->id)->first();
            $student_id =  $student_detail->id;
            $studentFaculty = @$student_detail->class->faculty->id;

            $first_semester_courses = SmSubject::where('active_status', 1)
                ->where('subject_type', 'F')
                ->where('class_id', $student_detail->class_id)
                ->where('section_id', $student_detail->section_id)
                ->get();

            $first_semester_elective_courses = SmSubject::where('active_status', 1)
                ->where('subject_type', 'F')
                ->where('class_id', 0)
                ->where('section_id', $student_detail->section_id)
                ->get();

            $first_semester_general_courses = SmSubject::where('active_status', 1)
                ->where('subject_type', 'F')
                ->where('class_id', -1)
                ->where('faculty_id', $studentFaculty)
                ->where('section_id', $student_detail->section_id)
                ->get();

            // $first_semester_carryover_courses = SmCourseRegistration::where('student_id', $student_id)
            //     ->where('semester', 'F')
            //     ->where('grade', 'F')
            //     ->where('uploaded', 1)
            //     ->join('sm_subjects', 'sm_course_registrations.subject_id', '=', 'sm_subjects.id')
            //     ->get();


            $second_semester_courses = SmSubject::where('active_status', 1)
                ->where('subject_type', 'S')
                ->where('class_id', $student_detail->class_id)
                ->where('section_id', $student_detail->section_id)
                ->get();

            $second_semester_elective_courses = SmSubject::where('active_status', 1)
                ->where('subject_type', 'S')
                ->where('class_id', 0)
                ->where('section_id', $student_detail->section_id)
                ->get();

            $second_semester_general_courses = SmSubject::where('active_status', 1)
                ->where('subject_type', 'S')
                ->where('class_id', -1)
                ->where('faculty_id', $studentFaculty)
                ->where('section_id', $student_detail->section_id)
                ->get();

            // $second_semester_carryover_courses = SmCourseRegistration::where('student_id', $student_id)
            //     ->where('semester', 'S')
            //     ->where('grade', 'F')
            //     ->where('uploaded', 1)
            //     ->join('sm_subjects', 'sm_course_registrations.subject_id', '=', 'sm_subjects.id')
            //     ->get();

            //return view('backEnd.studentPanel.course_registration', compact('student_detail', 'first_semester_courses', 'first_semester_elective_courses', 'first_semester_general_courses', 'first_semester_carryover_courses', 'second_semester_courses', 'second_semester_elective_courses', 'second_semester_general_courses', 'second_semester_carryover_courses', 'session'));

            return view('backEnd.studentPanel.course_registration', compact('student_detail', 'first_semester_courses', 'first_semester_elective_courses', 'first_semester_general_courses', 'second_semester_courses', 'second_semester_elective_courses', 'second_semester_general_courses', 'session'));

            } catch (\Exception $e) {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        }
    }
    public function courseRegistrationStore(Request $request)
    {
        try {

            $user = Auth::user();
            $student_detail = SmStudent::with(['class', 'section'])->where('user_id', $user->id)->first();

            $student_id =  $student_detail->id;
            $section_id = $student_detail->section_id;
            $semester = $request->semester;

            if (($student_detail->first_semester_reg == 0 && $semester == "F") ||  ($student_detail->second_semester_reg == 0 && $semester == "S")) {
                $subjects = $request->subjects;
                for ($i = 0; $i < count($subjects); $i++) {
                    $course_registration = new SmCourseRegistration();
                    $course_registration->student_id = $student_id;
                    $course_registration->subject_id = $subjects[$i];
                    $course_registration->semester = $semester;
                    $course_registration->section = $section_id;
                    $course_registration->save();
                    $course_registration->toArray();
                }

                $registered_courses = SmCourseRegistration::where('student_id', '=', $student_id)
                    ->where('uploaded', '=', 0)
                    ->where('semester', $semester)
                    ->join('sm_subjects', 'sm_course_registrations.subject_id', 'sm_subjects.id')
                    ->get();


                $compact =  ['student' => $student_detail, 'registered_courses' => $registered_courses, 'semester' => $semester];

                //return view("parentregistration::course_registration", compact('compact'));

                $pdf = \App::make('dompdf.wrapper');
                $pdf->loadHTML(view("parentregistration::course_registration", compact('compact'))->render());
                $course_doc =  'public/uploads/student/document/Course-Registration-' . md5(time()) . '.' . 'pdf';

                if ($semester == "F") {
                    SmStudent::where('id', $student_id)
                        ->update(['first_semester_reg' => 1, 'first_course_registration' => $course_doc]);
                } else {
                    SmStudent::where('id', $student_id)
                        ->update(['second_semester_reg' => 1, 'second_course_registration' => $course_doc]);
                }
                $pdf->save($course_doc);
                return redirect('/' . $course_doc);
            } else {

                $registered_courses = SmCourseRegistration::where('student_id', '=', $student_id)
                    ->where('uploaded', '=', 0)
                    ->where('semester', '=', $semester)
                    ->join('sm_subjects', 'sm_course_registrations.subject_id', 'sm_subjects.id')
                    ->get();


                $compact =  ['student' => $student_detail, 'registered_courses' => $registered_courses, 'semester' => $semester];

                //return view("parentregistration::course_registration", compact('compact'));

                $pdf = \App::make('dompdf.wrapper');
                $pdf->loadHTML(view("parentregistration::course_registration", compact('compact'))->render());
                return $pdf->stream();
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function transcriptApplication()
    {
        try {
            $transcript_cost = getCost(3);

            $user = Auth::user();
            $student_detail = SmStudent::with(['class'])->where('user_id', $user->id)->first();

            $has_application = 0;

            if (DB::table('sm_transcript_applications')->where('student_id', $student_detail->id)->exists()) {
                $has_application = 1;
            }

            return view('backEnd.studentPanel.transcript_application', compact('student_detail', 'transcript_cost', 'has_application', 'user'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function transcriptApplicationTwo(Request $request)
    {

        $user = Auth::user();

        if (DB::table('sm_transcript_applications')->where('student_id', $user->student->id)->exists()) {
            return redirect('transcript-application');
        }

        // $request->validate(array_map(fn ($data) => [$data => ['required']], $request->except(['document_file_1', 'document_file_2'])));

        Session::put('payment_type', $request->payment_type);
        Session::put('names', $request->first_name . ' ' . $request->last_name);
        Session::put('phone_number', $request->phone_number);
        Session::put('email', $request->email);
        Session::put('department', $request->department);
        Session::put('entry_year', $request->entry_year);
        Session::put('graduation_year', $request->graduation_year);
        Session::put('nationality', $request->nationality);
        Session::put('institution_name', $request->institution_name);
        Session::put('institution_address', $request->institution_address);
        Session::put('institution_country', $request->institution_country);
        Session::put('institution_email', $request->institution_email);
        Session::put('institution_office', $request->institution_office);

        if ($request->hasFile('document_file_2')) {
            if (file_exists(Session::get('ssce'))) {
                File::delete(Session::get('ssce'));
            }
            $file = $request->file('document_file_2');
            $fileName = 'Transcript-SSCE' . md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/student/document/', $fileName);
            $docName = 'public/uploads/student/document/' . $fileName;
            // $data->ssce =  $imageName;
            Session::put('ssce', $docName);
        }

        if ($request->hasFile('document_file_1')) {
            if (file_exists(Session::get('statement'))) {
                File::delete(Session::get('statement'));
            }
            $file = $request->file('document_file_1');
            $fileName = 'Transcript-statement' . md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/student/document/', $fileName);
            $docName = 'public/uploads/student/document/' . $fileName;
            // $data->statement =  $imageName;
            Session::put('statement', $docName);
        }

        $transcript_cost = getCost(3);

        $student_detail = SmStudent::with(['class'])->where('user_id', $user->id)->first();

        return view('backEnd.studentPanel.transcript_application_2', compact('student_detail', 'transcript_cost', 'user'));
    }

    public function transcriptApplicationThree(Request $request)
    {
        $user = Auth::user();

        if (DB::table('sm_transcript_applications')->where('student_id', $user->student->id)->exists()) {
            return redirect('transcript-application');
        }

        $transactionId = $request->transactionId;
        $paymentReference   = $request->paymentReference;

        if ($transactionId == "" || $paymentReference == "") {
            Toastr::error('Invalid Transaction', 'Failed');
            return redirect()->back();
        }

        $amount = getCost(3);

        $data = Remita::checkStatus($transactionId)[0];

        if ($data->message == "SUCCESS" && $data->amount == $amount) {

            $digit = new NumberFormatter("en", NumberFormatter::SPELLOUT);

            $session = SmAcademicYear::where('id', getAcademicId())->first()->title;

            $payment = [
                'amount' => $amount,
                'amount_in_words' => $digit->format($amount),
                'session' => $session,
                'type'    => 'Transcript',
                'serial_no' => $transactionId
            ];

            //todo show hostel receipt
            $file =  'public/uploads/student/document/Transcript-Payment-' . md5(time()) . '.' . 'pdf';
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML(view("backEnd.studentPanel.student_receipt", compact('user', 'payment'))->render());
            $pdf->setPaper('A4', 'portrait');
            $pdf->save($file);

            $transcriptData['student_id'] = $user->student->id;
            $transcriptData['names'] =  Session::get('names');
            $transcriptData['phone_number'] = Session::get('phone_number');
            $transcriptData['email'] = Session::get('email');
            $transcriptData['department'] = Session::get('department');
            $transcriptData['entry_year'] = Session::get('entry_year');
            $transcriptData['graduation_year'] = Session::get('graduation_year');
            $transcriptData['nationality'] = Session::get('nationality');
            $transcriptData['institution_name'] = Session::get('institution_name');
            $transcriptData['institution_address'] = Session::get('institution_address');
            $transcriptData['institution_country'] = Session::get('institution_country');
            $transcriptData['institution_email'] = Session::get('institution_email');
            $transcriptData['institution_office'] = Session::get('institution_office');
            $transcriptData['ssce'] = Session::get('ssce');
            $transcriptData['statement'] = Session::get('statement');

            $this->collectFee($amount, 'Transcript', 3, $user, $transactionId, $file, 'Remita');

            DB::table('sm_transcript_applications')->insert($transcriptData);

            return redirect('/' . $file);
        } else {
            Toastr::error('Payment could not be verified, try again', 'Failed');
            return redirect()->back();
        }
    }

    public function statementResult()
    {
        try {
            $application_cost = getCost(5);

            $user = Auth::user();
            $student_detail = SmStudent::with(['class'])->where('user_id', $user->id)->first();
            $has_application = 0;

            if (DB::table('sm_statement_result_applications')->where('student_id', $student_detail->id)->exists()) {
                $has_application = 1;
            }
            return view('backEnd.studentPanel.statement_result', compact('student_detail', 'application_cost', 'has_application'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function statementResultTwo(Request $request)
    {
        $user = Auth::user();

        if (DB::table('sm_statement_result_applications')->where('student_id', $user->student->id)->exists()) {
            return redirect('statement-result');
        }

        // $request->validate(array_map(fn ($data) => [$data => ['required']], $request->all()));

        Session::put('payment_type', $request->payment_type);
        Session::put('names', $request->first_name . ' ' . $request->last_name);
        Session::put('phone_number', $request->phone_number);
        Session::put('email', $request->email);
        Session::put('department', $request->department);
        Session::put('graduation_year', $request->graduation_year);

        $application_cost = getCost(5);

        $student_detail = SmStudent::with(['class'])->where('user_id', $user->id)->first();
        $has_application = 0;

        if (DB::table('sm_statement_result_applications')->where('student_id', $student_detail->id)->exists()) {
            $has_application = 1;
        }

        return view('backEnd.studentPanel.statement_result_2', compact('student_detail', 'application_cost', 'has_application', 'user'));
    }

    public function statementResultThree(Request $request)
    {
        $user = Auth::user();

        if (DB::table('sm_statement_result_applications')->where('student_id', $user->student->id)->exists()) {
            return redirect('statement-result');
        }

        $transactionId = $request->transactionId;
        $paymentReference   = $request->paymentReference;

        if ($transactionId == "" || $paymentReference == "") {
            Toastr::error('Invalid Transaction', 'Failed');
            return redirect()->back();
        }

        $amount = getCost(5);

        $data = Remita::checkStatus($transactionId)[0];

        if ($data->message == "SUCCESS" && $data->amount == $amount) {

            $digit = new NumberFormatter("en", NumberFormatter::SPELLOUT);

            $session = SmAcademicYear::where('id', getAcademicId())->first()->title;

            $payment = [
                'amount' => $amount,
                'amount_in_words' => $digit->format($amount),
                'session' => $session,
                'type'    => 'Statement of Result',
                'serial_no' => $transactionId
            ];

            //todo show hostel receipt
            $file =  'public/uploads/student/document/Statement-of-Result-Payment-' . md5(time()) . '.' . 'pdf';
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML(view("backEnd.studentPanel.student_receipt", compact('user', 'payment'))->render());
            $pdf->setPaper('A4', 'portrait');
            $pdf->save($file);

            $statementData['student_id'] = $user->student->id;
            $statementData['names'] =  Session::get('names');
            $statementData['phone_number'] = Session::get('phone_number');
            $statementData['email'] = Session::get('email');
            $statementData['department'] = Session::get('department');
            $statementData['graduation_year'] = Session::get('graduation_year');

            $this->collectFee($amount, 'Statement of Result', 5, $user, $transactionId, $file, 'Remita');

            DB::table('sm_statement_result_applications')->insert($statementData);

            return redirect('/' . $file);
        } else {
            Toastr::error('Payment could not be verified, try again', 'Failed');
            return redirect()->back();
        }
    }

    public function studentDormitory()
    {

        if (generalSetting()->hostel_booking == 0) {
            Toastr::error('Hostel Booking not Allowed', 'Failed');
            return redirect()->back();
        } else {

            if (Auth::user()->student->owes()) {
                Toastr::error('Payment of school fees is required', 'Failed');
                return redirect('student-fees');
            }

            $allocation = SmRoomAllocation::where('user_id', Auth::user()->id);
            $status = $allocation->exists();

            if (Auth::user()->booking()->count() && !$status) {
                $roomId = Auth::user()->booking->first()->room_id;
                return redirect('student-dormitory/room-allocation/' . $roomId);
            }

            $booking_cost = getCost(4);

            $user = Auth::user();

            $room  = @$allocation->first()->room;

            return view('backEnd.studentPanel.student_dormitory', compact('booking_cost', 'user', 'status', 'room'));
        }
    }

    public function studentDormitoryBooking(Request $request)
    {
        $transactionId = $request->transactionId;
        $paymentReference   = $request->paymentReference;

        if ($transactionId == "" || $paymentReference == "") {
            Toastr::error('Invalid Transaction', 'Failed');
            return redirect()->back();
        }

        $booking_cost = getCost(4);

        $data = Remita::checkStatus($transactionId)[0];

        if ($data->message == "SUCCESS" && $data->amount == $booking_cost) {
            $roomId = $this->getAvailableRoom();
            $this->bookRoom($roomId);
            Toastr::success('Operation successful', 'Success');
            return redirect('student-dormitory/room-allocation/' . $roomId);
        } else {
            Toastr::error('Payment could not be verified, try again', 'Failed');
            return redirect()->back();
        }
    }

    public function getAvailableRoom()
    {
        $gender = Auth::user()->student->gender_id ? 'G' : 'B';
        $room = SmDormitoryList::whereType($gender)->first()->rooms->random(1)->first()->id;
        if (SmRoomAllocation::whereRoomId($room)->count() >= SmRoomList::find($room)->number_of_bed) {
            $this->getAvailableRoom();
        } else {
            return $room;
        }
    }

    public function bookRoom($roomId)
    {
        Auth::user()->booking()->updateOrCreate(
            [
                'user_id' => Auth::user()->id
            ],
            [
                'room_id' => $roomId,
                'expires_at' => \Carbon\Carbon::now()->addDay(),
            ]
        );
        return true;
    }

    public function studentRoomAllocation($roomId)
    {
        if (SmRoomAllocation::where('user_id', Auth::user()->id)->exists()) {
            Toastr::error('Already alloted a room', 'Failed');
            return redirect('student-dormitory');
        }
        $room = SmRoomList::find($roomId)->first();
        $user = Auth::user();
        return view('backEnd.studentPanel.student_room_allocation', compact('room', 'user'));
    }

    public function cancelBooking()
    {
        Auth::user()->booking()->delete();
        Toastr::success('Operation successful', 'Success');
        return redirect('student-dormitory');
    }

    public function studentAllocateRoom(Request $request)
    {
        $transactionId = $request->transactionId;
        $paymentReference   = $request->paymentReference;

        if ($transactionId == "" || $paymentReference == "") {
            Toastr::error('Invalid Transaction', 'Failed');
            return redirect()->back();
        }

        $user = Auth::user();

        $room = @$user->booking->room->first();

        $data = Remita::checkStatus($transactionId)[0];

        if ($data->message == "SUCCESS" && $data->amount == $room->cost_per_bed) {
            SmRoomAllocation::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'room_id' => $room->id,
                ],
                [
                    'user_id' => $user->id,
                    'room_id' => $room->id,
                    'expires_at' => \Carbon\Carbon::now()->addYear(),
                ]
            );


            $digit = new NumberFormatter("en", NumberFormatter::SPELLOUT);
            $session = SmAcademicYear::where('id', getAcademicId())->first()->title;
            $payment = [
                'amount' => $room->cost_per_bed,
                'amount_in_words' => $digit->format($room->cost_per_bed),
                'session' => $session,
                'type'    => 'Accomodation Fee',
                'serial_no' => $transactionId
            ];

            //todo show hostel receipt
            $file =  'public/uploads/student/document/Hostel-Payment-' . md5(time()) . '.' . 'pdf';
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML(view("backEnd.studentPanel.student_receipt", compact('room', 'user', 'payment'))->render());
            $pdf->setPaper('A4', 'portrait');
            $pdf->save($file);

            $this->collectFee($room->cost_per_bed, 'Accomodation', 4, $user, $transactionId, $file, 'Remita', $room->id);

            return redirect('/' . $file);
        } else {
            Toastr::error('Payment could not be verified, try again', 'Failed');
            return redirect()->back();
        }
    }

    public function collectFee(
        $amount,
        $paymentType,
        $feesTypeId,
        $user,
        $transactionId,
        $file,
        $paymentMode,
        $roomId = 0,
        $assignId = null
    ) {
        $income_head = generalSetting();
        $fees_payment = new SmFeesPayment();
        $fees_payment->fees_type_id = $feesTypeId;
        $fees_payment->payment_type = $paymentType;
        $fees_payment->academic_id = getAcademicId();
        $fees_payment->student_id = $user->student->id;
        $fees_payment->discount_amount = 0;
        $fees_payment->fine = 0;
        $fees_payment->amount = $amount;
        $fees_payment->payment_date = date('Y-m-d');
        $fees_payment->payment_mode = $paymentMode;
        $fees_payment->school_id = $user->school_id;
        $fees_payment->transaction_id = $transactionId;
        $fees_payment->receipt = $file;
        $fees_payment->email = $user->email;
        $fees_payment->room_id = $roomId;
        $fees_payment->assign_id = $assignId;
        $fees_payment->save();

        $add_income = new SmAddIncome();
        $add_income->name = $paymentType;
        $add_income->date = date('Y-m-d');
        $add_income->amount = $amount;
        $add_income->fees_collection_id = $fees_payment->id;
        $add_income->active_status = 1;
        $add_income->income_head_id = $income_head->income_head_id;
        $add_income->payment_method_id = 5;
        $add_income->created_by = 0;
        $add_income->school_id = 1;
        $add_income->academic_id = getAcademicId();
        $add_income->save();

        return true;
    }

    public function payFeesTwo(Request $request)
    {
        $user = Auth::user();
        $fee = SmFeesAssign::find($request->id);

        $transactionId = $request->transactionId;
        $paymentReference   = $request->paymentReference;

        if ($transactionId == "" || $paymentReference == "") {
            Toastr::error('Invalid Transaction', 'Failed');
            return redirect()->back();
        }

        $amount = $fee->fees_amount;

        $data = Remita::checkStatus($transactionId)[0];

        if ($data->message == "SUCCESS" && $data->amount == $amount) {

            $digit = new NumberFormatter("en", NumberFormatter::SPELLOUT);

            $session = SmAcademicYear::where('id', getAcademicId())->first()->title;

            $payment = [
                'amount' => $amount,
                'amount_in_words' => $digit->format($amount),
                'session' => $session,
                'type'    => $fee->feesGroupMaster->feesTypes->name,
                'serial_no' => $transactionId
            ];

            //todo show hostel receipt
            $file =  'public/uploads/student/document/Fees-Payment-' . md5(time()) . '.' . 'pdf';
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML(view("backEnd.studentPanel.student_receipt", compact('user', 'payment'))->render());
            $pdf->setPaper('A4', 'portrait');
            $pdf->save($file);

            $this->collectFee($amount, $fee->feesGroupMaster->feesTypes->name, $fee->feesGroupMaster->id, $user, $transactionId, $file, 'Remita', 0,  $request->id);

            return redirect('/' . $file);
        } else {
            Toastr::error('Payment could not be verified, try again', 'Failed');
            return redirect()->back();
        }
    }
}
