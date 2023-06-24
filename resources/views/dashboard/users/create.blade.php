@extends('layouts.app')

@section('title')
    Добавление пользователя
@endsection

@section('content')
    <div id="layout-wrapper">

        @include('includes.header')

        @include('includes.leftSidebar')

        <div class="main-content">

            <div class="page-content">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Добавление пользователя</h4>
                            <p class="card-title-desc">
                                Заполнить полностью форму с данными пользователя и нажмите <code>Добавить</code> или
                                <code>Отменить</code>.</p>

                            @include('includes.alert')

                            <form action="{{ route('dashboard.users.store') }}" method="POST">
                                @csrf
                                <div>
                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">Имя /
                                            Логин</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="name"
                                                   value="{{ old('name') }}"
                                                   placeholder="Например, UserName_123"
                                                   id="example-text-input" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="example-email-input" class="col-sm-2 col-form-label">Эл
                                            почта</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="email" name="email"
                                                   value="{{ old('email') }}"
                                                   placeholder="john@example.com"
                                                   id="example-email-input" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="example-password-input"
                                               class="col-sm-2 col-form-label">Пароль</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="password" name="password"
                                                   id="example-password-input" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="example-password-input" class="col-sm-2 col-form-label">
                                            Повторите пароль</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="password" name="password_confirmation"
                                                   id="example-password-input"  required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Роль</label>
                                        <div class="col-sm-10">
                                            <select class="form-select" aria-label="Default select example" name="role">
                                                <option selected="" disabled>Выберите роль пользователя</option>
                                                @foreach(\App\Models\User::getUserRoles() as $role)
                                                    <option value="{{ $role }}">{{ $role }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light mx-2">
                                                Сохранить <i class="ri-arrow-right-line align-middle ms-2"></i>
                                            </button>
                                            <a href="{{ route('dashboard.users.index') }}" type="button"
                                               class="btn btn-danger waves-effect waves-light">
                                                <i class="ri-close-line align-middle me-2"></i> Отмена
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @include('includes.footer')

        </div>

    </div>
@endsection
