<?php

namespace App\Services;

use App\Models\Dokumen;
use App\Models\UserModel;
use App\Contracts\DocumentContract;

class DocumentService implements DocumentContract
{

    public function storeDocument(array $validatedData): void
    {
        $Dokumen = Dokumen::create($validatedData);

        $user = UserModel::findOrFail($validatedData['id_penduduk']);
        $Dokumen->user()->associate($user);
        $Dokumen->save();
    }

    public function editDocument(array $validatedData, Dokumen $dokumen): void
    {
        $dokumen->update($validatedData);

        $user = UserModel::findOrFail($validatedData['id_penduduk']);
        $dokumen->user()->associate($user);
        $dokumen->save();
    }

    public function deleteDocument(Dokumen $dokumen): void
    {
        $dokumen->user()->dissociate();
        $dokumen->delete();
    }

    public function getUser()
    {
        return UserModel::orderBy('nama', 'asc')->get()->pluck('nama', 'id_penduduk');
    }
}
