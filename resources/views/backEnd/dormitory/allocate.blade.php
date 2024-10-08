@extends('backEnd.master')
@section('title')
Room Allocation
@endsection
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Room Allocation</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.dormitory')</a>
                <a href="#">Allocate Room</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">

        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{ route('room-lists', $room->dormitory_id) }}" class="primary-btn small fix-gr-bg">
                    <span class="ti-back pr-2"></span>
                    Back
                </a>
            </div>
        </div>

        <div class="row">
           
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">
                                Allocate {{ $room->name }}
                            </h3>
                        </div>

                        {{ Form::open(['class' => 'form-horizontal', 'files' => true,
                        'method' => 'POST', 'enctype' => 'multipart/form-data']) }}

                        <div class="white-box">
                            <div class="add-visitor">
                                
                                <div class="row">
                                    <div class="col-lg-12"> 
                                        <div class="input-effect">
                                            <input type="hidden" name="room" value="{{isset($room)? $room->id: ''}}">
                                            <select class="niceSelect w-100 bb form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="user">
                                            <option data-display="@lang('lang.user') *" value="">@lang('lang.user') *</option>
                                            @if(isset($users))
                                                @foreach($users as $user)
                                                <option value={{$user->id}}>{{ $user->getName() }}</option>
                                                @endforeach
                                            @endif
                                        </select>

                                        </div>
                                        
                                    </div>
                                </div>
  
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                       <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="{{ @$tooltip}}">
                                            <span class="ti-check"></span>
                                            Allocate
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0">Allocations</h3>
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
                                    <td colspan="6">
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
                                    <th>Student/Staff</th>
                                    <th>Room</th>
                                    <th>@lang('lang.action')</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($allocations as $record)
                                <tr>
                                    <td>{{ @$record->user->getName()}}</td>
                                    <td>{{ @$record->room->name}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
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
