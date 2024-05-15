<?php

namespace App\Http\Controllers;

use App\Contracts\AdminResidentImportContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImportResidentRequest;

class AdminImportResidentController extends Controller
{
    protected AdminResidentImportContract $importService;

    public function __construct(AdminResidentImportContract $importService)
    {
        $this->importService = $importService;
    }
    public function importFile(ImportResidentRequest $request){
        $validatedData = $request->validated();
        $this->importService->importResident($validatedData);

        return redirect()->route('admin._resident.index');
    }
}
