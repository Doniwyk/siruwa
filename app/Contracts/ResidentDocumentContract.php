<?php

namespace App\Contracts;

interface ResidentDocumentContract
{
    public function requestDocument(array $validatedData);

    public function getData();
}
