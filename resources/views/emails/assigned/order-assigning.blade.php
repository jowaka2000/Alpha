@component('mail::message')
# YOU HAVE BEEN ASSIGNED AN ORDER

{{$message}}

<br>
@component('mail::button', ['url' => $url,'color'=>'success'])
   Check the assignment
@endcomponent

Thank you and continue using our services,<br>
{{ config('app.name') }}

@component('mail::footer')
 Follow us on twiter twiter.com <br>
 On facebook fac.com <br>
@endcomponent
@endcomponent
