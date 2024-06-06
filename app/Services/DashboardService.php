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
        // dd($orStructure);
        if (!array_key_exists('image', $validatedData->toArray())) {

            $orStructure = DataDashboardModel::find($orStructure->id_dataDashboard);
            $orStructure->fasilitas_kesehatan = $validatedData['fasilitas_kesehatan'];
            $orStructure->fasilitas_administrasi = $validatedData['fasilitas_administrasi'];
            $orStructure->fasilitas_pendidikan = $validatedData['fasilitas_pendidikan'];
            try {
                $orStructure = $orStructure->update([
                    'total_pendudukk' => 2
                ]);
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Tidak dapat memuat data' . $e->getMessage())->withErrors([$e->getMessage()]);
            }

            $orStructure = DataDashboardModel::find($orStructure->id_dataDashboard);
            return;
        }

        $publicId = $orStructure->image_public_id;

        if ($this->cloudinary->getUrl($publicId) == "") {
            $cloudinaryImage = $validatedData['image']->storeOnCloudinary('dashboard');
            $url = $cloudinaryImage->getSecurePath();
            $publicId = $cloudinaryImage->getPublicId();


            $orStructure->image = $url;
            $orStructure->image_public_id = $publicId;

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
        $resident = DB::table('penduduk')
        ->where('status_penduduk', 1)
        ->count();
        $data = DB::table('data_dashboard')->get();
        return [
            'resident' => $resident,
            'data' => $data
        ];
    }
}
