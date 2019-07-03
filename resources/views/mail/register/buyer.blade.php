@component('mail::message')
# Bem vindo a Plataforma B2A
## {{ $client->fantasy_name }}
## {{ $client->user->email }}

@component('mail::button', ['url' => env('APP_URL')])
Acessar
@endcomponent

Obrigado,
{{ config('app.name') }}
@endcomponent
