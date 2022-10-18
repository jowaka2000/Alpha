@component('mail::message')
#  UNLOCKS SUBSCRIPTION SUCCESS

{{$message}}

@component('mail::panel')
If you have any question, click the buttom below and {{env('APP_NAME')}} support team will help you instantly.
@endcomponent

@component('mail::button', ['url' => $url])
Help Center
@endcomponent


Thank you and continue using our services,<br>
{{ config('app.name') }}

@component('mail::footer')
 Follow us on twiter twiter.com <br>
 On facebook fac.com <br>
@endcomponent

@endcomponent
