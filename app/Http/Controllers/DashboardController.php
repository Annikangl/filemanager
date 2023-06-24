<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileRequest;
use App\Jobs\CreateEvent;
use App\Models\Event;
use App\Models\Upload;
use App\Models\User;
use App\Traits\WithEvents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class DashboardController extends Controller
{
    use WithEvents;

    public function index()
    {
        $uploads = Upload::query()->with(['user', 'media'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(20);

        $events = $this->getEvents();

        $uploadsCount = $uploads->count();
        $downloadsCount = Auth::user()->downloads;
        $usersCount = User::count();

        return view('dashboard.index',
            compact('uploads', 'downloadsCount', 'uploadsCount', 'events', 'usersCount'));
    }

    public function uploadForm()
    {
        $events = $this->getEvents();

        return view('dashboard.upload', compact('events'));
    }

    public function upload(UploadFileRequest $request)
    {
        $request->validated();

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

            CreateEvent::dispatch('Загружен файл', 'На сервер был загружен новый файл');

            $request->session()->flash('success', 'Файл успешно загружен');
            return back();
        }


        return back()->with('error', 'Пожалуйста, выберите файл для загрузки');
    }

    public function download(Upload $upload, Request $request)
    {
        $media = $upload->getFirstMedia('uploads');

        if (Auth::check()) {
            Auth::user()->incrementDownloads();
        }

        return $media->toResponse($request);
    }

    public function showFile(Media $media, string $fileName)
    {
        $upload = Upload::findOrFail($media->model_id);

        $events = $this->getEvents();

        return view('dashboard.show', compact('media', 'upload', 'events'));
    }

    public function clearSession(Request $request)
    {
        $request->session()->flush();
        return back();
    }
}
