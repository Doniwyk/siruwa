<?php

namespace App\Services;

use App\Contracts\AdminResidentImportContract;
use App\Http\Requests\ImportResidentRequest;
use App\Models\UserModel;
use Illuminate\Support\Facades\Validator;

    class AdminImportService implements AdminResidentImportContract
    {
        public function importResident(ImportResidentRequest $request)
        {
            $file = $request->file('file');
            $fileContents = file($file->getPathname());
            $errors = [];
            
            // Parse the CSV file
            $csv = array_map('str_getcsv', $fileContents);
            $headers = array_shift($csv); // Remove the first row (headers)
            
            foreach ($csv as $rowIndex => $row) {
                // Combine headers with each row to create an associative array
                $data = array_combine($headers, $row);
    
                // Custom validation for each row
                $rowValidator = Validator::make($data, [
                    'no_reg' => 'required|string',
                    'tgl_lahir' => 'required|date',
                    'nik' => 'required|numeric|digits:16|unique:penduduk,nik',
                    'nomor_kk' => 'required|numeric|digits:16',
                    'nama' => 'required|string',
                    'tempat_lahir' => 'required|string',
                    'jenis_kelamin' => 'required|string',
                    'rt' => 'required|string',
                    'umur' => 'required|numeric',
                    'status_kawin' => 'required|string',
                    'status_keluarga' => 'required|string',
                    'agama' => 'required|string',
                    'alamat' => 'required|string',
                    'pendidikan' => 'required|string',
                    'pekerjaan' => 'required|string',
                    'gaji' => 'required|numeric',
                    'pajak_bumi' => 'required|numeric',
                    'biaya_listrik' => 'required|numeric',
                    'biaya_air' => 'required|numeric',
                    'jumlah_kendaraan_bermotor' => 'required|numeric',
                    'akseptor_kb' => 'required|boolean',
                    'jenis_akseptor' => 'nullable|string',
                    'aktif_posyandu' => 'required|boolean',
                    'has_BKB' => 'required|boolean',
                    'has_tabungan' => 'required|boolean',
                    'ikut_kel_belajar' => 'required|boolean',
                    'jenis_kel_belajar' => 'nullable|string',
                    'ikut_paud' => 'required|boolean',
                    'ikut_koperasi' => 'required|boolean',
                ]);
    
                if ($rowValidator->fails()) {
                    $errors[] = 'Data pada baris ' . ($rowIndex + 2) . ' tidak lengkap atau invalid: ' . implode(', ', $rowValidator->errors()->all());
                    continue;
                }
    
                // Buat data baru jika tidak ada NIK yang sama
                UserModel::create($data);
            }
            
            if (!empty($errors)) {
                return redirect()->back()->withErrors($errors);
            }
            
            return redirect()->back()->with('success', 'CSV file imported successfully.');
        }
    }

