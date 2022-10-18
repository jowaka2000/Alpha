@component('mail::message')
# Welcome to {{config('app_name')}}

{{$message}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
