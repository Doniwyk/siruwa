<?php

namespace App\Contracts;

use App\Http\Requests\ImportResidentRequest;

interface AdminResidentImportContract
{
    public function importResident(ImportResidentRequest $request);

    public function saveImportedResidents();
}
