@component('mail::message')
Hi {{ config('app.name') }},

A new resource has been added to the portal. Please verify the information and publish it. 

@component('mail::button', ['url' => $url])
View Resource
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
