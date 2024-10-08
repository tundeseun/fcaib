<?php

namespace App\Http\Controllers;

use App\SmClass;
use App\SmSection;
use App\SmStudent;
use App\tableList;
use App\YearCheck;
use App\ApiBaseMethod;
use App\SmAcademicYear;
use App\SmClassSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\SmGeneralSettings;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isNull;

class SmAcademicYearController extends Controller
{
    public function __construct()
    {
        $this->middleware('PM');
        // User::checkAuth();
    }
    
    public function index(Request $request)
    {
        try {
            $academic_years = SmAcademicYear::where('active_status', 1)->orderBy('year', 'ASC')->where('school_id', Auth::user()->school_id)->get();
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendResponse($academic_years, null);
            }
            return view('backEnd.systemSettings.academic_year', compact('academic_years'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'year' => 'required|numeric|digits:4',
            'starting_date' => 'required',
            'ending_date' => 'required',
            'title' => "required|max:150",
        ]);
        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $yr = SmAcademicYear::orderBy('id', 'desc')->where('school_id', Auth::user()->school_id)->first();
        $created_year = $request->starting_date;
        if ($yr == null) {
            $ye_year = $request->year;
        } else {
            $ye_year = $yr->year;
        }
        DB::beginTransaction();
        $academic_year = new SmAcademicYear();
        $academic_year->year = $request->year;
        $academic_year->title = $request->title;
        $academic_year->starting_date = date('Y-m-d', strtotime($request->starting_date));
        $academic_year->ending_date = date('Y-m-d', strtotime($request->ending_date));
        if ($request->copy_with_academic_year != null) {
                $academic_year->copy_with_academic_year =implode(",",$request->copy_with_academic_year);
            }
        $academic_year->created_at = $created_year;
        $academic_year->school_id = Auth::user()->school_id;
        $result = $academic_year->save();
        if($result){
            session()->forget('academic_years');
            $academic_years = SmAcademicYear::where('active_status', 1)->where('school_id', Auth::user()->school_id)->get();
            session()->put('academic_years',$academic_years);   
        }
        $sm_Gs = SmGeneralSettings::where('school_id', Auth::user()->school_id)->first();
        $sm_Gs->session_id = $academic_year->id;
        $sm_Gs->academic_id = $academic_year->id;
        $sm_Gs->session_year = $academic_year->year;
        $sm_Gs->save();
        session()->forget('sessionId'); 
        session()->put('sessionId', $sm_Gs->session_id); 
        session()->forget('generalSetting');
        $generalSetting = SmGeneralSettings::where('school_id',Auth::user()->school_id)->first();
        session()->put('generalSetting', $generalSetting);
        // $tables = ['App\SmClass', 'App\SmSection', 'App\SmExamType'];
        SmStudent::query()->update(['room_id' => 0,'first_semester_reg' => 0, 'second_semester_reg' => 0, 'section_id' => DB::raw('section_id+1')]);
        


        DB::commit();
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Year has been created successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again');
            }
        } else {
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
            } else {
                DB::rollBack();
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        }
    }

    public function show(Request $request, $id)
    {
        try {
             if (checkAdmin()) {
                $academic_year = SmAcademicYear::find($id);
            }else{
                $academic_year = SmAcademicYear::where('id',$id)->where('school_id',Auth::user()->school_id)->first();
            }
            $academic_years = SmAcademicYear::where('school_id', Auth::user()->school_id)->get();
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = [];
                $data['academic_year'] = $academic_year->toArray();
                $data['academic_years'] = $academic_years->toArray();
                return ApiBaseMethod::sendResponse($data, null);
            }
            return view('backEnd.systemSettings.academic_year', compact('academic_year', 'academic_years'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }


    public function edit($id)
    {
        Toastr::error('Operation Failed', 'Failed');
        return redirect()->back();
    }


    public function update(Request $request, $id)
    {
        $input = $request->all();
        // return $input;
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $validator = Validator::make($input, [
                'year' => 'required|numeric|digits:4',
                'title' => "required|max:150",
                'starting_date' => 'required',
                'ending_date' => 'required',
                'id' => "required"
            ]);
        } else {
            $validator = Validator::make($input, [
                'year' => 'required|numeric|digits:4',
                'title' => "required|max:150",
            ]);
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
            $created_year = $request->starting_date;
            $academic_year = SmAcademicYear::find($request->id);
            $academic_year->year = $request->year;
            $academic_year->title = $request->title;
            $academic_year->starting_date = date('Y-m-d', strtotime($request->starting_date));
            $academic_year->ending_date = date('Y-m-d', strtotime($request->ending_date));
            $academic_year->created_at = $created_year;
            $result = $academic_year->save();
            if($result){
                session()->forget('academic_years');
                $academic_years = SmAcademicYear::where('active_status', 1)->where('school_id', Auth::user()->school_id)->get();
                session()->put('academic_years',$academic_years);
            }
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                if ($result) {
                    return ApiBaseMethod::sendResponse(null, 'Year has been updated successfully');
                } else {
                    return ApiBaseMethod::sendError('Something went wrong, please try again');
                }
            } else {
                if ($result) {
                    Toastr::success('Operation successful', 'Success');
                    return redirect('academic-year');
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

    public function destroy(Request $request, $id)
    {
        try {
            // $session_id = 'academic_id';
            // $tables = tableList::getTableList($session_id, $id);
            try {

                if (getAcademicId() != $id) {
                    if (checkAdmin()) {
                        $delete_query = SmAcademicYear::find($id);
                    }else{
                        $delete_query = SmAcademicYear::where('id',$id)->where('school_id',Auth::user()->school_id)->first();
                    }


                    if (checkAdmin()) {
                        $delete_query = SmAcademicYear::destroy($id);
                    }else{
                        $delete_query = SmAcademicYear::where('id',$id)
                        ->where('school_id',Auth::user()->school_id)
                        ->delete();
                    }

                    if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                        if ($delete_query) {
                            return ApiBaseMethod::sendResponse(null, 'Academic Year has been deleted successfully');
                        } else {
                            return ApiBaseMethod::sendError('Something went wrong, please try again.');
                        }
                    } else {
                        
                        if ($delete_query) {
                        
                                session()->forget('academic_years');
                                $academic_years = SmAcademicYear::where('active_status', 1)->where('school_id', Auth::user()->school_id)->get();
                                session()->put('academic_years',$academic_years);
                            
                            Toastr::success('Operation successful', 'Success');
                            return redirect()->back();
                        } else {
                            Toastr::error('Operation Failed', 'Failed');
                            return redirect()->back();
                        }
                    }
                } else {
                    Toastr::warning('You cannot delete current academic year.', 'Warning');
                    return redirect()->back();
                }
                
                
            } catch (\Illuminate\Database\QueryException $e) {
                Toastr::error('This item already used', 'Failed');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
}