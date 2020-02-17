<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal DRS</title>
</head>
<body>
<div class="flex-center position-ref full-height">
    <h2 class="title">Olá {{$solicitacao->nome_aprov}} você tem um pedido pendente de aprovação</h2>
    <p>Numero do pedido: {{ $order }}</p>
    <hr>
    Obrigado,<br>
    Drs Group Ltda
</div>
</body>
</html>

