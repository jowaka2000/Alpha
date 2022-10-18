@component('mail::message')
# {{$header}}

{{$message}}

<br>

@if ($url!='')


@component('mail::panel')
  Reach out our support team by clicking the link below
@endcomponent

@component('mail::button', ['url' => $url,'color'=>'success'])
Alpha Bailwake Help Center
@endcomponent

@endif


Thank you and continue using our services,<br>
{{ config('app.name') }}

@component('mail::footer')
 Follow us on twiter twiter.com <br>
 On facebook fac.com <br>
@endcomponent
@endcomponent
