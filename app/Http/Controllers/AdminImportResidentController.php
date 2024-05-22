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
        try {
            $validatedData = $request->validated();
            $this->importService->importResident($validatedData);
        } catch (\Exception $e) {
            report($e);
            return redirect()->route('admin.data-penduduk.index')->with('Terjadi kesalahan tak terduga saat import data.');
        }
        return redirect()->route('admin.data-penduduk.index');
    }
}
