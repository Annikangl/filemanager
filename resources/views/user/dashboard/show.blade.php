@extends('layouts.app')

@section('content')

    @include('includes.header')
    @include('includes.leftSidebar')

    <div class="main-content">

        <div class="page-content">
            <div class="container">
                <div class="col-md-12">
                    @if($upload->isImage($media))
                        <div class="card">
                            <img class="card-img-top img-fluid" src="{{ $media->getUrl() }}"
                                 alt="{{ $media->file_name }}">
                            <div class="card-body">
                                <h4 class="card-title">{{ $media->file_name }}</h4>
                                <a href="{{ route('dashboard.download', $upload) }}"
                                   class="btn btn-primary waves-effect waves-light text-center">Скачать</a>
                            </div>
                        </div>

                    @else
                        <div class="card card-body">
                            <h3 class="card-title text-center mb-3">{{ $media->file_name }}</h3>
                            <a href="{{ route('dashboard.download', $upload) }}"
                               class="btn btn-primary waves-effect waves-light">Скачать</a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    @include('includes.footer')
@endsection
