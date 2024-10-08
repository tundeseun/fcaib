@if(userPermission(920) )
<li>
    <a href="#subMenuBulkPrint" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <span class="ti-printer"></span>
        @lang('lang.bulk_print')
    </a>
    <ul class="collapse list-unstyled" id="subMenuBulkPrint">
        @if(userPermission(921)  )
            <li >
                <a href="{{route('student-id-card-bulk-print')}}">@lang('lang.id_card')</a>
            </li>
       @endif
        @if(userPermission(922)  )
            <li >
                <a href="{{route('certificate-bulk-print')}}">  @lang('lang.student')  @lang('lang.certificate')</a>
            </li>
          @endif
 

     @if(userPermission(924)  )
        <li >
            <a href="{{route('payroll-bulk-print')}}"> @lang('lang.payroll') @lang('lang.bulk_print')</a>
        </li>
    @endif

      @if(userPermission(926)  )
        <li >
            <a href="{{route('fees-bulk-print')}}"> @lang('lang.fees') @lang('lang.invoice') @lang('lang.bulk')   @lang('lang.print')</a>
        </li>
    @endif
    
     @if(userPermission(925)  )
        <li >
            <a href="{{route('invoice-settings')}}"> @lang('lang.fees') @lang('lang.invoice') @lang('lang.settings')</a>
        </li>
      @endif
       
    </ul>
</li>
@endif
