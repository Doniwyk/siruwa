<?php

namespace App\Contracts;

use App\Models\Dokumen;

interface DocumentContract
{

    public function storeDocument(array $validatedData): void;

    public function editDocument(array $validatedData, Dokumen $dokumen): void;

    public function deleteDocument(Dokumen $dokumen): void;

    public function getUser();
}
