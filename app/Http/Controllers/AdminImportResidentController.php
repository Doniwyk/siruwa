<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Services\AdminImportService;

class AdminImportResidentController extends Controller
{
    protected $importService;

    public function __construct(AdminImportService $importService)
    {
        $this->importService = $importService;
    }

    public function importForm()
    {
        $title = 'Form Tambah Penduduk';
        $page = 'tambah-data-penduduk';
        Log::info('Displaying import form.');
        return view('admin._dasawismaData.import', compact('title', 'page'));
    }

    public function importFile(Request $request)
    {
        Log::info('Started importFile method.');

        try {
            // Validate file upload
            $request->validate([
                'file' => 'required|file|mimes:csv,txt|max:2048',
            ]);
            Log::info('File validated successfully.');

            $file = $request->file('file');
            $this->importService->importResident($file);
            Log::info('Import service called successfully.');

            return redirect()->route('admin.data-penduduk.preview')->with('success', 'File imported successfully, preview the data.');
        } catch (\Exception $e) {
            Log::error('Error during file import: ' . $e->getMessage());
            return redirect()->route('admin.data-penduduk.import')->with('error', 'Terjadi kesalahan saat import data.');
        }
    }

    public function previewImport()
    {
        Log::info('Started previewImport method.');
        $dataPreview = Session::get('dataPreview', []);

        if (empty($dataPreview)) {
            Log::warning('No data to preview.');
            return redirect()->route('admin.data-penduduk.import')->with('error', 'No data to preview.');
        }

        Log::info('Displaying data preview.');
        return view('admin._dasawismaData.preview', compact('dataPreview'));
    }

    public function saveImportedResidents()
    {
        Log::info('Started saveImportedResidents method.');

        try {
            $this->importService->saveImportedResidents();
            Log::info('Save imported residents called successfully.');
            return redirect()->route('admin.data-penduduk.index')->with('success', 'Data berhasil diimport.');
        } catch (\Exception $e) {
            Log::error('Error during saving imported residents: ' . $e->getMessage());
            return redirect()->route('admin.data-penduduk.index')->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }
}
