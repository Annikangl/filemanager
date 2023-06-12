<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileRequest;
use App\Models\Media;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class DashboardController extends Controller
{
    public function index()
    {
        $uploads = Upload::query()->with(['user', 'media'])
            ->where('user_id', Auth::id())
            ->paginate(20);

        return view('user.dashboard.index', compact('uploads'));
    }

    public function uploadForm()
    {
        return view('user.dashboard.upload');
    }

    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function upload(UploadFileRequest $request)
    {
        $upload = Upload::query()->create([
            'filename' => md5(uniqid(rand(), true)),
            'user_id' => Auth::id(),
            'expired_at' => $request->validated('file_expired'),
        ]);

        $upload->addMedia($request->validated('input_file'))
            ->toMediaCollection('uploads');

        return back()->with('success', 'Файл успешно загружен');
    }

    public function download(Upload $upload, Request $request)
    {
        $media = $upload->getFirstMedia('uploads');

        return $media->toResponse($request);
    }

    public function showFile(\Spatie\MediaLibrary\MediaCollections\Models\Media $media, string $fileName)
    {
        $upload = Upload::findOrFail($media->model_id);

        return view('user.dashboard.show', compact('media', 'upload'));
    }
}
