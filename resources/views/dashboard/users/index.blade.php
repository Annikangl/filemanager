@extends('layouts.app')

@section('title')
    Управление пользователями
@endsection

@section('content')
    <div id="layout-wrapper">

        @include('includes.header')

        @include('includes.leftSidebar')

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                                <h4 class="mb-sm-0">Управление пользователями</h4>
                                @include('includes.alert')

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Пользователи</a></li>
                                        <li class="breadcrumb-item active">Управление пользователями</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Список пользователей</h4>
                                    <div class="table-responsive">
                                        <table class="table mb-0">

                                            <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Имя (Логин)</th>
                                                <th>Email</th>
                                                <th>Роль</th>
                                                <th>Зарегистрирован</th>
                                                <th>Действия</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($users as $user)
                                                <tr>
                                                    <th scope="row">{{ $user->id }}</th>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->role }}</td>
                                                    <td>{{ $user->created_at }}</td>
                                                    <td class="text-center d-flex">
                                                        <a href="{{ route('dashboard.users.edit', $user) }}" type="button"
                                                           class="btn btn-primary btn-sm waves-effect waves-light mx-1">Изменить</a>
                                                        <form action="{{ route('dashboard.users.destroy', $user) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm waves-effect waves-light">Удалить</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <!-- end row -->

                </div> <!-- container-fluid -->
            </div>

            @include('includes.footer')

        </div>

    </div>
@endsection
