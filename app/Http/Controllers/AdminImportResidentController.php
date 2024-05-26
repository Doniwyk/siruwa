<?php

namespace App\Http\Controllers;

use App\Contracts\AdminResidentImportContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImportResidentRequest;
use Illuminate\Support\Facades\Session;

class AdminImportResidentController extends Controller
{
    protected AdminResidentImportContract $importService;

    public function __construct(AdminResidentImportContract $importService)
    {
        $this->importService = $importService;
    }

    public function importFile(ImportResidentRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $this->importService->importResident($validatedData);
        } catch (\Exception $e) {
            report($e);
            return redirect()->route('admin.data-penduduk.index')
                ->with('error', 'Terjadi kesalahan tak terduga saat import data.');
        }
        return redirect()->route('admin.resident.preview');
    }

    public function showPreview()
    {
        $dataPreview = Session::get('dataPreview', []);

        if (empty($dataPreview)) {
            return redirect()->route('admin.data-penduduk.index')
                ->with('error', 'Tidak ada data untuk ditampilkan.');
        }

        return view('admin.resident_preview', compact('dataPreview'));
    }

    public function saveImportedResidents()
    {
        try {
            $this->importService->saveImportedResidents();
        } catch (\Exception $e) {
            report($e);
            return redirect()->route('admin.data-penduduk.index')
                ->with('error', 'Terjadi kesalahan tak terduga saat menyimpan data.');
        }
        return redirect()->route('admin.data-penduduk.index')
            ->with('success', 'Data berhasil diimport.');
    }
}
