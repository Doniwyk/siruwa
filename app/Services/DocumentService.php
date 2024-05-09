<?php

namespace App\Services;

use App\Models\Dokumen;
use App\Models\UserModel;
use App\Contracts\DocumentContract;
use App\Models\DocumentModel;

class DocumentService implements DocumentContract
{

    public function storeDocument(array $validatedData): void
    {
        $Dokumen = DocumentModel::create($validatedData);

        $user = UserModel::findOrFail($validatedData['id_penduduk']);
        $Dokumen->user()->associate($user);
        $Dokumen->save();
    }

    public function editDocument(array $validatedData, DocumentModel $dokumen): void
    {
        $dokumen->update($validatedData);

        $user = UserModel::findOrFail($validatedData['id_penduduk']);
        $dokumen->user()->associate($user);
        $dokumen->save();
    }

    public function deleteDocument(DocumentModel $dokumen): void
    {
        $dokumen->user()->dissociate();
        $dokumen->delete();
    }

    public function getUser()
    {
        return UserModel::orderBy('nama', 'asc')->get()->pluck('nama', 'id_penduduk');
    }
}
