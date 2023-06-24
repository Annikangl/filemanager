<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Traits\WithEvents;

class UserController extends Controller
{
    use WithEvents;

    public function index()
    {
        $users = User::query()
            ->where('id', '<>', auth()->id())
            ->latest()->get();

        $events = $this->getEvents();

        return view('dashboard.users.index', compact('users', 'events'));
    }

    public function create()
    {
        $events = $this->getEvents();

        return view('dashboard.users.create', compact('events'));
    }


    public function store(CreateUserRequest $request)
    {
        $requestData = $request->validated();

        $user = new User();

        $user->name = $requestData['name'];
        $user->email = $requestData['email'];
        $user->password = bcrypt($requestData['password']);
        $user->role = $requestData['role'];

        $user->save();

        return redirect()->route('dashboard.users.index')
            ->with('success', 'Учетная запись пользователя успешно создана!');
    }

    public function edit(User $user)
    {
        $events = $this->getEvents();

        return view('dashboard.users.edit', compact('user', 'events'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $requestData = $request->validated();

        $user->name = $requestData['name'];
        $user->email = $requestData['email'];

        if ($user->password !== bcrypt($requestData['password'])) {
            $user->password = bcrypt($requestData['password']);
        }

        $user->save();

        return redirect()->route('dashboard.users.index')
            ->with('success', 'Учетная запись пользователя успешно обновлена!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        $user->uploads()->delete();

        return back()->with('info', 'Учетная запись пользователя была удалена!');
    }
}
