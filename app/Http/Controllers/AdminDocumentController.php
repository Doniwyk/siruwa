<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Contracts\AdminDocumentContract;
use Illuminate\Http\Request;
use App\Http\Requests\ValidateDocumentRequest;
use App\Models\DocumentModel;

class AdminDocumentController extends Controller
{
    
    protected AdminDocumentContract $documentService;

    public function __construct(AdminDocumentContract $documentService)
    {
        $this->documentService = $documentService;
    }
    
    public function index(Request $request)
    {
        $typeDocument = $request->query('typeDocument', 'pengajuan');
        $page = 'data-dokumen';
        $title = 'Manajemen Dokumen';
        $documents = $this->documentService->getDocumentRequest();

        return view('admin._document.index', compact('documents', 'typeDocument', 'page', 'title'));
    }
  
    public function validateDocument(ValidateDocumentRequest $request, string $action, DocumentModel $document)
    {
        try {
            $validatedData = $request->validated();
            $this->documentService->validateDocument($validatedData, $action, $document);
        } catch(\Exception $e){
            report($e);
            return redirect()->route('admin.data-dokumen.index')->with('error', 'Terjadi kesalahan tak terduga saat memvalidasi dokumen.');;
        }
        return redirect()->route('admin.data-dokumen.index');
    }
    public function validatedHistory(){
        $documentHistory = $this->documentService->getValidateHistory();
        return view('admin._document.history', compact('documentHistory'));
    }
    public function getEditPage(DocumentModel $document)
    {
        $page = 'edit-data-dokumen';
        $title = 'Manajemen Dokumen';
        $documents = $this->documentService->getDocumentRequest();
        $document = $document->findOrFail($document->id_dokumen);
        return view('admin._document.edit', compact('page', 'title', 'document'));
    }
    public function changeStatus(ValidateDocumentRequest $request, DocumentModel $document){
        try {
            $validatedData = $request->validated();
            $this->documentService->changeStatus($validatedData, $document);
        } catch (\Exception $e) {
            report($e);
            return redirect()->route('admin.data-dokumen.index')->with('error', 'Terjadi kesalahan tak terduga saat mengganti status.');
        }
        return redirect()->route('admin.data-dokumen.index');
    }
}
