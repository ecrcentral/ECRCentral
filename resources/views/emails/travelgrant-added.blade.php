@component('mail::message')
Hi {{ config('app.name') }},

A new travel grant has been added to the portal. Please verify the information and publish it. 

@component('mail::button', ['url' => $url])
View Travel Grant
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
