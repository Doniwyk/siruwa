<?php

namespace App\Services;

use App\Contracts\AdminResidentImportContract;
use App\Http\Requests\ImportResidentRequest;
use App\Models\UserModel;

    class AdminImportService implements AdminResidentImportContract
    {
        public function importResident(ImportResidentRequest $request){
            $file = $request->file('file');
            $fileContents = file($file->getPathname());
            $errors = [];
        
            foreach ($fileContents as $line) {
                $data = str_getcsv($line);
        
                // Pastikan data memiliki jumlah kolom yang sesuai
                if (count($data) !== 32) {
                    $errors[] = 'Data pada baris ini tidak lengkap.';
                    continue;
                }
        
                // Cek apakah NIK sudah ada di database
                $existingUser = UserModel::where('nik', $data[3])->first();
                if ($existingUser) {
                    $errors[] = 'NIK ' . $data[3] . ' sudah ada di dalam database.';
                    continue;
                }
        
                // Buat data baru jika tidak ada NIK yang sama
                UserModel::create([
                    'urlProfile' => $data[0],
                    'no_reg' => $data[1],
                    'tgl_lahir' => $data[2],
                    'nik' => $data[3],
                    'nomor_kk' => $data[4],
                    'nama' => $data[5],
                    'tempat_lahir' => $data[6],
                    'nickname' => $data[7],
                    'noHp' => $data[8],
                    'jenis_kelamin' => $data[9],
                    'rt' => $data[10],
                    'umur' => $data[11],
                    'status_kawin' => $data[12],
                    'status_keluarga' => $data[13],
                    'agama' => $data[14],
                    'alamat' => $data[15],
                    'pendidikan' => $data[16],
                    'pekerjaan' => $data[17],
                    'gaji' => $data[18],
                    'pajak_bumi' => $data[19],
                    'biaya_listrik' => $data[20],
                    'biaya_air' => $data[21],
                    'jumlah_kendaraan_bermotor' => $data[22],
                    'akseptor_kb' => $data[23],
                    'jenis_akseptor' => $data[24],
                    'aktif_posyandu' => $data[25],
                    'has_BKB' => $data[26],
                    'has_tabungan' => $data[27],
                    'ikut_kel_belajar' => $data[28],
                    'jenis_kel_belajar' => $data[29],
                    'ikut_paud' => $data[30],
                    'ikut_koperasi' => $data[31],
                ]);
            }
        
            if (!empty($errors)) {
                return redirect()->back()->withErrors($errors);
            }
        
            return redirect()->back()->with('success', 'CSV file imported successfully.');
        }
    }

