<?php

namespace App\Contracts;

use App\Models\OrStructureModel;

interface DashboardContract
{

    public function storeOrganizationStructure(array $validatedData): void;

    public function updateOrganizationStructure(array $validatedData, OrStructureModel $orStructure): void;

    public function deleteOrganizationStructure(OrStructureModel $orStructure): void;

}
