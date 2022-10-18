@component('mail::message')
# UNLOCK TASK HAS BEEN REFUNDED FOR REVISION

{{$message}}
<br>

@if ($user_message!=null)
{{$user_message}}
@endif

INSTRUCTIONS <br>

{{$instructions}}
<br>

@component('mail::subcopy')
     You can click the button below and check the task
@endcomponent

@component('mail::button',['url'=>$url,'color'=>'primary'])
Check the task
@endcomponent

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
