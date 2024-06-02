<?php

namespace App\Services;

use App\Models\UserModel; // Import the UserModel class
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class AdminImportService
{
    public function importResident($file)
    {
        Log::info('Started importResident method.');

        $fileContents = file($file->getPathname());

        // Parse the CSV file
        $csv = array_map('str_getcsv', file($file));
        array_walk($csv, function (&$a) use ($csv) {
            $a = array_combine($csv[0], $a);
        });
        array_shift($csv); // Remove the first row (headers)

        Log::info('CSV file parsed successfully.');
        // Save data preview to session
        Session::put('dataPreview', $csv);
        Log::info('Data preview stored in session successfully.');
        return $csv;
    }

    public function saveImportedResidents()
    {
        Log::info('Started saveImportedResidents method.');

        $dataPreview = Session::get('dataPreview', []);

        if (empty($dataPreview)) {
            return;
        }

        foreach ($dataPreview as $data) {
                        // Custom validation for each row
                        $rowValidator = Validator::make($data, [
                            'tgl_lahir' => 'required|date',
                            'nik' => 'required|numeric|digits:16|unique:penduduk,nik',
                            'nomor_kk' => 'required|numeric|digits:16',
                            'nama' => 'required|string',
                            'tempat_lahir' => 'required|string',
                            'jenis_kelamin' => 'required|string',
                            'rt' => 'required|string',
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
                Log::error('Error validating data: ' . json_encode($rowValidator->errors()));
                continue;
            }
            try {
                UserModel::create([
                    'tgl_lahir' => date('Y-m-d', strtotime($data['tgl_lahir'])),
                    'nik' => $data['nik'],
                    'nomor_kk' => $data['nomor_kk'],
                    'nama' => $data['nama'],
                    'tempat_lahir' => $data['tempat_lahir'],
                    'jenis_kelamin' => $data['jenis_kelamin'],
                    'rt' => $data['rt'],
                    'status_kawin' => $data['status_kawin'],
                    'status_keluarga' => $data['status_keluarga'],
                    'agama' => $data['agama'],
                    'alamat' => $data['alamat'],
                    'pendidikan' => $data['pendidikan'],
                    'pekerjaan' => $data['pekerjaan'],
                    'gaji' => $data['gaji'],
                    'pajak_bumi' => $data['pajak_bumi'],
                    'biaya_listrik' => $data['biaya_listrik'],
                    'biaya_air' => $data['biaya_air'],
                    'jumlah_kendaraan_bermotor' => $data['jumlah_kendaraan_bermotor'],
                    'akseptor_kb' => $data['akseptor_kb'],
                    'jenis_akseptor' => $data['jenis_akseptor'],
                    'aktif_posyandu' => $data['aktif_posyandu'],
                    'has_BKB' => $data['has_BKB'],
                    'has_tabungan' => $data['has_tabungan'],
                    'ikut_kel_belajar' => $data['ikut_kel_belajar'],
                    'jenis_kel_belajar' => $data['jenis_kel_belajar'],
                    'ikut_paud' => $data['ikut_paud'],
                    'ikut_koperasi' => $data['ikut_koperasi'],
                
                ]);
                Log::info('Berhasil.');
            } catch (\Exception $e) {
                Log::error("Error saving data: " . $e->getMessage());
            }
        }

        // Clear session after saving
        Session::forget('dataPreview');
        Log::info('Data saved successfully, session cleared.');
    }
}