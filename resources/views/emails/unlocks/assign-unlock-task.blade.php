@component('mail::message')
# YOU HAVE BEEN ASSIGNED AN UNLOCK  TASK FROM {{strtoupper(config('app_name'))}}

{{$message}}
<br><br>
@component('mail::panel')
  If you have any issue or a concern, you can contact support and your issue will be solved.
@endcomponent


Thank you and continue using our services,<br>
{{ config('app.name') }}

@component('mail::footer')
 Follow us on twiter twiter.com <br>
 On facebook fac.com <br>
@endcomponent
@endcomponent
