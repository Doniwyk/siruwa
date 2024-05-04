<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Contracts\DocumentContract;
use App\Http\Requests\DocumentRequest;
use App\Models\Dokumen;

class DocumentController extends Controller
{
    protected DocumentContract $contract;

    public function __construct(DocumentContract $contract)
    {
        $this->contract = $contract;
    }

    public function index(): View
    {
        $dokumen = Dokumen::latest()->get();
        $page = 'manajemen-dokumen';
        return view('admin._document.index', ['pages' => 'Dokumen','dokument' => $dokumen]);

        // return view('dokumen.index', compact('dokumen'));
    }
    public function addDocument(): View
    {
        return view('admin._document.add');
    }

    public function storeDocument(DocumentRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $this->contract->storeDocument($validated);

        return redirect()->route('admin.manajemen-dokumen.index')->with('success', 'Dokumen added successfully.');
    }

    public function updateDocument(Dokumen $Dokumen): View
    {
        return view('admin._document.edit', compact('dokumen'));
    }

    public function editDocument(DocumentRequest $request, Dokumen $dokumen): RedirectResponse
    {
        $validated = $request->validated();
        $this->contract->editDocument($validated, $dokumen);

        return redirect()->route('admin.manajemen-dokumen.index')->with('success', 'Dokumen updated successfully.');
    }

    public function deleteDocument(Dokumen $dokumen): RedirectResponse
    {
        $this->contract->deleteDocument($dokumen);

        return redirect()->route('admin.manajemen-dokumen.index')->with('success', 'Dokumen deleted successfully.');
    }

    public function getUser()
    {
        $this->contract->getUser();
    }
    public function validateDocument(Request $request, Dokumen $dokumen): RedirectResponse
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
