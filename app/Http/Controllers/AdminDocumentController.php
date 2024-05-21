<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Contracts\AdminDocumentContract;
use App\Http\Requests\ChangeDocumentStatusRequest;
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
        // $reqDocuments = $this->documentService->getDocumentRequest();
        // $historyDocuments = $this->documentService->getValidateHistory();

        switch ($typeDocument) {
            case 'pengajuan':
                $documents = $this->documentService->getDocumentRequest();
                break;
            case 'ongoing':
                $documents = $this->documentService->getDocumentOngoing();
                break;
            case 'canBeTaken':
                $documents = $this->documentService->getDocumentCanBeTaken();
                break;
            case 'riwayat':
                $documents = $this->documentService->getValidateHistory();
                break;
            
            default:

                break;
        }

        return view('admin._document.index', compact('documents', 'typeDocument', 'page', 'title'));
    }
  
    public function validateDocument(ValidateDocumentRequest $request, DocumentModel $document)
    {
        
        $action = $request->action;
        try {
            $validatedData = $request->validated();
            $this->documentService->validateDocument($validatedData, $action, $document);
        } catch(\Exception $e){
            dd($e);
            report($e);
            return redirect()->route('admin.data-dokumen.index')->with('error', 'Terjadi kesalahan tak terduga saat memvalidasi dokumen.');;
        }
        return redirect()->route('admin.data-dokumen.index');
    }
    public function validatedHistory(Request $request){
        $typeDocument = $request->query('typeDocument', 'riwayat');
        $page = 'data-dokumen';
        $title = 'Manajemen Dokumen';
        $documentHistory = $this->documentService->getValidateHistory();
        return view('admin._document.history', compact('documentHistory'));
    }
    public function getEditPage(DocumentModel $document)
    {
        $page = 'edit-data-dokumen';
        $title = 'Manajemen Dokumen';
        $document = $document->findOrFail($document->id_dokumen);
        return view('admin._document.edit', compact('page', 'title', 'document'));
    }

    public function getShowPage(DocumentModel $document)
    {
        $page = 'show-data-dokumen';
        $title = 'Manajemen Dokumen';
        $documents = $this->documentService->getDocumentRequest();
        $document = $document->findOrFail($document->id_dokumen);
        return view('admin._document.show', compact('page', 'title', 'document'));
    }
    public function changeStatus(ValidateDocumentRequest $request, DocumentModel $document){

        try {
            $validatedData = $request->validated();
            $this->documentService->changeStatus($validatedData, $document, $action);
        } catch (\Exception $e) {
            report($e);
            return redirect()->route('admin.data-dokumen.index')->with('error', 'Terjadi kesalahan tak terduga saat mengganti status.');
        }
        return redirect()->route('admin.data-dokumen.index');
    }
    public function getProcessedData(Request $request) //get data dokumen dengan status proses
    {
        $typeDocument = $request->query('typeDocument', 'proses');
        $page = 'data-dokumen';
        $title = 'Manajemen Dokumen';
        $documents = $this->documentService->getProcessedDocument();

        return view('admin._document.index', compact('documents', 'typeDocument', 'page', 'title'));
    }
    public function getCanBeTakenData(Request $request) //get data dokumen dengan status bisa diambil
    {
        $typeDocument = $request->query('typeDocument', 'bisa diambil');
        $page = 'data-dokumen';
        $title = 'Manajemen Dokumen';
        $documents = $this->documentService->getCanBeTakenDocument();

        return view('admin._document.index', compact('documents', 'typeDocument', 'page', 'title'));
    }
    public function changeIntoSelesai(DocumentModel $document){
        try {
            $this->documentService->changeIntoSelesai($document);
        } catch(\Exception $e){
            report($e);
            return redirect()->route('admin.data-dokumen.index')->with('error', 'Terjadi kesalahan tak terduga saat mengubah status dokumen.');;
        }
        return redirect()->route('admin.data-dokumen.index');
    }

}
