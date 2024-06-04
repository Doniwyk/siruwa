<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Services\AdminImportService;

class AdminImportResidentController extends Controller
{
    protected $importService;
    private $pageName;

    public function __construct(AdminImportService $importService)
    {
        $this->importService = $importService;
        $this->pageName = 'data-penduduk';
    }

    public function importForm()
    {
        $title = 'Form Tambah Penduduk';
        $page = $this->pageName;
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

    public function previewImport(Request $request)
    {
        if ($request->hasFile('csv')) {
            $file = $request->file('csv');
            $csv = $this->importService->importResident($file);
            return response()->json($csv);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No file uploaded'
            ]);
        }
      
        Log::info('Displaying data preview.');
        return view('admin._dasawismaData.preview', compact('dataPreview', 'errors'));
    }

    public function saveImportedResidents(Request $request)
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