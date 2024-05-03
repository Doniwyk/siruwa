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

        return redirect()->route('manajemen-dokumen')->with('success', 'Dokumen added successfully.');
    }

    public function updateDocument(Dokumen $Dokumen): View
    {
        return view('admin._document.edit', compact('dokumen'));
    }

    public function editDocument(DocumentRequest $request, Dokumen $dokumen): RedirectResponse
    {
        $validated = $request->validated();
        $this->contract->editDocument($validated, $dokumen);

        return redirect()->route('manajemen-dokumen')->with('success', 'Dokumen updated successfully.');
    }

    public function deleteDocument(Dokumen $dokumen): RedirectResponse
    {
        $this->contract->deleteDocument($dokumen);

        return redirect()->route('manajemen-dokumen')->with('success', 'Dokumen deleted successfully.');
    }

    public function getUser()
    {
        $this->contract->getUser();
    }
}
