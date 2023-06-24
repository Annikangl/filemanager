<?php

namespace App\Http\Controllers;

use App\Http\Requests\Upload\UpdateUploadRequest;
use App\Models\Upload;
use App\Traits\WithEvents;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    use WithEvents;

    public function index()
    {
        $uploads = Upload::query()->with(['user', 'media'])->latest()->get();

        $events = $this->getEvents();

        return view('dashboard.uploads.index', compact('uploads', 'events'));
    }

    public function edit(Upload $upload)
    {
        $events = $this->getEvents();
        return view('dashboard.uploads.edit', compact('upload', 'events'));
    }

    public function update(UpdateUploadRequest $request, Upload $upload)
    {
        $upload->expired_at = $request->validated('file_expired');

        $upload->save();

        return redirect()->route('dashboard.uploads.index')
            ->with('success', 'Срок хранения файла изменен успешно!');
    }

    public function destroy(Upload $upload)
    {
        $upload->clearMediaCollection();
        $upload->delete();

        return back()->with('info', 'Файл удален!');
    }
}
