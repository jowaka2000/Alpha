@component('mail::message')
# UNLOCKS SUBSCRIPTION PERIOD EXPIRED

{{$message}}

<br>
@component('mail::button', ['url' => $url,'color'=>'success'])
Subscribe here
@endcomponent

<br>

@component('mail::panel')
    If you have any queries, please reach out {{env('APP_NAME')}} support team and get help as soon as possible.
@endcomponent

<br>

@component('mail::button', ['url' => $url1])
Submit Your Queries here
@endcomponent



Thank you and continue using our services,<br>
{{ config('app.name') }}

@component('mail::footer')
 Follow us on twiter twiter.com <br>
 On facebook fac.com <br>
@endcomponent

@endcomponent
