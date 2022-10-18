@component('mail::message')
# UNLOCK TASK ANSWERS HAS BEEN SUBMITED

{{$message}}


<br><br>Click the button below to view the answers on {{config('app.name')}} platform.


@component('mail::button', ['url' =>$url,'color'=>'success'])
Check answers
@endcomponent

<br>

@component('mail::panel')
  Report any issue concerning this unlocks and the support team will solve the problem as soon as possible.
@endcomponent


Thank you and continue using our services,<br>
{{ config('app.name') }}

@component('mail::footer')
 Follow us on twiter twiter.com <br>
 On facebook fac.com <br>
@endcomponent
@endcomponent
