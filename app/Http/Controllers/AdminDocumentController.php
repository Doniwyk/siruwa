<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Contracts\AdminDocumentContract;
use App\Http\Requests\ValidateDocumentRequest;
use App\Models\DocumentModel;

class AdminDocumentController extends Controller
{
    
    protected AdminDocumentContract $documentService;

    public function __construct(AdminDocumentContract $documentService)
    {
        $this->documentService = $documentService;
    }
    
    public function index()
    {
        $documentData = $this->documentService->getDocumentRequest();
        return view('admin._document.index', compact('documentData'));
    }
  
    public function validateDocument(ValidateDocumentRequest $request, string $action, DocumentModel $document)
    {
        try {
            $validatedData = $request->validated();
            $this->documentService->validateDocument($validatedData, $action, $document);
        } catch(\Exception $e){
            report($e);
            return redirect()->route('admin._document.index')->with('error', 'Terjadi kesalahan tak terduga saat memvalidasi dokumen.');;
        }
        return redirect()->route('admin._document.index');
    }
    public function validatedHistory(){
        $documentHistory = $this->documentService->getValidateHistory();
        return view('admin._document.history', compact('documentHistory'));
    }
    public function getEditPage()
    {
        return view('admin._document.edit');
    }
    public function changeStatus(ValidateDocumentRequest $request, DocumentModel $document){
        try {
            $validatedData = $request->validated();
            $this->documentService->changeStatus($validatedData, $document);
        } catch (\Exception $e) {
            report($e);
            return redirect()->route('admin._document.index')->with('error', 'Terjadi kesalahan tak terduga saat mengganti status.');
        }
        return redirect()->route('admin._document.index');
    }
}
