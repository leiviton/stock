<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal DRS</title>
</head>
<body>
<div class="flex-center position-ref full-height">
    <h1 class="title">Olá {{ $solicitacao[0]->solicitante }}, você realizou uma solicitação de compras: {{ $order }}</h1>
    <hr>
    <table>
        <thead>
        <tr>
            <td>
                Produto
            </td>
            <td>
                Quantidade
            </td>
        </tr>
        </thead>
        <tbody>
        @foreach($solicitacao as $s)
            <tr>
                <td>{{$s->descri_prod}}</td>
                <td>{{(int)$s->qtd_prod}}</td>
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

