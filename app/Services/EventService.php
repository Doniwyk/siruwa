<?php

namespace App\Services;

use App\Contracts\EventContract;
use App\Models\EventModel;
use App\Models\NewsModel;
use PHPUnit\Event\Event;

class EventService implements EventContract
{

    public function storeEvent(array $validatedData): void
    {
        EventModel::create($validatedData);
    }

    public function updateEvent(array $validatedData, EventModel $event): void
    {
        $event->update($validatedData);
    }

    public function deleteEvent(EventModel $event): void
    {
        $event->delete();
    }
}
