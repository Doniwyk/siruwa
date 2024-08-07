<?php

namespace App\Services;

use App\Contracts\ResidentDocumentContract;
use App\Models\DocumentModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\Auth;

class ResidentDocumentService implements ResidentDocumentContract
{
    public function requestDocument(array $validatedData){
      $user = Auth::user();
      $penduduk = UserModel::find($user->id_penduduk);
      if ($penduduk) {
          $validatedData['id_penduduk'] = $penduduk->id_penduduk;
      } else {
          return redirect()->back()->with('error', 'Penduduk tidak ditemukan.');
      }
      $validatedData['status'] = 'Menunggu Verifikasi';
      DocumentModel::create($validatedData);
    }
    public function getData()
    {
      $user = Auth::user();
      if ($user) {
        $penduduk = UserModel::find($user->id_penduduk); // Find resident based on user's foreign key
        if ($penduduk) {
          $documentData = DocumentModel::where('id_penduduk', $penduduk->id_penduduk)->with('penduduk')->get();
          return [
            'document' => $documentData,
          ];
        } else {
          // Handle case where resident not found
          return [];
        }
      } else {
        // Handle case where user is not authenticated
        return [];
      }
    }
}

