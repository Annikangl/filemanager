<?php

namespace App\Http\Controllers;

use App\Http\Requests\Upload\UpdateUploadRequest;
use App\Models\Upload;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function index()
    {
        $uploads = Upload::query()->with(['user', 'media'])->latest()->get();

        return view('dashboard.uploads.index', compact('uploads'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Upload $upload)
    {
        return view('dashboard.uploads.edit', compact('upload'));
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
