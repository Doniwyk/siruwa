<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Contracts\DocumentContract;
use App\Http\Requests\DocumentRequest;
use App\Models\DocumentModel;
use App\Models\Dokumen;

class DocumentController extends Controller
{
    protected DocumentContract $contract;

    public function __construct(DocumentContract $contract)
    {
        $this->contract = $contract;
    }


    // CONTROLLER DOKUMEN BUAT ADMIN

    public function index(): View //Menampilkan daftar pengajuan dokumen diadmin
    {
        $dokumen = DocumentModel::latest()->get();
        $page = 'manajemen-dokumen';
        $title = 'Manajemen Dokumen';
        return view('admin._document.index', ['title' => $title,'dokument' => $dokumen , 'page'=> $page]);
    }


    public function editDocument(DocumentModel $Dokumen)
    {
        return redirect()->route('admin.manajemen-dokumen.index');
    }

    public function updateDocument(DocumentRequest $request, DocumentModel $dokumen): RedirectResponse
    {
        $validated = $request->validated();
        $this->contract->editDocument($validated, $dokumen);

        return redirect()->route('admin.manajemen-dokumen.index')->with('success', 'Dokumen updated successfully.');
    }
    
    // CONTROLLER DOKUMEN BUAT USER
    public function requestDocument(): View // Menampilkan halaman pengajuan dokumen 
    {
        return view('user._document.request');
    }

    public function requestSktm() : View //Halaman pengajuan SKTM
    { 
        return view('user._document.sktm');
    }

    public function requestSpu(): View //Halaman pengajuan SPU
    { //Halaman pengajuan SKTM
        return view('user._document.spu');
    }

    public function storeDocument(DocumentRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $this->contract->storeDocument($validated);

        return redirect()->route('user._document.history')->with('success', 'Dokumen request successfully.');
    }


    public function deleteDocument(DocumentModel $dokumen): RedirectResponse
    {
        $this->contract->deleteDocument($dokumen);

        return redirect()->route('admin.manajemen-dokumen.index')->with('success', 'Dokumen deleted successfully.');
    }

    public function getUser()
    {
        $this->contract->getUser();
    }
    public function validateDocument(Request $request, DocumentModel $dokumen): RedirectResponse
    {
        // Validasi apakah dokumen diterima atau ditolak
        $request->validate([
            'action' => 'required|in:accept,reject',
            // 'reason' => 'required_if:action,reject'
        ]);
    
        // Jika dokumen diterima
        if ($request->action === 'accept') {
            // Ubah status pengajuan menjadi "Dalam Proses"
            $dokumen->status = 'Dalam Proses';
            $dokumen->save();
    
            return redirect()->route('dokumen.index')->with('success', 'Dokumen diterima dan sedang diproses.');
        }else if ($request->action === 'reject') {
            // Ubah status pengajuan menjadi "Ditolak" dan sertakan alasan penolakan
            $dokumen->status = 'Ditolak';
            // $dokumen->alasan_penolakan = $request->reason;
            $dokumen->save();
    
            return redirect()->route('admin._document.index')->with('success', 'Dokumen ditolak');
        }
    }
}
