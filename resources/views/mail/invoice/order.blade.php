<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal DRS</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="flex-center position-ref full-height">
    <h2 class="title">Integração Portal/Logix: {{ date('d/m/Y H:s:i') }}</h2>
    <p>Ocorrencia: {{ $erro->error }}</p>
    @if($erro->chave_logix != '')
        <p> Chave Logix: {{ $erro->chave_logix }}</p>
    @endif
    <p>Total de registros Logix: {{ $erro->count }}</p>
    Obrigado,<br>
    {{ config('app.name') }}
</div>
</body>
</html>

