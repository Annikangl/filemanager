@extends('layouts.app')

@section('title')
    Главная
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
                                <h4 class="mb-sm-0">Мои файлы</h4>
                                @include('includes.breadcrumbs')
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-sm-6 col-lg-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h4 class="card-title text-muted">Скачано файлов</h4>
                                    <h2 class="mt-3 mb-2"><i class="mdi mdi-arrow-down text-danger me-2"></i><b>8952</b>
                                    </h2>
                                    <p class="text-muted mb-0 mt-3"><b>48%</b> From Last 24 Hours</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="card text-center">
                                <div class="card-body p-t-10">
                                    <h4 class="card-title text-muted mb-0">Загруженных файлов</h4>
                                    <h2 class="mt-3 mb-2"><i class="mdi mdi-arrow-up text-success me-2"></i><b>6521</b>
                                    </h2>
                                    <p class="text-muted mb-0 mt-3"><b>42%</b> Orders in Last 10 months</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="card text-center">
                                <div class="card-body p-t-10">
                                    <h4 class="card-title text-muted mb-0">Unique Visitors</h4>
                                    <h2 class="mt-3 mb-2"><i class="mdi mdi-arrow-up text-success me-2"></i><b>452</b>
                                    </h2>
                                    <p class="text-muted mb-0 mt-3"><b>22%</b> From Last 24 Hours</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="card text-center">
                                <div class="card-body p-t-10">
                                    <h4 class="card-title text-muted mb-0">Monthly Earnings</h4>
                                    <h2 class="mt-3 mb-2"><i class="mdi mdi-arrow-down text-danger me-2"></i><b>5621</b>
                                    </h2>
                                    <p class="text-muted mb-0 mt-3"><b>35%</b> From Last 1 Month</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->


                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-h-100">
                                <div class="card-body">
                                    <h4 class="mb-4 mt-0 card-title">Мои файлы</h4>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table table-hover mb-0 table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>Название</th>
                                                        <th>Расширение</th>
                                                        <th>Размер</th>
                                                        <th>Дата загрузки</th>
                                                        <th>Окончание хранения</th>
                                                        <th>Действия</th>
                                                    </tr>

                                                    </thead>
                                                    <tbody>
                                                    @foreach($uploads as $upload)
                                                        <tr>
                                                            <td style="max-width: 400px">{{ $upload->getOriginalName() }}</td>
                                                            <td> {{ $upload->getExtension() }}</td>
                                                            <td>{{ $upload->getSize() }}</td>
                                                            <td>{{ $upload->created_at }}</td>
                                                            <td>{{ $upload->expired_at }}</td>
                                                            <td >
                                                                <a href="{{ route('dashboard.download', $upload) }}"
                                                                   type="button"
                                                                   class="btn btn-success btn-sm waves-effect waves-light">Скачать</a>
                                                                <a
                                                                    href="{{ route('show-file', ['media' => $upload->getFirstMedia('uploads'),
'fileName' => $upload->getOriginalName()]) }}"
                                                                    type="button"
                                                                    class="btn btn-primary btn-sm waves-effect waves-light">Посмотреть</a>
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
                        </div>
                        <!-- end col -->


                    </div>
                    <!-- end row -->
                    <!-- end row -->
                </div>

            </div>
            <!-- End Page-content -->

            @include('includes.footer')

        </div>

    </div>
@endsection
