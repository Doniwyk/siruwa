<?php

namespace App\Contracts;

use App\Models\EventModel;

interface EventContract
{
    public function storeEvent(array $validatedData): void;

    public function updateEvent(array $validatedData, EventModel $news);

    public function deleteEvent(EventModel $news);
}
