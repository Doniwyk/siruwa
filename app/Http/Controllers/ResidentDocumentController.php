<?php

namespace App\Http\Controllers;

use App\Contracts\ResidentDocumentContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDocumentRequest;

class ResidentDocumentController extends Controller
{
    protected ResidentDocumentContract $documentContract;

    public function __construct(ResidentDocumentContract $documentContract)
    {
      $this->documentContract = $documentContract;
    }
    public function index(){
      return view('resident._document.index', compact('documentData'));
    }
    public function history()
    {
      $documentData = $this->documentContract->getData();
      return view('penduduk._document.index', compact('documentData'));
    }
  
    public function requestDocument(StoreDocumentRequest $request) // Use validated request
    {
      $validatedData = $request->validated(); // Access validated data directly
  
      $this->documentContract->requestDocument($validatedData);
  
      return redirect()->route('penduduk._document.index')->with('success', 'Pengajuan berhasil disimpan!');
    }
}
