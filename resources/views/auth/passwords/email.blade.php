@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card reset">
                <div class="card-header text-center">
                    <h3>Recuperar Senha</h3>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}
                        <div class="input-group form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Digite Seu email"
                                   required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                            @endif
                        </div>
                        @if (!session('status'))
                            <div class="input-group form-group">
                                <input type="submit" value="Recuperar senha"
                                       class="btn btn-block float-right login_btn">
                            </div>
                        @endif
                        @if (session('status'))
                            <div class="input-group form-group">
                                <a href="/" type="submit" class="btn btn-block float-right btn-primary">Ir para o
                                    login</a>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
