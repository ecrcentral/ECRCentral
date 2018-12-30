@component('mail::message')
Hi {{ config('app.name') }},

A new funding has been added to the portal. Please verify the information and publish it. 

@component('mail::button', ['url' => $url])
View Funding
@endcomponent

Thanks,<br>
Team {{ config('app.name') }}
@endcomponent
