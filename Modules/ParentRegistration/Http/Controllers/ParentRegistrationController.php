<?php

namespace Modules\ParentRegistration\Http\Controllers;

use App\User;
use App\SmClass;
use App\SmParent;
use App\SmSchool;
use App\SmSection;
use App\SmStudent;
use App\SmUserLog;
use App\SmBaseSetup;
use App\SmAcademicYear;
use App\SmClassSection;
use App\SmEmailSetting;
use App\SmNotification;
use App\SmGeneralSettings;
use App\InfixModuleManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Modules\ParentRegistration\Entities\SmRegistrationSetting;
use Modules\ParentRegistration\Entities\SmStudentRegistration;
use PDF;




class ParentRegistrationController extends Controller
{
    private $User;
    private $SmGeneralSettings;
    private $SmUserLog;
    private $InfixModuleManager;
    private $URL;
    private $TYPE;

    public function __construct()
    {
       // $this->middleware('auth');
        $this->middleware('PM');

        $this->User                 = json_encode(User::find(1));
        $this->SmGeneralSettings    = json_encode(SmGeneralSettings::find(1));
        $this->SmUserLog            = json_encode(SmUserLog::find(1));
        // $this->InfixModuleManager   = json_encode(InfixModuleManager::find(1));
        $this->URL                  = url('/');
        $this->TYPE                 = 1;
    }


    public function index()
    {
        try {
            return view('parentregistration::index');
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function about()
    {

        try {
            $data = \App\InfixModuleManager::where('name', 'ParentRegistration')->first();
            return view('parentregistration::index', compact('data'));
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }


    public function settings()
    {
        $setting = SmRegistrationSetting::find(1);
        return view('parentregistration::settings', compact('setting'));
    }

    public function create()
    {
        try {
            return view('parentregistration::create');
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }


    public function show($id)
    {
        try {
            return view('parentregistration::show');
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    


    public function edit($id)
    {
        try {
            return view('parentregistration::edit');
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }



    // new student registration form view method
    public function registration($utme_number)
    {
        try {

            $payment_status = DB::table("sm_fees_payments")->where('utme_number', $utme_number)->first();
            if(DB::table("sm_fees_payments")->where('utme_number', $utme_number)->exists()  && !SmStudentRegistration::where('utme_number', $utme_number)->exists()){
                $schools = SmSchool::all();
                $classes = SmClass::all();
                $academic_years = SmAcademicYear::where('active_status', 1)->get();
                $genders = SmBaseSetup::where('active_status', '=', '1')->where('base_group_id', '=', '1')->get();
                $reg_setting = SmRegistrationSetting::find(1);
                $email = $payment_status->email;

                return view('parentregistration::registration', compact('schools', 'classes', 'academic_years', 'genders', 'reg_setting','utme_number','email'));

            }else if(DB::table("sm_fees_payments")->where('utme_number', $utme_number)->exists() && SmStudentRegistration::where('utme_number', $utme_number)->exists()){
                Toastr::error('Already applied', 'Failed');
                return redirect()->to('post-utme');
            }else{
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->to('post-utme');
            }

        } catch (\Exception $e) {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->to('post-utme');
        }
    }


    // get academic year for parent registration for saas using ajax
    public function getClasAcademicyear(Request $request)
    {
        $classes = [];
        $academic_years = SmAcademicYear::where('school_id', $request->id)->get();
        return response()->json([$classes, $academic_years]);
    }

    // Get section for new registration by ajax
    public function getSection(Request $request)
    {
        try {
            $sectionIds = SmClassSection::where('class_id', '=', $request->id)->get();
            $sections = [];
            foreach ($sectionIds as $sectionId) {
                $sections[] = SmSection::find($sectionId->section_id);
            }
            return response()->json($sections);
        } catch (\Exception $e) {
            return response()->json("", 404);
        }
    }


    // Get class for regular school and saas for new student registration
    public function getClasses(Request $request)
    {
        $academic_year = SmAcademicYear::where('id', $request->id)->first();
        if (isset($request->school_id)) {
            $classes = SmClass::where('active_status', '=', '1')->where('created_at', 'LIKE', '%' . $academic_year->year . '%')->where('school_id', $request->school_id)->get();
        } else {
            $classes = SmClass::where('active_status', '=', '1')->where('created_at', 'LIKE', '%' . $academic_year->year . '%')->where('school_id', Auth::user()->school_id)->get();
        }
        return response()->json([$classes, $academic_year]);
    }

    // new stduent registration store in temporary table for review
    public function studentStore(request $request)
    {
        $reg_setting = SmRegistrationSetting::find(1);
        $input = $request->all();
        //dd($request);

       


       $validator = Validator::make($input, [
            'class' => "required",
            'academic_year' => "required",
            'section' => 'required',
            'first_name' => "required|alpha",
            'last_name' => "required|alpha",
            'gender' => "required",
            'student_email' => "required|email",
            'student_mobile' => "required",
            'date_of_birth' => "required",
            'guardian_name' => "required",
            'relationButton' => "required",
            'guardian_email' => 'required|different:student_email',
            'guardian_mobile' => "required",
            'utme_number' => "required",
            'utme_score' => "required",
            'document_file_1' => "required|mimes:pdf,doc,docx,jpg,jpeg,png",
            'document_file_2' => "required|mimes:pdf,doc,docx,jpg,jpeg,png",
            'document_file_3' => "required|mimes:pdf,doc,docx,jpg,jpeg,png",
            'photo' => "required|mimes:jpg,jpeg,png",
        ]);

        if(User::where('email', $request->student_email)->exists())
        {
            $validator->getMessageBag()->add('student_email', 'Email already registered');
        }

        if(SmStudentRegistration::where('utme_number', $request->utme_number)->exists() || SmStudent::where('utme_number', $request->utme_number)->exists()){
            $validator->getMessageBag()->add('utme_number', 'UTME (J.A.M.B) Number already registered');
        }


        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        

        try {

            $student = new SmStudentRegistration();
            $student->class_id = $request->class;
            $student->academic_id = $request->academic_year;
            $student->section_id = $request->section;
            $student->first_name = $request->first_name;
            $student->last_name = $request->last_name;
            $student->gender_id = $request->gender;
            $student->student_email = $request->student_email;
            $student->student_mobile = $request->student_mobile;
            $student->guardian_name = $request->guardian_name;
            $student->guardian_relation = $request->relationButton;
            $student->guardian_email = $request->guardian_email;
            $student->guardian_mobile = $request->guardian_mobile;
            $student->utme_score = $request->utme_score;
            $student->utme_number = $request->utme_number;
            $student->date_of_birth = date('Y-m-d', strtotime($request->date_of_birth));
            $student->age = date('Y') - date('Y',strtotime($request->date_of_birth));

            $student->utme_result = "";
            if ($request->file('document_file_1') != "") {
                $maxFileSize = SmGeneralSettings::first('file_size')->file_size;
                $file = $request->file('document_file_1');
                $fileSize =  filesize($file);
                $fileSizeKb = ($fileSize / 1000000);
                if($fileSizeKb >= $maxFileSize){
                    Toastr::error( 'Max upload file size '. $maxFileSize .' Mb is set in system', 'Failed');
                    return redirect()->back();
                }
                $file = $request->file('document_file_1');
                $student->utme_result = 'UTME-' . md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/student/document/', $student->utme_result);
                $student->utme_result =  'public/uploads/student/document/' . $student->utme_result;
            }

            $student->ssce_result = "";
            if ($request->file('document_file_2') != "") {
                $maxFileSize = SmGeneralSettings::first('file_size')->file_size;
                $file = $request->file('document_file_2');
                $fileSize =  filesize($file);
                $fileSizeKb = ($fileSize / 1000000);
                if($fileSizeKb >= $maxFileSize){
                    Toastr::error( 'Max upload file size '. $maxFileSize .' Mb is set in system', 'Failed');
                    return redirect()->back();
                }
                $file = $request->file('document_file_2');
                $student->ssce_result = 'SSCE-' . md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/student/document/', $student->ssce_result);
                $student->ssce_result =  'public/uploads/student/document/' . $student->ssce_result;
            }

            $student->guarantors_letter =""; 
            if ($request->file('document_file_3') != "") {
                $maxFileSize = SmGeneralSettings::first('file_size')->file_size;
                $file = $request->file('document_file_3');
                $fileSize =  filesize($file);
                $fileSizeKb = ($fileSize / 1000000);
                if($fileSizeKb >= $maxFileSize){
                    Toastr::error( 'Max upload file size '. $maxFileSize .' Mb is set in system', 'Failed');
                    return redirect()->back();
                }
                $file = $request->file('document_file_3');
                $student->guarantors_letter = 'GF-' . md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/student/document/', $student->guarantors_letter);
                $student->guarantors_letter =  'public/uploads/student/document/' . $student->guarantors_letter;
            }

            $student->student_photo = "";
            if ($request->file('photo') != "") {
                $maxFileSize = SmGeneralSettings::first('file_size')->file_size;
                $file = $request->file('photo');
                $fileSize =  filesize($file);
                $fileSizeKb = ($fileSize / 1000000);
                if($fileSizeKb >= $maxFileSize){
                    Toastr::error( 'Max upload file size '. $maxFileSize .' Mb is set in system', 'Failed');
                    return redirect()->back();
                }
                $file = $request->file('photo');
                $student->student_photo = 'photo-' . md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/student/', $student->student_photo);
                $student->student_photo =  'public/uploads/student/' . $student->student_photo;
            }


            if (moduleStatusCheck('Saas') == TRUE) {
                $student->school_id = $request->school;
            }

            
            $student->save();

            if(!empty($request->school)){
                $school = SmSchool::find($student->school_id);
            }
            else{
                $school = SmSchool::first();
            }

            $users = User::where('role_id',1)->where('school_id', $school->id)->get();
            $setting = SmRegistrationSetting::find(1);
            foreach($users as $user){
                $notification = new SmNotification();
                $notification->message = "New Apllicant Registration";
                $notification->is_read = 0;
                $notification->user_id = $user->id;
                $notification->role_id = 1;
                $notification->school_id = $school->id;
                $notification->academic_id = $student->academic_year;
                $notification->date = date('Y-m-d');
                $notification->save();
            }

        
            $setting = SmRegistrationSetting::find(1);

            if (!empty($request->school)) {
                $school_admins = SmSchool::find($request->school);
                $school_admin['email'] =  $school_admins->email;
                $school_admin['school_name'] =  $school_admins->school_name;
                
                try{
                     $receiver_email = $school_admins->email;
                     $receiver_name =  $school_admins->school_name;
                     $subject= $school_admin['school_name'] . ' '. 'Have New Registration';
                     $view ="parentregistration::school_admin_email";
                     $compact['compact'] =  array('email' => $school_admins->email,'school_name' => $school_admins->school_name); 
                     @send_mail($receiver_email, $receiver_name, $subject , $view ,$compact);



                }catch(\Exception $e){
                    Log::info($e->getMessage());
                }
            }



            Toastr::success('You have successfully completed the registration.', 'Successful');
            return redirect()->to('parentregistration/registration-success');


        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    
    }

    public function registrationSuccess(){
        return view('parentregistration::registrationSuccess');
    }

    // Show student list for new registration
    public function applicants()
    {
        $classes = SmClass::all();
        return view('parentregistration::applicants', compact('classes'));
    }

    // Show student list for new registration
    public function applicantsSearch(Request $request)
    {

        $students = SmStudentRegistration::query();

        $students->where('school_id', Auth::user()->school_id);

        if ($request->cut_off_mark != "") {
            $students->where('utme_score','>', $request->cut_off_mark);
        }

        if ($request->class != "") {
            $students->where('class_id', $request->class);
        }
        if ($request->section != "") {
            $students->where('section_id', $request->section);
        }
        $students = $students->orderBy('id', 'desc');
        $students = $students->get();


        $classes = SmClass::all();



        return view('parentregistration::applicants', compact('students', 'classes'));
    }




    // Show student list for new registration
    public function saasStudentList()
    {
        $institutions  = SmSchool::all();
        return view('parentregistration::saas_student_list', compact('institutions'));
    }


    // Show student list for new registration
    public function saasStudentListsearch(Request $request)
    {
        $students = SmStudentRegistration::query();

        if ($request->institution != "") {
            $students->where('school_id', $request->institution);
        }

        if ($request->academic_year != "") {
            $students->where('academic_id', $request->academic_year);
        }

        if ($request->class != "") {
            $students->where('class_id', $request->class);
        }
        if ($request->section != "") {
            $students->where('section_id', $request->section);
        }
        $students = $students->orderBy('id', 'desc');
        $students = $students->get();

        $institutions = SmSchool::all();
        $institution_id = $request->institution;
        return view('parentregistration::saas_student_list', compact('students', 'institution_id', 'institutions'));

    }


    // Approve method for new student regis., after successfully then the student will delete from tempo. stduent table
    public function studentApprove(Request $request)
    {
        DB::beginTransaction();
        try {
            $temp_id = $request->id;
            $request = SmStudentRegistration::find($request->id);
            $student_table_detail = SmStudent::where('school_id', $request->school_id)->max('admission_no');
            $ac_year = SmAcademicYear::where('id', $request->academic_id)->first()->year;

            $student_table_detail_roll = SmStudent::where('class_id', $request->class_id)
                                        ->where('section_id', $request->section_id)
                                        ->where('school_id', $request->school_id)
                                        ->max('roll_no');

            if ($student_table_detail == 0) {
                $admission_no = 1;
            } else {
                $admission_no = $student_table_detail + 1;
            }

            if ($student_table_detail_roll == 0) {
                $roll_no = 1;
            } else {
                $roll_no = $student_table_detail_roll + 1;
            }

            $created_year = $request->academicYear->year . '-01-01 12:00:00';
            $matric_number = 'NDAG/'.$ac_year.'/'.str_pad($admission_no, 4, '0', STR_PAD_LEFT);
            // stduent user
            $user_stu = new User();
            $user_stu->role_id = 2;
            $user_stu->full_name = ucwords($request->first_name . ' ' . $request->last_name);
            $user_stu->username = $matric_number;
            $user_stu->email = $request->student_email;
            $user_stu->created_at = $created_year;
            $user_stu->school_id = $request->school_id;
            $user_stu->password = Hash::make(123456);
            $user_stu->save();
            $user_stu->toArray();




            $compact =  ['name'=>$user_stu->full_name,'email' => $user_stu->email, 'slug' => 'student','password' => '123456'];

            $receiver_email = $user_stu->email;
            $receiver_name =  $user_stu->full_name;
            $subject= "Admission Status";
            $view ="parentregistration::approve_email";

            Session::put('applicants_fullname', ucwords($request->first_name . ' ' . $request->last_name));
            Session::put('applicants_email', $request->student_email);
            // instantiate and use the dompdf class

            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML(view("parentregistration::admission_letter", compact('compact'))->render());
            $admission_letter =  'public/uploads/student/document/Admission-Letter-' . md5(time()). '.' . 'pdf';
            $pdf->save($admission_letter);

            

            $student = new SmStudent();

            $student->class_id = $request->class_id;
            $student->section_id = $request->section_id;

            $student->admission_date = date('Y-m-d');

            $student->user_id = $user_stu->id;

            $student->role_id = 2;

            $student->admission_no = $admission_no;

            $student->roll_no = $roll_no;

            $student->first_name = $request->first_name;
            $student->last_name = $request->last_name;
            $student->full_name = $user_stu->full_name;

            $student->gender_id = $request->gender_id;

            $student->date_of_birth = date('Y-m-d', strtotime($request->date_of_birth));
            $student->age = $request->age;
            $student->email = $request->student_email;
            $student->mobile = $request->student_mobile;
            $student->created_at = $created_year;

            $student->school_id = $request->school_id;

            $student->session_id = $request->academic_id;
            $student->academic_id = $request->academic_id;
            //documents
            $student->document_title_1 = 'UTME Result';
            $student->document_file_1 = $request->utme_result;

            $student->document_title_2 = 'SSCE Result';
            $student->document_file_2 = $request->ssce_result;

            $student->document_title_3 = 'Guarantors Letter';
            $student->document_file_3 = $request->guarantors_letter;
            $student->student_photo = $request->student_photo;

            //guardian
            $student->guardian_name = $request->guardian_name;
            $student->guardian_mobile = $request->guardian_mobile;
            $student->guardian_email  = $request->guardian_email;
            $student->guardian_relation = $request->guardian_relation;
            $student->admission_letter = $admission_letter;

            //utme number
            $student->utme_number = $request->utme_number;
            //NDAG/2020/5626
            $student->matric_number = $matric_number;
            $student->save();
            $student->toArray();

            @send_mail($receiver_email, $receiver_name, $subject , $view ,$compact);
            //send_mail($receiver_email, $receiver_name, $subject, $view, $compact = [])



            SmStudentRegistration::where('id', $temp_id)->delete();

            DB::commit();

            Toastr::success('Operation successful', 'Success');
            return redirect()->route('parentregistration-applicants');
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->route('parentregistration-applicants');
        }
    }
    //

    public function assignSectionStore(Request $request){
       
        if($request->section == ""){
            Toastr::error('Please select class name.', 'Failed');
            return redirect()->back();
        }
        try{
            $student = SmStudentRegistration::find($request->id);
            $student->section_id = $request->section;
            $student->save();

            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    // Temporary stduent delete
    public function studentDelete(Request $request)
    {
        try {
            $temp_id = $request->id;
            $request = SmStudentRegistration::find($temp_id);
            $full_name = ucwords($request->first_name . ' ' . $request->last_name);
            $email = $request->student_email;
            $compact =  ['name'=>$full_name,'email' => $email];
            $receiver_email = $email;
            $receiver_name =  $full_name;
            $subject= "Admission Status";
            $view ="parentregistration::decline_email";
            //return view($view, compact('compact'));
            Session::put('applicants_fullname', $full_name);
            Session::put('applicants_email', $email);
            @send_mail($receiver_email, $receiver_name, $subject , $view ,$compact);
            SmStudentRegistration::destroy($temp_id);
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    // unique stduent email check by ajax from all school
    public function checkStudentEmail(Request $request)
    {
        $student = User::where('email', $request->id)->where('school_id', $request->school_id)->first();


        $SmStudentRegistration = SmStudentRegistration::where('school_id', $request->school_id)
        ->where(function ($q) use ($request) {
            $q->where('student_email', $request->id)->orWhere('guardian_email', $request->id);
        })->first();

        if ($student != "" || $SmStudentRegistration != "") {
            return response()->json(1);
        } else {
            return response()->json(0);
        }
    }

    // unique stduent mobile check by ajax from all school
    public function checkStudentMobile(Request $request)
    {
        $student = SmStudent::where('mobile', $request->id)->where('school_id', $request->school_id)->first();
        $SmStudentRegistration = SmStudentRegistration::where('student_mobile', $request->id)->where('school_id', $request->school_id)->first();

        if ($student != "" || $SmStudentRegistration != "") {
            return response()->json(1);
        } else {
            return response()->json(0);
        }
    }

    // unique guardian email check by ajax from all school
    public function checkGuardianEmail(Request $request)
    {
        $student = User::where('email', $request->id)->where('school_id', $request->school_id)->first();
        $SmStudentRegistration = SmStudentRegistration::where('school_id', $request->school_id)->where(function ($q) use ($request) {
            $q->where('student_email', $request->id)->orWhere('guardian_email', $request->id);
        })->first();

        if ($student != "" || $SmStudentRegistration != "") {
            return response()->json(1);
        } else {
            return response()->json(0);
        }
    }

    // unique guardian mobile check by ajax from all school
    public function checkGuardianMobile(Request $request)
    {
        $student = SmParent::where('guardians_mobile', $request->id)->where('school_id', $request->school_id)->first();
        $SmStudentRegistration = SmStudentRegistration::where('guardian_mobile', $request->id)->where('school_id', $request->school_id)->first();

        if ($student != "" || $SmStudentRegistration != "") {
            return response()->json(1);
        } else {
            return response()->json(0);
        }
    }

    public function studentView($id)
    {

        $student_detail = SmStudentRegistration::where('id', $id)->first();

        return view("parentregistration::student_view", compact('student_detail'));
    }


    // registartion setting for regular school and saas
    public function Updatesettings(Request $request)
    {

        try {

            $key1 = 'NOCAPTCHA_SITEKEY';
            $key2 = 'NOCAPTCHA_SECRET';



            $value1 = $request->nocaptcha_sitekey;
            $value2 = $request->nocaptcha_secret;


            $path                   = base_path() . "/.env";
            $NOCAPTCHA_SITEKEY          = env($key1);
            $NOCAPTCHA_SECRET          = env($key2);


            if (file_exists($path)) {
                file_put_contents($path, str_replace(
                    "$key1=" . $NOCAPTCHA_SITEKEY,
                    "$key1=" . $value1,
                    file_get_contents($path)
                ));
                file_put_contents($path, str_replace(
                    "$key2=" . $NOCAPTCHA_SECRET,
                    "$key2=" . $value2,
                    file_get_contents($path)
                ));
            }




            $setting = SmRegistrationSetting::find(1);

            if ($setting == "") {
                $setting = new SmRegistrationSetting();
            }

            if (isset($request->position)) {
                $setting->position = $request->position;
            }

            if (isset($request->registration_permission)) {
                $setting->registration_permission = $request->registration_permission;
            }

            if (isset($request->registration_after_mail)) {
                $setting->registration_after_mail = $request->registration_after_mail;
            }

            if (isset($request->approve_after_mail)) {
                $setting->approve_after_mail = $request->approve_after_mail;
            }

            if (isset($request->recaptcha)) {
                $setting->recaptcha = $request->recaptcha;
            }

            $setting->nocaptcha_sitekey = $request->nocaptcha_sitekey;
            $setting->nocaptcha_secret = $request->nocaptcha_secret;

            $setting->save();

            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function assignSection($id)
    {


        try {
            $student = SmStudentRegistration::find($id);

            $sectionIds = SmClassSection::where('class_id', '=', $student->class_id)->get();
            $sections = [];
            foreach ($sectionIds as $sectionId) {
            	$sections[]= SmSection::find($sectionId->section_id);
            }

            return view('parentregistration::assign_section', compact('sections', 'student'));

        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

}