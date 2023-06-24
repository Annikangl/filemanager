<?php

namespace App\Traits;

use App\Models\Event;

trait WithEvents
{
    private function getEvents(): \Illuminate\Database\Eloquent\Collection|array
    {
        return Event::query()->latest()->get();
    }
}
