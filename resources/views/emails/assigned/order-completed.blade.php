@component('mail::message')
# {{$header}}

{{$message}}

@component('mail::button', ['url' => $url,'color'=>'success'])
Check responses
@endcomponent

Thank you and continue using our services,<br>
{{ config('app.name') }}

@component('mail::footer')
 Follow us on twiter twiter.com <br>
 On facebook fac.com <br>
@endcomponent
@endcomponent
