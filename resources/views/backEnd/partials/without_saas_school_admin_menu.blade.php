
                       <!-- @if(userPermission(410)  )

                            <li  >
                                <a href="{{route('email-settings')}}">@lang('lang.email_settings')</a>
                            </li>
                        @endif -->


                       @if(userPermission(428)  )

                                <li  >
                                    <a href="{{route('base_setup')}}">@lang('lang.base_setup')</a>
                                </li>
                         @endif



                        <!-- @if(userPermission(451)  )

                            <li  >
                                <a href="{{route('language-settings')}}">@lang('lang.language_settings')</a>
                            </li>
                        @endif -->
                        @if(userPermission(456)  )

                            <li  >
                                <a href="{{route('backup-settings')}}">@lang('lang.backup_settings')</a>
                            </li>
                        @endif
                        
                       <!-- @if(userPermission(444)  )

                            <li  >
                                <a href="{{route('sms-settings')}}">@lang('lang.sms_settings')</a>
                            </li>
                        @endif -->
                       

                        @if(userPermission(482)  )
                        <li>
                            <a href="{{route('api/permission')}}">@lang('lang.api') @lang('lang.permission') </a>
                        </li>
                    @endif
