<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileRequest;
use App\Models\Media;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        $uploads = Upload::query()->with(['user', 'media'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(20);

        return view('dashboard.index', compact('uploads'));
    }

    public function uploadForm()
    {
        return view('dashboard.upload');
    }

    /**
     */
    public function upload(UploadFileRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $upload = Upload::query()->create([
                    'filename' => md5(uniqid(rand(), true)),
                    'user_id' => Auth::id(),
                    'expired_at' => $request->validated('file_expired'),
                ]);

                try {
                    $upload->addMedia($file)
                        ->toMediaCollection('uploads');

                    $request->session()->push('links', $upload->getFirstMediaUrl('uploads'));
                } catch (\Throwable $exception) {
                    $request->session()->flash('error', $exception->getMessage());
                    return back();
                }
            }

            $request->session()->flash('success', 'Файл успешно загружен');
            return back();
        }


        return back()->with('error', 'Пожалуйста, выберите файл для загрузки');
    }

    public function download(Upload $upload, Request $request)
    {
        $media = $upload->getFirstMedia('uploads');

        return $media->toResponse($request);
    }

    public function showFile(\Spatie\MediaLibrary\MediaCollections\Models\Media $media, string $fileName)
    {
        $upload = Upload::findOrFail($media->model_id);

        return view('dashboard.show', compact('media', 'upload'));
    }

    public function clearSession(Request $request)
    {
        $request->session()->flush();
        return back();
    }
}
