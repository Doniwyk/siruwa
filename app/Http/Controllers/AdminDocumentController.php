<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Contracts\AdminDocumentContract;
use App\Http\Requests\ChangeDocumentStatusRequest;
use Illuminate\Http\Request;
use App\Http\Requests\ValidateDocumentRequest;
use App\Models\DocumentModel;
use Exception;

class AdminDocumentController extends Controller
{

    protected AdminDocumentContract $documentService;

    public function __construct(AdminDocumentContract $documentService)
    {
        $this->documentService = $documentService;
    }

    public function index(Request $request)
    {
        try {
            $typeDocument = $request->query('typeDocument', 'pengajuan');
            $page = 'data-dokumen';
            $title = 'Manajemen Dokumen';
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
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data tidak ditemukan ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }

    public function validateDocument(ValidateDocumentRequest $request, DocumentModel $document)
    {

        $action = $request->action;
        try {
            $validatedData = $request->validated();
            $this->documentService->validateDocument($validatedData, $action, $document);
        } catch (\Exception $e) {
            return redirect()->route('admin.data-dokumen.index')->with('error', 'Terjadi kesalahan tak terduga saat memvalidasi dokumen.');;
        }
        return redirect()->route('admin.data-dokumen.index');
    }

    public function validatedHistory(Request $request)
    {
        try{
            $typeDocument = $request->query('typeDocument', 'riwayat');
            $page = 'data-dokumen';
            $title = 'Manajemen Dokumen';
            $documentHistory = $this->documentService->getValidateHistory();
            return view('admin._document.history', compact('documentHistory'));
        } catch(\Exception $e){
            return redirect()->back()->with('error', 'Data tidak ditemukan ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }

    }


    public function getEditPage(DocumentModel $document)
    {
        try{
            $page = 'edit-data-dokumen';
            $title = 'Manajemen Dokumen';
            $document = $document->findOrFail($document->id_dokumen);
            return view('admin._document.edit', compact('page', 'title', 'document'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data tidak ditemukan ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }

    }

    public function changeStatus(ValidateDocumentRequest $request, DocumentModel $document)
    {
        $action = $request->status;
        try {
            $validatedData = $request->validated();
            $this->documentService->changeStatus($validatedData, $document, $action);
        } catch (\Exception $e) {
            report($e);
            return redirect()->route('admin.data-dokumen.index')->with('error', 'Terjadi kesalahan tak terduga saat mengganti status.');
        }
        return redirect()->route('admin.data-dokumen.index', ['typeDocument' => 'ongoing']);

    }


    public function getProcessedData(Request $request) //get data dokumen dengan status proses
    {
        try{
            $typeDocument = $request->query('typeDocument', 'proses');
            $page = 'data-dokumen';
            $title = 'Manajemen Dokumen';
            $documents = $this->documentService->getProcessedDocument();
            return view('admin._document.index', compact('documents', 'typeDocument', 'page', 'title'));
        } catch (\Exception $e) {
            return redirect()->route('admin.data-dokumen.index')->with('error', 'Terjadi kesalahan tak terduga saat mengganti status.');
        }
    }


    public function getCanBeTakenData(Request $request) //get data dokumen dengan status bisa diambil
    {
        try{
            $typeDocument = $request->query('typeDocument', 'bisa diambil');
            $page = 'data-dokumen';
            $title = 'Manajemen Dokumen';
            $documents = $this->documentService->getCanBeTakenDocument();
            return view('admin._document.index', compact('documents', 'typeDocument', 'page', 'title'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data tidak ditemukan ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }

    }


    public function changeIntoSelesai(DocumentModel $document)
    {
        try {
            $this->documentService->changeIntoSelesai($document);
        } catch (\Exception $e) {
            return redirect()->route('admin.data-dokumen.index')->with('error', 'Terjadi kesalahan tak terduga saat mengubah status dokumen.');;
        }
        return redirect()->route('admin.data-dokumen.index');
    }
}
