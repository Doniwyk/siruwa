<?php

namespace App\Http\Controllers;

use App\Contracts\ResidentDocumentContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDocumentRequest;
use App\Models\UserModel;
use Illuminate\Support\Facades\Auth;

class ResidentDocumentController extends Controller
{
  protected ResidentDocumentContract $documentContract;

  public function __construct(ResidentDocumentContract $documentContract)
  {
    $this->documentContract = $documentContract;
  }
  public function index()
  {
    try {
      $userId = Auth::id();
      $detailAccount = UserModel::findOrFail($userId);
      $title = 'Pengajuan Dokumen';
      $resident = UserModel::findOrFail(Auth::id());
      $documentData = $this->documentContract->getData();
      return view('resident._requestDocument.index', compact('title', 'resident', 'documentData', 'detailAccount'));
    } catch (\Exception $e) {
    }
  }

  public function requestDocument(StoreDocumentRequest $request) // Use validated request
  {
    $validatedData = $request->validated(); // Access validated data directly

    try {
      $this->documentContract->requestDocument($validatedData);
      return redirect()->route('resident.data-dokumen.index')->with('success', 'Pengajuan berhasil disimpan!');
    } catch (\Exception $e) {
      return redirect()->route('resident.data-dokumen.index')->with('error', 'Terjadi kesalahan saat menyimpan pengajuan.');
    }
  }
}
