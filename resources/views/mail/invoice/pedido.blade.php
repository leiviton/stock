<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal DRS</title>
</head>
<body>
<div class="flex-center position-ref full-height">
    <h1 class="title"><p>
            Olá {{$solicitacao[0]->solicitante}}, foi gerado um pedido de compras através da solicitação de compras: {{ $order }}</p>
    </h1>
    <hr>
    <table>
        <thead>
        <tr>
            <td>
                Pedido:
            </td>
        </tr>
        </thead>
        <tbody>
        @foreach($solicitacao as $s)
            <tr>
                <td>{{$s->num_pedido}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <hr>
    Obrigado,<br>
    Drs Group Ltda
</div>
</body>
</html>

