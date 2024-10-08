
@if(userPermission(554) )
    <li >
        <a href="#zoomMenu" data-toggle="collapse" aria-expanded="false"
        class="dropdown-toggle">
            <span class="ti-video-camera"></span>
        @lang('lang.virtual_class')
        </a>
        <ul class="collapse list-unstyled" id="zoomMenu">
            @if(userPermission(555) )
                <li >
                    <a href="{{ route('zoom.virtual-class')}}">@lang('lang.virtual_class')</a>
                </li>
            @endif
            @if(userPermission(560) )
                <li >
                    <a href="{{ route('zoom.meetings') }}">@lang('lang.virtual_meeting')</a>
                </li>
            @endif
            @if(userPermission(565) )
                <li >
                    <a href="{{ route('zoom.virtual.class.reports.show') }}">@lang('lang.class_reports')</a>
                </li>
            @endif
            {{-- @if(userPermission(565) )
            <li >
                <a href="{{ route('zoom.virtual.class.reports.show') }}">@lang('lang.Recorder') @lang('lang.file')</a>
            </li>
            @endif --}}


            @if(userPermission(567) )
                <li >
                    <a href="{{ route('zoom.meeting.reports.show') }}">@lang('lang.meeting_reports')</a>
                </li>
            @endif
            @if(userPermission(569) )
                <li >
                    <a href="{{ route('zoom.settings') }}">@lang('lang.settings')</a>
                </li>
            @endif
        </ul>
    </li>
    <!-- Zoom Menu  -->
@endif
