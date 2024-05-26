<?php

namespace App\Services;

use App\Contracts\DashboardContract;
use App\Models\OrStructureModel;

class DoshboardService implements DashboardContract
{
    public function storeOrganizationStructure(array $validatedData): void
    {
        OrStructureModel::create($validatedData);
    }
    public function updateOrganizationStructure(array $validatedData, OrStructureModel $orStructure) :void
    {
        $orStructure->update($validatedData);
    }
    public function deleteOrganizationStructure(OrStructureModel $orStructure): void
    {
        $orStructure->delete();
    }


    
}
