<?php

namespace App\Contracts;

use App\Models\DataDashboardModel;
use App\Models\OrStructureModel;
use Illuminate\Http\Request;

interface DashboardContract
{


    public function updateDashboardData(Request $request, DataDashboardModel $dataDashboard): void;

    public function dataDashboard();
}


