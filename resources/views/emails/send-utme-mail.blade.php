@component('mail::message')
Dear {{ $user->student->full_name }},
<p>
Your payment for Post UTME was successful, please find your receipt attached.
</p>
@component('mail::button', ['url' => url('/login')])
Login
@endcomponent
@endcomponent