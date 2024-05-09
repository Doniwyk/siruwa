<?php

namespace App\Contracts;

use App\Models\DocumentModel;
use App\Models\Dokumen;

interface DocumentContract
{

    public function storeDocument(array $validatedData): void;

    public function editDocument(array $validatedData, DocumentModel $dokumen): void;

    public function deleteDocument(DocumentModel $dokumen): void;

    public function getUser();
}
