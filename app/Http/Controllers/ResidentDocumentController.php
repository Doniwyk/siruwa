<?php

namespace App\Http\Controllers;

use App\Contracts\ResidentDocumentContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDocumentRequest;
use App\Models\AccountModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\Auth;

class ResidentDocumentController extends Controller
{
  protected ResidentDocumentContract $documentContract;

  public function __construct(ResidentDocumentContract $documentContract)
  {
    $this->documentContract = $documentContract;
  }
  public function index(Request $request)
  {
    try {
      $userId = Auth::id();
      $account = AccountModel::findOrFail($userId);
      $detailAccount = UserModel::findOrFail($account->id_penduduk);
      $resident = UserModel::findOrFail($account->id_penduduk);
      $documentData = $this->documentContract->getData();
      $typeDocument = $request->query('typeDocument', 'pengajuan');
      return view('resident._requestDocument.index', compact('resident', 'documentData', 'detailAccount', 'typeDocument'));
    } catch (\Exception $e) {
    }
  }

  public function requestDocument(StoreDocumentRequest $request) // Use validated request
  {
    $validatedData = $request->validated(); // Access validated data directly

    try {
      $this->documentContract->requestDocument($validatedData);
      return redirect()->route('resident.data-dokumen.index', ['typeDocument' => 'riwayat'])->with('success', 'Pengajuan berhasil disimpan!');
    } catch (\Exception $e) {
      return redirect()->route('resident.data-dokumen.index')->with('error', 'Terjadi kesalahan saat menyimpan pengajuan.');
    }
  }
}
