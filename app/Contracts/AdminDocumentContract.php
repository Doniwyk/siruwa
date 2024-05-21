<?php

namespace App\Contracts;

use App\Models\DocumentModel;

interface AdminDocumentContract
{
    public function validateDocument(array $validatedData, string $action, DocumentModel $dokumen);

    public function getDocumentRequest();
    public function getDocumentOngoing();

    public function getDocumentCanBeTaken();

    public function getValidateHistory();

    public function changeStatus(array $validatedData, DocumentModel $dokumen);
}
