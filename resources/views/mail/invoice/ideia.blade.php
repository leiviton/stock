<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal DRS</title>
</head>
<body>
<div class="flex-center position-ref full-height">
    <h1 class="title">Novo cadastro enviado para o banco de idéias</h1>
    <hr>
    <p>Autor: {{ $ideia->nome }}</p>
    <p>Telefone: {{ $ideia->celular }}</p>
    <p>Email: {{ $ideia->email }}</p>
    <p>Titulo: {{ $ideia->titulo }}</p>
    <p>Descrição: {{ $ideia->descricao }}</p>
    <hr>
    Obrigado,<br>
    Drs Group Ltda
</div>
</body>
</html>

