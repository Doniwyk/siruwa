<?php

namespace App\Services;

use App\Contracts\UserContract;
use App\Models\TempResidentModel;
use App\Models\UserModel;
use Illuminate\Http\Request;

class UserService implements UserContract
{

    public function storeUser(array $validatedData): UserModel
    {
        $user = UserModel::create($validatedData);
        return $user;
    }

    public function updateUser(array $validatedData, UserModel $penduduk): void
    {
        $penduduk->update($validatedData);
    }

    public function deleteUser(UserModel $penduduk): void
    {
        $penduduk->status_penduduk=0;
        $penduduk->save();
    }

    public function validateEditRequest(string $action, $id, $keterangan_status = '')
    {
        $tempResident = TempResidentModel::where('id_temporary', $id)->first();

        $resident = UserModel::where('id_penduduk', $tempResident->id_penduduk)->first();
        if ($action === 'accept') {
            $resident->update($tempResident->toArray());
            $tempResident->status = 'Diterima';
            $tempResident->keterangan_status = $keterangan_status;
            $tempResident->save();
        }
        if ($action === 'reject') {
            $tempResident->status = 'Ditolak';
            $tempResident->keterangan_status = $keterangan_status;
            $tempResident->save();
        }
    }

    public function editRequest(Request $request, UserModel $resident)
    {
        $existingRequest = TempResidentModel::where('id_penduduk', $resident->id_penduduk)
            ->where('status', 'Menunggu Verifikasi')
            ->exists();
        if ($existingRequest) {
            return false;
        } else {
            $resident = UserModel::find($resident->id_penduduk);
            $mergeResident = array_merge($resident->toArray(), $request->toArray());
            TempResidentModel::create($mergeResident);
            return true;
        }
    }

    public function getFilteredResidentData($search, $order)
    {
        $residents = UserModel::where('status_penduduk', 1)
        ->when($search, function ($query) use ($search) {
            return $query->where('nama', 'like', $search . '%');
        })->orderBy('nama', $order)
            ->paginate(15);
        return $residents;
    }

    public function getFilteredRequestResidentData($search, $order)
    {
        $residents = TempResidentModel::with('penduduk')
            ->when($search, function ($query) use ($search) {
                $query->whereHas('penduduk', function ($query) use ($search) {
                    $query->where('nama', 'like', $search . '%');
                });
            })
            ->where('status', 'Menunggu Verifikasi')
            ->orderBy('nama', $order)
            ->paginate(15);

        return $residents;
    }

    public function getFilteredHistoryResidentData($search, $order)
    {
        $residents = TempResidentModel::with('penduduk')
            ->when($search, function ($query) use ($search) {
                $query->whereHas('penduduk', function ($query) use ($search) {
                    $query->where('nama', 'like', $search . '%');
                });
            })
            ->where('status', '!=', 'Menunggu Verifikasi')
            ->orderBy('nama', $order)
            ->paginate(15);

        return $residents;
    }
}
