@extends('backEnd.master')
@section('title') 
Lecturer @lang('lang.lesson') @lang('lang.plan') @lang('lang.overview')
@endsection

@section('mainContent')


<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Lecturer @lang('lang.lesson') @lang('lang.plan') @lang('lang.overview')</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.lesson') @lang('lang.plan')</a>
                <a href="#">@lang('lang.lesson') @lang('lang.plan') @lang('lang.overview')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
  
    </div>

            <div class="row">
                <div class="col-lg-12">
            
                    <div class="white-box">
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'search-topic-overview', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_lesson_Plan']) }}
                            <div class="row">
                                <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                <div class="col-lg-3 mt-30-md">
                                    <select class="w-100 bb niceSelect form-control{{ $errors->has('lesson') ? ' is-invalid' : '' }}" name="lesson">
                                        <option data-display="@lang('lang.lesson') *" value="">@lang('lang.lesson') *</option>
                                    @foreach($lessons as $lesson)
                                        <option value="{{$lesson->id}}"  {{isset($lesson_id)? ($lesson_id == $lesson->id? 'selected':''):''}}>{{$lesson->lesson_title}}</option>
                                    @endforeach    
                                    </select>
                                    @if ($errors->has('lesson'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('lesson') }}</strong>
                                    </span>
                                    @endif
                                </div>
                              
    
    
                                
                                <div class="col-lg-3 mt-20 text-right">
                                    <button type="submit" class="primary-btn small fix-gr-bg">
                                        <span class="ti-search pr-2"></span>
                                        @lang('lang.search')
                                    </button>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
            @if(isset($topics_detail))
            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title" style="padding-left: 15px;">
                                
                            
                           
                           
                            </div>
                        </div>
                    </div>
                <div class="col-lg-12">
                    <table id="table_id" class="display school-table school-table-style" cellspacing="0" width="100%">

                        <thead>
                        
                            <tr>
                                <th>@lang('lang.lesson')</th>
                                <th>@lang('lang.topic')</th>
                                <th>@lang('lang.completed') @lang('lang.date') </th>
                                <th>Lecturer </th>
                                <th>@lang('lang.status')</th>
                           
                            </tr>
                        </thead>

                    <tbody>
                        @foreach ($topics_detail as $data)
                        @php
                        $lesson_plan_status=DB::table('lesson_planners')
                        ->where('topic_detail_id',$data->id)
                        ->get();
                            
                        @endphp
                       
                        <tr>
                            <td>{{$data->lesson_title->lesson_title !=""?$data->lesson_title->lesson_title:""}}</td>
                            <td> {{@$data->topic_title !=""?@$data->topic_title:""}}</td>

                            <td>
                                @foreach($lesson_plan_status as $status)
                                   @if($status->competed_date !="" && $status->completed_status !="") 
                                   {{$status->competed_date}} <br>
                                   @else
                                        @if(date('Y-m-d')< $status->lesson_date)Assign
                                        @else
                                        Assigned
                                        @endif

                                     Date ({{$status->lesson_date}})<br>
                                   @endif
                               @endforeach
                            </td>
                             <td>
                            @foreach($lesson_plan_status as $status)
                                   @if($status->competed_date !="" && $status->completed_status !="") 
                                   
                                  <strong><?php 
                                   $teacherName=DB::table('sm_staffs')
                                                ->where('id',$status->teacher_id)
                                                ->first();
                                                echo $teacherName->full_name;
                                    ?></strong> <br>
                                   @else
                                   <span><?php 
                                   $teacherName=DB::table('sm_staffs')
                                                ->where('id',$status->teacher_id)
                                                ->first();
                                                echo $teacherName->full_name;
                                    ?></span><br>
                                   @endif
                               @endforeach
                            </td>
                            <td>
                            @foreach($lesson_plan_status as $status)
                                   @if($status->competed_date !="" && $status->completed_status !="") 
                                   
                                  <strong class="gradient-color2">Completed</strong> <br>
                                   @else
                                   <span class="gradient-color">Incomplete</span><br>
                                   @endif
                               @endforeach
                            </td>
                           
                        </tr>
                        @endforeach
                       
                    </tbody>
                    </table>
            </div>
            @endif
        </div>
    </div>
</div>
</div>
</section>

@endsection

