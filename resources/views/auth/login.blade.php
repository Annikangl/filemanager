@extends('layouts.app')

@section('title') Авторизация @endsection

@section('content')
    <body class="auth-body-bg">
    <div class="accountbg"></div>
    <div class="wrapper-page">
        <div class="card">

            <div class="card-body">
                <h3 class="text-center mt-0 mb-3">
                    <a href="#" class="logo"><img src="{{ asset('assets/images/logo-light.png') }}" height="24"
                                                           alt="logo-img"></a>
                </h3>
                <h5 class="text-center mt-0 text-color"><b>Вход в систему</b></h5>

                <form class="form-horizontal mt-3 mx-3" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <div class="col-12">
                            <input class="form-control @error('name') is-invalid @enderror" type="text" required="" name="name" placeholder="Имя пользователя">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <div class="col-12">
                            <input class="form-control @error('password') is-invalid @enderror" type="password" required="" name="password" placeholder="Пароль">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <div class="checkbox checkbox-primary">
                                <input id="checkbox-signup" type="checkbox" checked="" name="remember">
                                <label for="checkbox-signup" class="text-color">
                                    Запомнить меня
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center mt-3">
                        <div class="col-12">
                            <button class="btn btn-primary btn-block btn-lg waves-effect waves-light w-100" type="submit">
                                Войти
                            </button>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
@endsection
