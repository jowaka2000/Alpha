@component('mail::message')
# ORDER RE-ASSIGNING

{{$message}}

@component('mail::button', ['url' => $url,'color'=>'danger'])
{{$button_message}}
@endcomponent


Thank you and continue using our services,<br>
{{ config('app.name') }}

@component('mail::footer')
 Follow us on twiter twiter.com <br>
 On facebook fac.com <br>
@endcomponent
@endcomponent
