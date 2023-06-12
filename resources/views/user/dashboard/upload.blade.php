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

                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Загрузка файлов</h4>
                                <p class="card-title-desc">Выберите файл на вашем устройстве и загрузите его/</p>
                                <div class="input-group mb-3">
                                    <label class="col-sm-2 col-form-label">Файл</label>
                                    <input type="file" class="form-control" id="customFile" name="input_file" required>
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
