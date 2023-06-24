@extends('layouts.app')

@section('title')
    Редактирование
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
                            <h4 class="card-title">Редактирование срока хранения файла: <br> {{ $upload->getOriginalName() }}</h4>
                            <p class="card-title-desc">
                                Заполнить полностью форму с данными пользователя и нажмите <code>Сохранить</code> или
                                <code>Отменить</code>.</p>
                            @include('includes.alert')
                            <form action="{{ route('dashboard.uploads.update', $upload) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div>

                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Срок хранения</label>
                                        <div class="col-sm-10">
                                            <select class="form-select" aria-label="Select expired at" name="file_expired" required>
                                                <option value="1">1 час</option>
                                                <option value="12">12 часов</option>
                                                <option value="24">1 день</option>
                                                <option value="168">1 неделя</option>
                                                <option value="720">1 месяц</option>
                                                <option value="4320">6 месяцев</option>
                                                @if(auth()->user()->isAdmin())
                                                    <option value="43800">Бессрочно</option>
                                                @endif
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
