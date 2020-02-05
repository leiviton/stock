<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal DRS</title>
</head>
<body>
<div class="flex-center position-ref full-height">
    <h2 class="title">Olá você acabou de criar uma solicitação de compra data/hora {{ date('d/m/Y H:s:i') }}</h2>
    <p>Sua solicitação número: {{ $solicitacao->num_solicit }}</p>
    Obrigado,<br>
    Drs Group Ltda
</div>
</body>
</html>

