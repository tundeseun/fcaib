<?php

namespace App\Http\Controllers;

use App\SmClass;
use App\SmSection;
use App\tableList;
use App\YearCheck;
use App\ApiBaseMethod;
use App\SmClassSection;
use App\SmGeneralSettings;
use App\SmStaff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class SmClassController extends Controller
{
    public $date;

    public function __construct()
	{
        $this->middleware('PM');
        // $this->date = SmGeneralSettings::first()->academic_Year->year;
        // User::checkAuth();
	}


    public function index(Request $request)
    {


        try {
            $sections = SmSection::where('active_status', '=', 1)->where('created_at', 'LIKE', '%' . $this->date . '%')->where('school_id', Auth::user()->school_id)->get();
            $classes = SmClass::where('sm_classes.active_status', '=', 1)->where('sm_classes.school_id', Auth::user()->school_id)
                                ->join('sm_staffs','sm_classes.hod','sm_staffs.id')
                                ->select('sm_classes.*','sm_staffs.full_name')
                                ->get();
            $teachers = SmStaff::where('role_id','=', 4)->get();
            $class_sections=[];
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = [];
                $data['classes'] = $classes->toArray();
                $data['sections'] = $sections->toArray();
                return ApiBaseMethod::sendResponse($data, null);
            }
            return view('backEnd.academics.class', compact('classes', 'sections','teachers'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make(
            $input,
            [ 
                'name' => "required|max:200",
                'section' => "required",
                'hod'=> "required"
            ]
        );

        $is_duplicate = SmClass::where('school_id', Auth::user()->school_id)->where('class_name', $request->name)->first();
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
        if ($request->section) {
           
       
        DB::beginTransaction();

            try {
                $class = new SmClass();
                $class->class_name = $request->name;
                $class->created_at = YearCheck::getYear() . '-' . date('m-d h:i:s');
                $class->school_id = Auth::user()->school_id;
                $class->academic_id = getAcademicId();
                $class->hod = $request->hod;
                $class->save();
                $class->toArray();
                try {
                    $sections = $request->section;

                    if ($sections != '') {
                        foreach ($sections as $section) {
                            $smClassSection = new SmClassSection();
                            $smClassSection->class_id = $class->id;
                            $smClassSection->section_id = $section;
                            $smClassSection->created_at = YearCheck::getYear() . '-' . date('m-d h:i:s');
                            $smClassSection->school_id = Auth::user()->school_id;

                             //check MultiBranch module and superadmin
                // if( moduleStatusCheck('MultiBranch')){
                //     if(Auth::user()->is_administrator=='yes'){
                //         $user->branch_id = $request->branch_id;
                //     }else{
                //         $user->branch_id = Auth::user()->branch_id;
                //     }
                
                //  }
                            $smClassSection->academic_id = getAcademicId();
                            $smClassSection->save();
                        }
                    }
                    DB::commit();

                    if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                        return ApiBaseMethod::sendResponse(null, 'Class has been created successfully');
                    }
                    Toastr::success('Operation successful', 'Success');
                    return redirect()->back();
                } catch (\Exception $e) {
                    DB::rollBack();
                }
            } catch (\Exception $e) {
                DB::rollBack();
            }
        }else{
            Toastr::error('Please select section', 'Failed');
            return redirect()->back();
        }
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendError('Something went wrong, please try again.');
        }
        Toastr::error('Operation Failed', 'Failed');
        return redirect()->back();
    }

    public function edit(Request $request, $id)
    {


        try {

            $classById = SmCLass::where('sm_classes.id',$id)
                                ->join('sm_staffs','sm_classes.hod','sm_staffs.id')
                                ->select('sm_classes.*','sm_staffs.full_name')
                                ->first();

            //dd($classById);


            $sectionByNames = SmClassSection::select('section_id')->where('class_id', '=', $classById->id)->get();
            $teachers = SmStaff::where('role_id','=', 4)->get();

            $sectionId = array();
            foreach ($sectionByNames as $sectionByName) {
                $sectionId[] = $sectionByName->section_id;
            }

            $sections = SmSection::where('active_status', '=', 1)->where('created_at', 'LIKE', '%' . $this->date . '%')->where('school_id', Auth::user()->school_id)->get();

            $classes = SmClass::where('sm_classes.active_status', '=', 1)->where('sm_classes.school_id', Auth::user()->school_id)
                                ->join('sm_staffs','sm_classes.hod','sm_staffs.id')
                                ->select('sm_classes.*','sm_staffs.full_name')
                                ->get();

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = [];
                $data['sections'] = $sections->toArray();
                $data['classes'] = $classes->toArray();
                $data['classById'] = $classById;
                $data['sectionId'] = $sectionId;
                return ApiBaseMethod::sendResponse($data, null);
            }

            return view('backEnd.academics.class', compact('classById', 'classes', 'sections', 'sectionId','teachers'));
         } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make(
            $input,
            [
                // 'name' => "required|unique:sm_classes,class_name," . $request->id,
                'name' => "required|max:200",
                'section' => 'required|array',
                'hod' => 'required'
            ],
            [
                'section.required' => 'At least one checkbox required!'
            ]
        );

        $is_duplicate = SmClass::where('id','!=', $request->id)->where('class_name', $request->name)->first();
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


        SmCLassSection::where('class_id', $request->id)->delete();



        DB::beginTransaction();

        try {

            $class = SmCLass::where('id',$request->id)->where('school_id',Auth::user()->school_id)->first();
            $class->class_name = $request->name;
            $class->hod = $request->hod;
            $class->save();
            $class->toArray();
            try {
                $sections = $request->section;

                foreach ($sections as $section) {
                    $smClassSection = new SmClassSection();
                    $smClassSection->class_id = $class->id;
                    $smClassSection->section_id = $section;
                    $smClassSection->created_at = YearCheck::getYear() . '-' . date('m-d h:i:s');
                    $smClassSection->school_id = Auth::user()->school_id;
                    $smClassSection->academic_id = getAcademicId();
                    $smClassSection->save();
                }

                DB::commit();

                if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                    return ApiBaseMethod::sendResponse(null, 'Class has been updated successfully');
                }
                Toastr::success('Operation successful', 'Success');
                return redirect('class');
            } catch (\Exception $e) {
                DB::rollBack();
            }
        } catch (\Exception $e) {
            DB::rollBack();
        }

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendError('Something went wrong, please try again.');
        }
        Toastr::error('Operation Failed', 'Failed');
        return redirect()->back();
    }

    public function delete(Request $request, $id)
    {
        try {
            $tables = tableList::getTableList('class_id', $id);

            if($tables == null || $tables == "Class sections, ") {
                
                DB::beginTransaction();

                // $class_sections = SmClassSection::where('class_id', $id)->get();
                if (checkAdmin()) {
                    $class_sections = SmClassSection::where('class_id', $id)->get();
                }else{
                    $class_sections = SmClassSection::where('class_id', $id)->where('school_id',Auth::user()->school_id)->get();
                }
                foreach ($class_sections as $key => $class_section) {
                    $class_section_delete_query = SmClassSection::destroy($class_section->id);
                }
                    if (checkAdmin()) {
                        $delete_query = $section = SmClass::destroy($id);
                    }else{
                        $delete_query = $section = SmClass::where('id',$id)->where('school_id',Auth::user()->school_id)->delete();
                    }
                DB::commit();
                if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                    if ($section) {
                        return ApiBaseMethod::sendResponse(null, 'Class has been deleted successfully');
                    } else {
                        return ApiBaseMethod::sendError('Something went wrong, please try again.');
                    }
                } else {
                    if ($delete_query) {
                        Toastr::success('Operation successful', 'Success');
                        return redirect('class');
                    } else {
                        DB::rollback();
                        Toastr::error('Operation Failed', 'Failed');
                        return redirect()->back();
                    }
                }
            } else{
                DB::rollback();
                $msg = 'This data already used in  : ' . $tables . ' Please remove those data first';
                Toastr::error($msg, 'Failed');
                return redirect()->back();
            }

        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
}