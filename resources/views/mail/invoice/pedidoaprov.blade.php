<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal DRS</title>
</head>
<body>
<div class="flex-center position-ref full-height">
    <h1 class="title">Olá {{$solicitacao->solicitante}} seu pedido de compra: {{ $solicitacao->num_pedido }} foi aprovado!
    </h1>
    <h1>
        Previsão de entrega: {{ $solicitacao->data_entrega }}
    </h1>
    <hr>
    Obrigado,<br>
    Drs Group Ltda
</div>
</body>
</html>

