@extends('backEnd.master')
@section('title') 
@lang('lang.class_time_setup')
@endsection
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Documents/Forms Upload</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.academics')</a>
                <a href="#">Documents/Forms Upload</a>
            </div>
        </div>
    </div>
</section>
<div class="white-box">
    <div class="text-right mb-20">
        <button type="button" data-toggle="modal" data-target="#add_document_madal"
                class="primary-btn tr-bg text-uppercase bord-rad">
            @lang('lang.upload') @lang('lang.document')
            <span class="pl ti-upload"></span>
        </button>
    </div>
    <table id="" class="table simple-table table-responsive school-table"
           cellspacing="0">
        <thead class="d-block">
        <tr class="d-flex">
            <th class="col-3">@lang('lang.title')</th>
            <th class="col-4">@lang('lang.name')</th>
            <th class="col-2">Purpose</th>
            <th class="col-3">@lang('lang.action')</th>
        </tr>
        </thead>

        <tbody class="d-block">

        @foreach($documents as $document)
            <tr class="d-flex">
                <td class="col-3">{{$document->title}}</td>
                <td class="col-4">{{showDocument($document->file)}}</td>
                <td class="col-2">{{$document->purpose}}</td>
                <td class="col-3">
                    @if (file_exists($document->file))
                        <a class="primary-btn tr-bg text-uppercase bord-rad"
                        href="{{url($document->file)}}" download>
                            @lang('lang.download')<span class="pl ti-download"></span>
                        </a>
                    @endif
                    <a class="primary-btn icon-only fix-gr-bg" data-toggle="modal"
                       data-target="#deleteDocumentModal{{$document->id}}" href="#">
                        <span class="ti-trash"></span>
                    </a>

                </td>
            </tr>
            <div class="modal fade admin-query" id="deleteDocumentModal{{$document->id}}">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">@lang('lang.delete')</h4>
                            <button type="button" class="close" data-dismiss="modal">
                                &times;
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="text-center">
                                <h4>@lang('lang.are_you_sure_to_delete')</h4>
                            </div>

                            <div class="mt-40 d-flex justify-content-between">
                                <button type="button" class="primary-btn tr-bg"
                                        data-dismiss="modal">@lang('lang.cancel')
                                </button>
                                <a class="primary-btn fix-gr-bg"
                                   href="{{route('delete-student-document', [$document->id])}}">
                                    @lang('lang.delete')</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
        </tbody>
    </table>
</div>
<div class="modal fade admin-query" id="add_document_madal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> @lang('lang.upload') @lang('lang.document')</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="container-fluid">
                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'add-document',
                                        'method' => 'POST', 'enctype' => 'multipart/form-data', 'name' => 'document_upload']) }}
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row mt-25">
                                <div class="col-lg-12">
                                    <div class="input-effect">
                                        <input class="primary-input form-control{" type="text"
                                               name="title" value="" id="title">
                                        <label> @lang('lang.title')<span>*</span> </label>
                                        <span class="focus-border"></span>

                                        <span class=" text-danger" role="alert"
                                              id="amount_error">
                                            
                                        </span>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row mt-25">
                                <div class="col-lg-12">
                                    <div class="input-effect">
                                        <select class="niceSelect w-100 bb form-control" name="purpose" >
                                            <option data-display="Select Purpose" value="">Select Purpose</option>
                                            <option value="First Year Clearance">First Year Clearance</option>
                                            <option value="Final Year Clearance">Final Year Clearance</option>
                                            <option value="Others">Others</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-30">
                            <div class="row no-gutters input-right-icon">
                                <div class="col">
                                    <div class="input-effect">
                                        <input class="primary-input" type="text"
                                               id="placeholderPhoto" placeholder="Document"
                                               disabled>
                                        <span class="focus-border"></span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button class="primary-btn-small-input" type="button">
                                        <label class="primary-btn small fix-gr-bg" for="photo"> @lang('lang.browse')</label>
                                        <input type="file" class="d-none" name="photo"
                                               id="photo">
                                    </button>
                                </div>
                            </div>
                        </div>


                        <!-- <div class="col-lg-12 text-center mt-40">
                            <button class="primary-btn fix-gr-bg" id="save_button_sibling" type="button">
                                <span class="ti-check"></span>
                                save information
                            </button>
                        </div> -->
                        <div class="col-lg-12 text-center mt-40">
                            <div class="mt-40 d-flex justify-content-between">
                                <button type="button" class="primary-btn tr-bg"
                                        data-dismiss="modal">@lang('lang.cancel')
                                </button>

                                <button class="primary-btn fix-gr-bg submit" type="submit">@lang('lang.save')
                                </button>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection