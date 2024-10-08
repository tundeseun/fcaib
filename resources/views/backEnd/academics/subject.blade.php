@extends('backEnd.master')
@section('title') 
@lang('lang.subject')
@endsection
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.subject')</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.academics')</a>
                <a href="#">@lang('lang.subject')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="d-flex justify-content-end my-3">
        <a  class="primary-btn small fix-gr-bg" href="add-course">
            <span class="ti-plus pr-2"></span>
            Add Course
        </a>
    </div>
    <div class="container-fluid p-0">
        @if(isset($subject))
          @if(userPermission(258))
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{route('subject')}}" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    @lang('lang.add')
                </a>
            </div>
        </div>
        @endif
        @endif
        <div class="row">
           


            <div class="col-12">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0">@lang('lang.subject') @lang('lang.list')</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        
                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                               @if(session()->has('message-success-delete') != "" ||
                                session()->get('message-danger-delete') != "")
                                <tr>
                                    <td colspan="5">
                                         @if(session()->has('message-success-delete'))
                                          <div class="alert alert-success">
                                              {{ session()->get('message-success-delete') }}
                                          </div>
                                        @elseif(session()->has('message-danger-delete'))
                                          <div class="alert alert-danger">
                                              {{ session()->get('message-danger-delete') }}
                                          </div>
                                        @endif
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <th>@lang('lang.sl')</th>
                                    <th>Title</th>
                                    <th>Code</th>
                                    <td>Dept.</td>
                                    <td>Level</td>
                                    <th>Semester</th>
                                    <th>Units</th>
                                    <th>@lang('lang.action')</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php $i=0; @endphp
                                @foreach($subjects as $subject)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{$subject->subject_name}}</td>
                                    <td>{{$subject->subject_code}}</td>
                                    <td>
                                        @if($subject->class_id == 0)
                                            Elective Course
                                        @elseif($subject->class_id == -1)
                                            Compulsory Course
                                        @else
                                            {{$subject->classes->class_name}}
                                        @endif

                                    </td>
                                    <td>{{$subject->sections->section_name}}</td>
                                    <td>{{$subject->subject_type == 'F'? '1st':'2nd'}}</td>
                                    <td>{{$subject->units}}</td>
                                    
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                 @if(userPermission(259))
                                                <a class="dropdown-item" href="{{route('subject_edit', [@$subject->id])}}">@lang('lang.edit')</a>
                                               @endif
                                                @if(userPermission(260))
                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteSubjectModal{{@$subject->id}}"  href="#">@lang('lang.delete')</a>
                                           @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                 <div class="modal fade admin-query" id="deleteSubjectModal{{@$subject->id}}" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">@lang('lang.delete') @lang('lang.subject')</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                    <a href="{{route('subject_delete', [@$subject->id])}}" class="text-light">
                                                    <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.delete')</button>
                                                     </a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
