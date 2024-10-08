@extends('backEnd.master')
@section('title')
    @lang('lang.exam_attendance')
@endsection
@section('mainContent')

    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>@lang('lang.exam_attendance') </h1>
                <div class="bc-pages">
                    <a href="{{ route('dashboard') }}">@lang('lang.dashboard')</a>
                    <a href="#">@lang('lang.examination')</a>
                    <a href="#">@lang('lang.exam_attendance')</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row mb-20">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="main-title sm_mb_20">
                        <h3 class="mb-0">@lang('lang.select_criteria') </h3>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    @if (session()->has('message-success') != '')
                        @if (session()->has('message-success'))
                            <div class="alert alert-success">
                                {{ session()->get('message-success') }}
                            </div>
                        @endif
                    @endif
                    <div class="white-box">
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'exam_attendance', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student']) }}
                        <div class="row">
                            <input type="hidden" name="url" id="url" value="{{ URL::to('/') }}">
                            <div class="col-lg-4 mt-30-md">
                                <select
                                    class="w-100 bb niceSelect form-control {{ $errors->has('class') ? ' is-invalid' : '' }}"
                                    id="class_subject" name="class">
                                    <option data-display="@lang('lang.select_class') *" value="">@lang('lang.select_class') *</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}"
                                            {{ isset($class_id) ? ($class_id == $class->id ? 'selected' : '') : '' }}>
                                            {{ $class->class_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('class'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('class') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-lg-4 mt-30-md" id="select_class_subject_div">
                                <select
                                    class="w-100 bb niceSelect form-control{{ $errors->has('subject') ? ' is-invalid' : '' }} select_class_subject"
                                    id="select_class_subject" name="subject">
                                    <option data-display="@lang('lang.select_subject') *" value="">@lang('lang.select_subject') *</option>
                                </select>
                                <div class="pull-right loader loader_style" id="select_class_subject_loader">
                                    <img class="loader_img_style" src="{{ asset('public/backEnd/img/demo_wait.gif') }}"
                                        alt="loader">
                                </div>
                                @if ($errors->has('subject'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('subject') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-lg-4 mt-30-md" id="m_select_subject_section_div">
                                <select
                                    class="w-100 bb niceSelect form-control{{ $errors->has('section') ? ' is-invalid' : '' }} m_select_subject_section"
                                    id="m_select_subject_section" name="section">
                                    <option data-display="@lang('lang.select_section') " value=" ">@lang('lang.select_section') </option>
                                </select>
                                <div class="pull-right loader loader_style" id="select_section_loader">
                                    <img class="loader_img_style" src="{{ asset('public/backEnd/img/demo_wait.gif') }}"
                                        alt="loader">
                                </div>
                                @if ($errors->has('section'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('section') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-lg-12 mt-20 text-right">
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
            @if (isset($exam_attendance))
                <div class="d-flex justify-content-end mt-3">
                    <button class="btn btn-primary mx-3" id="downloadBtn"><i class="fa fa-download"></i> Download</button>
                    <a class="btn btn-outline-primary mx-3" href="javascript:void(0)" id="printBtn">
                        <i class="fa fa-print"></i> Print
                    </a>
                </div>
                <div class="row mt-40" id="printSection">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class=" bg-white p-3">
                                    <div width="100%">
                                        <h3><big>Exam Attendance Sheet</big><br />Department:
                                            {{ $class_name }}<br />Course: {{ $subject->subject_name }}<br />Course
                                            Code: {{ strtoupper($subject->subject_code) }}<br />Level: {{ $section_name }}
                                        </h3>
                                    </div>
                                    <table class="table" cellspacing="0" width="100%">

                                        <thead>
                                            @if (session()->has('message-danger') != '')
                                                <tr width="100%">
                                                    <td colspan="9">
                                                        @if (session()->has('message-danger'))
                                                            <div class="alert alert-danger">
                                                                {{ session()->get('message-danger') }}
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <th class="border p-3">Matric Number</th>
                                                <th class="border p-3">Photo</th>
                                                <th class="border p-3">@lang('lang.student') @lang('lang.name')</th>
                                                <th class="border p-3">Student Signature</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($exam_attendance as $student)
                                                <tr>

                                                    <td class="border p-3">
                                                        {{ @$student->matric_number != '' ? @$student->matric_number : '' }}<input
                                                            type="hidden" name="id[]"
                                                            value="{{ @$student->student_id }}"></td>
                                                    <td class="border p-3"><img
                                                            src="{{ @$student->student_photo ?? asset('public/uploads/staff/demo/staff.jpg') }}"
                                                            width="80px" height="80px"></td>
                                                    <td class="border p-3">
                                                        {{ ucwords($student->first_name . ' ' . @$student->last_name) }}
                                                    </td>
                                                    <td class="border p-3">

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
            @endif
        </div>
    </section>

@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
    referrerpolicy="no-referrer"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const printBtn = $('#printBtn');
        const downloadBtn = $('#downloadBtn');
        printBtn.on('click', function() {
            let data = $('#printSection');
            const printWindow = window.print(data);
            printWindow.document.write(data.html());

        })

        downloadBtn.on('click', function() {
            $(this).attr('disabled', true)
            const element = document.getElementById('printSection');
            html2pdf(element);
            setTimeout(() => {
                $(this).attr('disabled', false)
            }, 2000);
        })
    })
</script>
