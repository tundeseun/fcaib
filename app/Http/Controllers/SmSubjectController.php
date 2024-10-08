<?php

namespace App\Http\Controllers;

use App\SmSubject;
use App\SmClass;
use App\SmSection;
use App\tableList;
use App\YearCheck;
use App\ApiBaseMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SmSubjectController extends Controller
{
    public function __construct()
	{
        $this->middleware('PM');
        // User::checkAuth();
	}

    public function index(Request $request)
    {

        try {
            
            $classes = SmClass::where('active_status', 1)
                
                ->where('school_id', Auth::user()->school_id)
                ->get();

            $sections = SmSection::where('active_status', 1)
                
                ->where('school_id', Auth::user()->school_id)
                ->get();


            $subjects = SmSubject::with(['classes','sections'])->get();




        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendResponse($subjects, null);
            }
            return view('backEnd.academics.subject', compact('subjects','classes','sections'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function store(Request $request)
    {
        $input = $request->all();
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $validator = Validator::make($input, [
                'subject_name' => "required|max:200",
                'subject_type' => "required",
                'subject_code' => "sometimes|nullable|max:30",
                'class' => "required",
                'section' => "required",
                'units' => "required",
            ]);
        } else {
            $validator = Validator::make($input, [
                'subject_name' => "required|max:200",
                'subject_type' => "required",
                'subject_code' => "required|nullable|max:30",
                'class' => "required",
                'section' => "required",
                'units' => "required",
            ]);
        }

        $is_duplicate = SmSubject::where('school_id', Auth::user()->school_id)->where('subject_name', $request->subject_name)->first();
        if ($is_duplicate) {
            Toastr::error('Duplicate name found!', 'Failed');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $find = SmSubject::where('school_id', Auth::user()->school_id)->where('subject_code', $request->subject_code)->first();
        if ($find != "") {
            Toastr::error('Duplicate subject code, Please try again', 'Failed');
            return redirect()->back()->withInput();
        }

        try {
            $subject = new SmSubject();
            $subject->subject_name = $request->subject_name;
            $subject->subject_type = $request->subject_type;
            $subject->subject_code = strtoupper($request->subject_code);
            $subject->class_id = $request->class;
            $subject->section_id = $request->section;
            $subject->units = $request->units;
            $subject->school_id = Auth::user()->school_id;
            $subject->academic_id = getAcademicId();
            $result = $subject->save();

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                if ($result) {
                    return ApiBaseMethod::sendResponse(null, 'Subject has been created successfully');
                } else {
                    return ApiBaseMethod::sendError('Something went wrong, please try again.');
                }
            } else {
                if ($result) {
                    Toastr::success('Operation successful', 'Success');

                    return redirect()->back();
                } else {
                    Toastr::error('Operation Failed', 'Failed');
                    return redirect()->back();
                }
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function edit(Request $request, $id)
    {

        try {

            $subject = SmSubject::with(['classes','sections'])->where('sm_subjects.id',$id)->first();
            //dd($subject);
 

            $classes = SmClass::where('active_status', 1)
                
                ->where('school_id', Auth::user()->school_id)
                ->get();

            $sections = SmSection::where('active_status', 1)
                
                ->where('school_id', Auth::user()->school_id)
                ->get();
            
            $subjects = SmSubject::with(['classes','sections'])->get();


            return view('backEnd.academics.add_new_course', compact('subject', 'subjects','classes','sections'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function update(Request $request)
    {
        $input = $request->all();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $validator = Validator::make($input, [
                'subject_name' => "required|max:200",
                'subject_type' => "required",
                'subject_code' => "required|nullable|max:30",
                'class' => "required",
                'section' => "required",
                'units' => "required",

            ]);
        } else {
            $validator = Validator::make($input, [
                'subject_name' => "required|max:200",
                'subject_type' => "required",
                'subject_code' => "required|nullable|max:30",
                'class' => "required",
                'section' => "required",
                'units' => "required",

            ]);
        }

        $is_duplicate = SmSubject::where('school_id', Auth::user()->school_id)->where('id','!=', $request->id)->where('subject_name', $request->subject_name)->first();
        if ($is_duplicate) {
            Toastr::error('Duplicate name found!', 'Failed');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
             if (checkAdmin()) {
                $subject = SmSubject::find($request->id);
            }else{
                $subject = SmSubject::where('id',$request->id)->where('school_id',Auth::user()->school_id)->first();
            }

            
            $subject->subject_name = $request->subject_name;
            $subject->subject_type = $request->subject_type;
            $subject->subject_code = strtoupper($request->subject_code);
            $subject->class_id = $request->class;
            $subject->section_id = $request->section;
            $subject->units = $request->units;
            $result = $subject->save();

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                if ($result) {
                    return ApiBaseMethod::sendResponse(null, 'Subject has been updated successfully');
                } else {
                    return ApiBaseMethod::sendError('Something went wrong, please try again.');
                }
            } else {
                if ($result) {
                    Toastr::success('Operation successful', 'Success');

                    return redirect()->route('subject');
                } else {
                    Toastr::error('Operation Failed', 'Failed');
                    return redirect()->back();
                }
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function delete(Request $request, $id)
    {

        try {
            $tables = tableList::getTableList('subject_id', $id);
            try {
                if ($tables == null) {
                    // $delete_query = $section = SmSubject::destroy($id);
                     if (checkAdmin()) {
                        $delete_query = SmSubject::destroy($id);
                    }else{
                        $delete_query = SmSubject::where('id',$id)->where('school_id',Auth::user()->school_id)->delete();
                    }
                        if ($delete_query) {
                            Toastr::success('Operation successful', 'Success');
                            return redirect('subject');
                        } else {
                            Toastr::error('Operation Failed', 'Failed');
                            return redirect()->back();
                        }
                } else {
                    $msg = 'This data already used in  : ' . $tables . ' Please remove those data first';
                    Toastr::error($msg, 'Failed');
                    return redirect()->back();
                }
            } catch (\Illuminate\Database\QueryException $e) {

                $msg = 'This data already used in  : ' . $tables . ' Please remove those data first';
                Toastr::error($msg, 'Failed');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function create(){
        try{
            $classes = SmClass::where('active_status', 1)
                
            ->where('school_id', Auth::user()->school_id)
            ->get();

            $sections = SmSection::where('active_status', 1)
                
                ->where('school_id', Auth::user()->school_id)
                ->get();

            return view('backEnd.academics.add_new_course', compact('sections','classes'));
        }catch(\Exception $e){
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
}