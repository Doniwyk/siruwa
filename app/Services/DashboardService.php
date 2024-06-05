<?php

namespace App\Services;

use App\Contracts\DashboardContract;
use App\Models\DataDashboardModel;
use App\Models\OrStructureModel;
use CloudinaryLabs\CloudinaryLaravel\CloudinaryEngine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardService implements DashboardContract
{
    private $cloudinary;
    public function __construct()
    {
        $this->cloudinary = new CloudinaryEngine();
    }

    public function storeOrganizationStructure(array $validatedData): void
    {
        OrStructureModel::create($validatedData);
    }

    public function updateDashboardData(Request $validatedData, DataDashboardModel $orStructure)
    {
        if (!array_key_exists('image', $validatedData->toArray())) {
            $orStructure->total_penduduk = $validatedData['total_penduduk'];
            $orStructure->fasilitas_kesehatan = $validatedData['fasilitas_kesehatan'];
            $orStructure->fasilitas_administrasi = $validatedData['fasilitas_administrasi'];
            $orStructure->fasilitas_pendidikan = $validatedData['fasilitas_pendidikan'];
            dd($orStructure->fasilitas_pendidikan,$orStructure);
            $orStructure->save();
            return;
        }

        $publicId = $orStructure->image_public_id;

        if ($this->cloudinary->getUrl($publicId) == "") {
            $cloudinaryImage = $validatedData['image']->storeOnCloudinary('dashboard');
            $url = $cloudinaryImage->getSecurePath();
            $publicId = $cloudinaryImage->getPublicId();

            
            $orStructure->image = $url;
            $orStructure->image_public_id = $publicId;
            
            dd($orStructure->image,$orStructure->image_public_id,$orStructure);
            $orStructure->save();
            return;
        }

        // Hapus gambar terlabih dahulu
        $result = $this->cloudinary->destroy($publicId);

        // Upload Kembali
        $cloudinaryImage = $validatedData['image']->storeOnCloudinary('dashboard');
        $url = $cloudinaryImage->getSecurePath();
        $publicId = $cloudinaryImage->getPublicId();

        // Update data
        $orStructure->image = $url;
        $orStructure->image_public_id = $publicId;

        $orStructure->save();
    }

    public function dataDashboard()
    {
        $resident = DB::table('penduduk')->count();
        $data = DB::table('data_dashboard')->get();
        return [
            'resident' => $resident,
            'data' => $data
        ];
    }
}
