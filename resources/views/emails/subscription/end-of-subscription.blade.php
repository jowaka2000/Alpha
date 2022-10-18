@component('mail::message')
# YOUR SUBSCRIPTION PERIOD HAS ENDED

{{$message}}

@component('mail::button', ['url' => $url,'color'=>'success'])
Renew now
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
