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

    public function updateDashboardData(Request $validatedData, DataDashboardModel $orStructure): void
    {
        if (!array_key_exists('image', $validatedData->toArray())) {
            $orStructure->total_penduduk = $validatedData['total_penduduk'];
            $orStructure->fasilitas_kesehatan = $validatedData['fasilitas_kesehatan'];
            $orStructure->fasilitas_administrasi = $validatedData['fasilitas_administrasi'];
            $orStructure->fasilitas_pendidikan = $validatedData['fasilitas_pendidikan'];
            $orStructure->save();
            return;
        }

        // Hapus gambar terlabih dahulu
        $publicId = $orStructure->image_public_id;
        $result = $this->cloudinary->destroy($publicId);


        // Upload Kembali
        $cloudinaryImage = $validatedData['image']->storeOnCloudinary('dashboard');
        $url = $cloudinaryImage->getSecurePath();
        $publicId = $cloudinaryImage->getPublicId();

        // Update data
        $validatedData['image'] = $url;
        $validatedData['image_public_id'] = $publicId;

        $orStructure->update($validatedData->toArray());
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
