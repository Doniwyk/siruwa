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

    public function getCanBeTakenDocument();

    public function getProcessedDocument();

    public function changeStatus(array $validatedData, DocumentModel $dokumen, string $action);

    public function changeIntoSelesai(DocumentModel $dokumen);
}
