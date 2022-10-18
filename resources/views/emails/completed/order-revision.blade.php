@component('mail::message')
# ORDER TASK REFUND

{{$message}}

@component('mail::button', ['url' => $url1,'color'=>'success'])
Check the order
@endcomponent

<br>
<br>


@component('mail::panel')
  You can report any issue concerning this Order and the support team will solve the problem as soon as possible.
@endcomponent


@component('mail::button', ['url' => $url2])
Report Employer
@endcomponent


Thank you and continue using our services,<br>
{{ config('app.name') }}

@component('mail::footer')
 Follow us on twiter twiter.com <br>
 On facebook fac.com <br>
@endcomponent
@endcomponent
