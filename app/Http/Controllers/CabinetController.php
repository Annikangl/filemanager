<?php

namespace App\Http\Controllers;

use App\Traits\WithEvents;
use Illuminate\Http\Request;

class CabinetController extends Controller
{
    use WithEvents;

    public function index()
    {
        $user = \Auth::user();

        $events = $this->getEvents();

        return view('cabinet.index', compact('user', 'events'));
    }
}
