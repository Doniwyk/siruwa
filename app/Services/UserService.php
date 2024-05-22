<?php

namespace App\Services;

use App\Contracts\PendudukContract;
use App\Contracts\UserContract;
use App\Models\PendudukModel;
use App\Models\TempResidentModel;
use App\Models\UserModel;
use Illuminate\Http\Request;

class UserService implements UserContract
{

    public function storeUser(array $validatedData):UserModel
    {
        return UserModel::create($validatedData);
    }

    public function updateUser(array $validatedData, UserModel $penduduk):void
    {
        $penduduk->update($validatedData);
    }

    public function deleteUser(UserModel $penduduk):void
    {
        $penduduk->delete();
    }

    public function validateEditRequest(Request $request, UserModel $resident)
    {
        $tempResident = TempResidentModel::where('nik', $resident->nik)->first();
        if ($request->action === 'accept') {
            $resident->update((array) $tempResident);
            $tempResident->status = 'Diterima';
            $tempResident->save();
        }

        if ($request->action === 'reject') {
            $tempResident->status = 'Ditolak';
            $tempResident->save();
        }
    }
    
    public function editRequest(Request $request , UserModel $resident)
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
        $residents = UserModel::when($search, function ($query) use ($search) {
            return $query->where('nama', 'like', $search . '%');
        })->orderBy('nama', $order)
            ->paginate(15);
        return $residents;
    }

    public function getFilteredRequestResidentData($search, $order)
    {
        $residents = TempResidentModel::when($search, function ($query) use ($search) {
            $query->where('nama', 'like', $search . '%');
        })
            ->where('status', 'Menunggu Verifikasi')
            ->orderBy('nama', $order)
            ->paginate(15);
        return $residents;
    }

    public function getFilteredHistoryResidentData($search, $order)
    {
        $residents = TempResidentModel::when($search, function ($query) use ($search) {
            $query->where('nama', 'like', $search . '%');
        })
            ->where('status', '!=', 'Menunggu Verifikasi')
            ->orderBy('nama', $order)
            ->paginate(15);

        return $residents;
    }

    
}