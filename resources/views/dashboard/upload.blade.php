@extends('layouts.app')

@section('title')
    Загрузка файлов
@endsection

@section('content')
    <div id="layout-wrapper">

        @include('includes.header')

        @include('includes.leftSidebar')

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    @include('includes.alert')

                    @if (session('links'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            @foreach(session()->get('links') as $link)
                                <a href="{{ $link }}">{{ $link }}</a>
                            @endforeach

                                <form action="{{ route('clear-session') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </form>

                        </div>
                    @endif

                    <form action="{{ route('dashboard.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Загрузка файлов</h4>
                                <p class="card-title-desc">Выберите файл на вашем устройстве и загрузите его/</p>
                                <div class="input-group mb-3">
                                    <label class="col-sm-2 col-form-label">Файл</label>
                                    <input type="file" class="form-control" id="input_file" name="files[]" required multiple>
                                </div>
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
                                <div class="input-group justify-content-center">
                                    <button type="submit" class="btn btn-primary btn-lg waves-effect waves-light">
                                        Загрузить
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            @include('includes.footer')

        </div>

@endsection
