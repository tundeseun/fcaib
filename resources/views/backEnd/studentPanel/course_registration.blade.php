@extends('backEnd.master')
@section('title')
Course Registration
@endsection
@section('mainContent')

    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>Course Registration </h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                    <a href="#">Course Registration</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-12">
                    @if(generalSetting()->semester == 'F')
                        <div class="main-title">
                            <h3 class="mb-3">{{$session->title}} First Semester Courses </h3>
                            <hr/>
                        </div>

                        <div class="row">
                            <form class="col-lg-12" method="post" action="{{route('course-registration')}}">
                                @csrf
                                <input type="hidden" name="semester" value="F">

                                <table  class="table table-hover bg-white" bgcolor="#ffffff" cellspacing="0" width="100%">

                                    <thead> 
                                        <tr>
                                            <th class="col-6 pl-4">Course Title</th>
                                            <th class="col-2">Course Code</th>
                                            <th class="col-2">Units</th>
                                            <th class="col-2">Select/Unselect</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($first_semester_courses as $first)
                                            <tr>
                                                <td class="col-6 pl-4">{{$first->subject_name}}</td>
                                                <td class="col-2">{{$first->subject_code}}</td>
                                                <td class="col-2">{{$first->units}}</td>
                                                <td class="col-2">
                                                    <input type="checkbox" name="subjects[]" class="form-control-sm" value="{{$first->id}}" @if($student_detail->first_semester_reg == 1) checked = "true" disabled = "true" @endif >
                                                </td>
                                            </tr>

                                        @endforeach
                                    </tbody>
                                </table>

                                <h4>Faculty Courses</h4>
                                <table  class="table table-hover bg-white" bgcolor="#ffffff" cellspacing="0" width="100%">

                                    <thead> 
                                        <tr>
                                            <th class="col-6 pl-4">Course Title</th>
                                            <th class="col-2">Course Code</th>
                                            <th class="col-2">Units</th>
                                            <th class="col-2">Select/Unselect</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($first_semester_general_courses as $first_generals)
                                            <tr>
                                                <td class="col-6 pl-4">{{$first_generals->subject_name}}</td>
                                                <td class="col-2">{{$first_generals->subject_code}}</td>
                                                <td class="col-2">{{$first_generals->units}}</td>
                                                <td class="col-2">
                                                    <input type="checkbox" name="subjects[]" class="form-control-sm" value="{{$first_generals->id}}" checked = "true" disabled = "true" >
                                                    <input type="hidden" name="subjects[]" value="{{$first_generals->id}}" checked = "true">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>


                                <h4>Elective Courses</h4>
                                <table  class="table table-hover bg-white" bgcolor="#ffffff" cellspacing="0" width="100%">

                                    <thead> 
                                        <tr>
                                            <th class="col-6 pl-4">Course Title</th>
                                            <th class="col-2">Course Code</th>
                                            <th class="col-2">Units</th>
                                            <th class="col-2">Select/Unselect</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($first_semester_elective_courses as $first_electives)
                                            <tr>
                                                <td class="col-6 pl-4">{{$first_electives->subject_name}}</td>
                                                <td class="col-2">{{$first_electives->subject_code}}</td>
                                                <td class="col-2">{{$first_electives->units}}</td>
                                                <td class="col-2">
                                                    <input type="checkbox" name="subjects[]" class="form-control-sm" value="{{$first_electives->id}}" @if($student_detail->first_semester_reg == 1) checked = "true" disabled = "true" @endif>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                {{-- <h4>Carry-over Courses</h4>
                                <table  class="table table-hover bg-white" bgcolor="#ffffff" cellspacing="0" width="100%">

                                    <thead> 
                                        <tr>
                                            <th class="col-6 pl-4">Course Title</th>
                                            <th class="col-2">Course Code</th>
                                            <th class="col-2">Units</th>
                                            <th class="col-2">Select/Unselect</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($first_semester_carryover_courses as $first_carryovers)
                                            <tr>
                                                <td class="col-6 pl-4">{{$first_carryovers->subject_name}}</td>
                                                <td class="col-2">{{$first_carryovers->subject_code}}</td>
                                                <td class="col-2">{{$first_carryovers->units}}</td>
                                                <td class="col-2">
                                                    <input type="checkbox" name="subjects[]" class="form-control-sm" value="{{$first_carryovers->id}}" checked = "true" disabled = "true">
                                                    <input type="hidden" name="subjects[]" value="{{$first_carryovers->id}}" checked = "true">
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table> --}}

                                <button type="submit" class="primary-btn fix-gr-bg" onclick="return confirm('Please verify that you have selected all the necessary courses before submitting');">Save/Print</button>
                            </form>
                        </div>
                    @else


                        <div class="main-title">
                            <h3 class="my-3">{{$session->title}} Second Semester Courses</h3>
                            <hr/>
                        </div>
                        <div class="row">
                            <form class="col-lg-12" method="post" action="{{route('course-registration')}}">
                                @csrf  
                                <input type="hidden" name="semester" value="S">
                                <table  class="table bg-white" cellspacing="0" width="100%">

                                    <thead> 
                                        <tr>
                                            <th class="col-5 pl-4">Course Title</th>
                                            <th class="col-3">Course Code</th>
                                            <th class="col-2">Units</th>
                                            <th class="col-2">Select/Unselect</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($second_semester_courses as $second)
                                            <tr>
                                                <td class="col-6 pl-4">{{$second->subject_name}}</td>
                                                <td class="col-2">{{$second->subject_code}}</td>
                                                <td class="col-2">{{$second->units}}</td>
                                                <td class="col-2">
                                                    <input type="checkbox" name="subjects[]" class="form-control-sm" value="{{$second->id}}" @if($student_detail->second_semester_reg == 1) checked = "true" disabled = "true" @endif>

                                                </td>
                                            </tr>                                        

                                        @endforeach
                                    </tbody>
                                </table>

                                <h4>Faculty Courses</h4>
                                <table  class="table table-hover bg-white" bgcolor="#ffffff" cellspacing="0" width="100%">

                                    <thead> 
                                        <tr>
                                            <th class="col-6 pl-4">Course Title</th>
                                            <th class="col-2">Course Code</th>
                                            <th class="col-2">Units</th>
                                            <th class="col-2">Select/Unselect</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($second_semester_general_courses as $second_generals)
                                            <tr>
                                                <td class="col-6 pl-4">{{$second_generals->subject_name}}</td>
                                                <td class="col-2">{{$second_generals->subject_code}}</td>
                                                <td class="col-2">{{$second_generals->units}}</td>
                                                <td class="col-2">
                                                    <input type="checkbox" name="subjects[]" class="form-control-sm" value="{{$second_generals->id}}" checked = "true" disabled = "true">
                                                    <input type="hidden" name="subjects[]" value="{{$second_generals->id}}" checked = "true">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <h4>Elective Courses</h4>
                                <table  class="table table-hover bg-white" bgcolor="#ffffff" cellspacing="0" width="100%">

                                    <thead> 
                                        <tr>
                                            <th class="col-6 pl-4">Course Title</th>
                                            <th class="col-2">Course Code</th>
                                            <th class="col-2">Units</th>
                                            <th class="col-2">Select/Unselect</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($second_semester_elective_courses as $second_electives)
                                            <tr>
                                                <td class="col-6 pl-4">{{$second_electives->subject_name}}</td>
                                                <td class="col-2">{{$second_electives->subject_code}}</td>
                                                <td class="col-2">{{$second_electives->units}}</td>
                                                <td class="col-2">
                                                    <input type="checkbox" name="subjects[]" class="form-control-sm" value="{{$second_electives->id}}" @if($student_detail->second_semester_reg == 1) checked = "true" disabled = "true" @endif>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                {{-- <h4>Carry-over Courses</h4>
                                <table  class="table table-hover bg-white" bgcolor="#ffffff" cellspacing="0" width="100%">

                                    <thead> 
                                        <tr>
                                            <th class="col-6 pl-4">Course Title</th>
                                            <th class="col-2">Course Code</th>
                                            <th class="col-2">Units</th>
                                            <th class="col-2">Select/Unselect</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($second_semester_carryover_courses as $second_carryovers)
                                            <tr>
                                                <td class="col-6 pl-4">{{$second_carryovers->subject_name}}</td>
                                                <td class="col-2">{{$second_carryovers->subject_code}}</td>
                                                <td class="col-2">{{$second_carryovers->units}}</td>
                                                <td class="col-2">
                                                    <input type="checkbox" name="subjects[]" class="form-control-sm" value="{{$second_carryovers->id}}" checked = "true" disabled = "true" >
                                                    <input type="hidden" name="subjects[]" value="{{$second_carryovers->id}}" checked = "true">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table> --}}
                                <button type="submit" class="primary-btn fix-gr-bg" onclick="return confirm('Please verify that you have selected all the necessary courses before submitting');">Save/Print</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>


@endsection
