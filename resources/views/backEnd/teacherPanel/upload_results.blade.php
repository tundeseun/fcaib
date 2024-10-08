@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Upload Result</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">Upload Result</a>
            </div>
        </div>
    </div>
</section>

@if(isset($students))
<section class="mt-20">
    <div class="container-fluid p-0">

        <div class="row">
            <div class="col-lg-12">
                <div class="bg-white p-3">
                    <h3 class="mb-3">
                             Course Title : <b>{{$course_details->subject_name}}</b><hr/>
                             Course Code : <b>{{strtoupper($course_details->subject_code)}}</b><hr/>
                             Credit Unit(s) : <b id="units">{{$course_details->units}}</b><hr/>
                    </h3>
                    <table class="table table-condensed table-hover" cellspacing="0" width="100%" style="box-shadow: none;">
                        <thead>
                            <tr>
                                <th class="col-2 pl-2">Matric No.</th>
                                <th class="col-4">Student Names</th>
                                <th class="col-2">Total Score (CA + Exam)</th>
                                <th class="col-2">Grade</th>
                                <th class="col-2">Remark</th>
                            </tr>

                        </thead>
                        <tbody>
                            @foreach($students as $student)
                            <tr>
                                <td class="pl-2">{{$student->matric_number}}</td>
                                <td>{{$student->full_name}}</td>
                                <td>
                                    <input {{ !$course_details->isTeacher() ? 'disabled' : '' }} type="number" name="score" class="form-control primary-input" id="score__{{$student->cid}}" value="{{$student->score}}" oninput="update_result({{$student->cid}})" min="0">
                                </td>
                                <td>
                                    <span id="grade__{{$student->cid}}" class="font-weight-bold">{{$student->grade}}</span>
                                </td>
                                <td>
                                    <span id="remark__{{$student->cid}}" class="font-weight-bold">{{$student->remark}}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ url()->previous()}}" class="btn btn-primary"><span class="ti-check"></span> Done </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endif



@endsection
<script type="text/javascript">
    function update_result(cid){
            var score = '#score__'+cid;
            var grade = '#grade__'+cid;
            var remark = '#remark__'+cid;
            var units = $('#units').html();
            score = parseInt($(score).val());

            $.ajax({
                url:("{{route('update-score')}}"),
                type: "POST",
                data:{
                    "cid": cid,
                    'score': score,
                    'units': units
                },
                success:function(response)
                {
                    $(grade).html(response.grade);
                    $(remark).html(response.remark);

                }
            });

    }
</script>