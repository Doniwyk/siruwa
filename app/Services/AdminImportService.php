<?php

namespace App\Services;

use App\Models\AccountModel;
use App\Models\DeathFundModel;
use App\Models\GarbageFundModel;
use App\Models\UserModel; // Import the UserModel class
use Carbon\Carbon;
use Error;
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

        $errors = [];
        $errorCsv = [];
        $statusCsv = 'success';

        foreach ($csv as $data) {
            $rowValidator = Validator::make($data, [
                'tgl_lahir' => 'required',
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
                'total_pajak_kendaraan' => 'required|numeric',
                'jumlah_tanggungan' => 'required|numeric',
                'akseptor_kb' => 'required|boolean',
                'jenis_akseptor' => 'nullable|string',
                'aktif_posyandu' => 'required|boolean',
                'has_BKB' => 'required|boolean',
                'has_tabungan' => 'required|boolean',
                'ikut_kel_belajar' => 'required|boolean',
                'jenis_kel_belajar' => 'nullable|string',
                'ikut_paud' => 'required|boolean',
                'ikut_koperasi' => 'required|boolean',
                'noHp' => 'required',
                'email' => 'required|unique:users,email',
            ], [
                'tgl_lahir.required' => '<span class="font-medium text-red-600">Tanggal lahir wajib diisi.</span><br>',
                'nik.required' => '<span class="font-medium text-red-600">NIK wajib diisi.</span><br>',
                'nik.numeric' => '<span class="font-medium text-red-600">NIK harus berupa angka.</span><br>',
                'nik.digits' => '<span class="font-medium text-red-600">NIK harus berjumlah 16 karakter.</span><br>',
                'nomor_kk.required' => '<span class="font-medium text-red-600">No KK wajib diisi',
                'nomor_kk.numeric' => '<span class="font-medium text-red-600">No KK harus berupa angka.</span><br>',
                'nomor_kk.digits' => '<span class="font-medium text-red-600">No KK harus berjumlah 16 karakter.</span><br>',
                'nik.digits' => '<span class="font-medium text-red-600">NIK harus berjumlah 16 karakter.</span><br>',
                'nama.required' => '<span class="font-medium text-red-600">Nama wajib diisi.</span><br>',
                'tempat_lahir.required' => '<span class="font-medium text-red-600">Tempat lahir wajib diisi.</span><br>',
                'jenis_kelamin.required' => '<span class="font-medium text-red-600">Jenis kelamin wajib diisi.</span><br>',
                'rt.required' => '<span class="font-medium text-red-600">RT wajib diisi.</span><br>',
                'status_kawin.required' => '<span class="font-medium text-red-600">Status kawin wajib diisi.</span><br>',
                'status_keluarga.required' => '<span class="font-medium text-red-600">Status keluarga wajib diisi.</span><br>',
                'agama.required' => '<span class="font-medium text-red-600">Agama wajib diisi.</span><br>',
                'alamat.required' => '<span class="font-medium text-red-600">Alamat wajib diisi.</span><br>',
                'pendidikan.required' => '<span class="font-medium text-red-600">Pendidikan wajib diisi.</span><br>',
                'pekerjaan.required' => '<span class="font-medium text-red-600">Pekerjaan wajib diisi.</span><br>',
                'akseptor_kb.required' => '<span class="font-medium text-red-600">Akseptor KB wajib diisi.</span><br>',
                'aktif_posyandu.required' => '<span class="font-medium text-red-600">Aktif posyandu wajib diisi.</span><br>',
                'has_BKB.required' => '<span class="font-medium text-red-600">Memiliki BKB wajib diisi.</span><br>',
                'has_tabungan.required' => '<span class="font-medium text-red-600">Memiliki Tabungan wajib diisi.</span><br>',
                'ikut_kel_belajar.required' => '<span class="font-medium text-red-600">Ikut Kelas Belajar wajib diisi.</span><br>',
                'ikut_paud.required' => '<span class="font-medium text-red-600">Ikut PAUD wajib diisi.</span><br>',
                'ikut_koperasi.required' => '<span class="font-medium text-red-600">Ikut Koperasi wajib diisi.</span><br>',
                'biaya_listrik.required' => '<span class="font-medium text-red-600">Biaya listrik wajib diisi.</span><br>',
                'biaya_air.required' => '<span class="font-medium text-red-600">Biaya listrik wajib diisi.</span><br>',
                'pajak_bumi.required' => '<span class="font-medium text-red-600">Pajak bumi wajib diisi.</span><br>',
                'gaji.required' => '<span class="font-medium text-red-600">Gaji wajib diisi</span><br>',
                'jumlah_tanggungan.required' => '<span class="font-medium text-red-600">Jumlah tanggungan wajib diisi</span><br>',
                'total_pajak_kendaraan.required' => '<span class="font-medium text-red-600">Total pajak kendaraan wajib diisi</span><br>',
            ]);
            if ($rowValidator->fails()) {
                Log::error('Error validating data: ' . json_encode($rowValidator->errors()));
                $errors[] = 'Data penduduk ' . ($data['nama']) . ' tidak lengkap atau invalid ';
                foreach ($rowValidator->errors()->getMessages() as $key => $messages) {
                    $data[$key] = implode('', $messages);
                }
                // continue;
            }
            array_push($errorCsv, $data);
            }
            
            if (count($errors) > 0) {
            $statusCsv = 'error';
            return [$statusCsv, $errorCsv];
        }

        return [$statusCsv,$csv];
    }

    public function saveImportedResidents()
    {
        Log::info('Started saveImportedResidents method.');

        $dataPreview = Session::get('dataPreview', []);

        if (empty($dataPreview)) {
            return $dataPreview;
        }

        foreach ($dataPreview as $data) {
            // Custom validation for each row
            $rowValidator = Validator::make($data, [
                'tgl_lahir' => 'required',
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
                'total_pajak_kendaraan' => 'required|numeric',
                'jumlah_tanggungan' => 'required|numeric',
                'akseptor_kb' => 'required|boolean',
                'jenis_akseptor' => 'nullable|string',
                'aktif_posyandu' => 'required|boolean',
                'has_BKB' => 'required|boolean',
                'has_tabungan' => 'required|boolean',
                'ikut_kel_belajar' => 'required|boolean',
                'jenis_kel_belajar' => 'nullable|string',
                'ikut_paud' => 'required|boolean',
                'ikut_koperasi' => 'required|boolean',
                'noHp' => 'required',
                'email' => 'required|unique:users,email',
            ]);

            if ($rowValidator->fails()) {
                Log::error('Error validating data: ' . json_encode($rowValidator->errors()));
                continue;
            }
            try {
                $create = UserModel::create([
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
                    'total_pajak_kendaraan' => $data['total_pajak_kendaraan'],
                    'jumlah_tanggungan' => $data['jumlah_tanggungan'],
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

                $account = [
                    'id_penduduk' => $create->id_penduduk,
                    'noHp' => $data['noHp'],
                    'username' => $data['nik'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['nik']),
                    'role' => 'resident'
                ];
                AccountModel::create($account);

                $existingDeathFund = DeathFundModel::where('nomor_kk', $create['nomor_kk'])->exists();
                // dd($existingDeathFund);
                if (!$existingDeathFund) {
                    $currentMonth = now()->month;
                    $currentYear = now()->year;

                    for ($month = $currentMonth; $month <= 12; $month++) {
                        $death_fund = [
                            'nomor_kk' => $data['nomor_kk'],
                            'bulan' => Carbon::create($currentYear, $month, 1)->format('Y-m-d'),
                            'status' => 'Belum Lunas'
                        ];

                        DeathFundModel::create($death_fund);
                    }
                }
                $existingGarbageFund = GarbageFundModel::where('nomor_kk', $create['nomor_kk'])->exists();
                // dd($existingDeathFund);
                if (!$existingGarbageFund) {
                    $currentMonth = now()->month;
                    $currentYear = now()->year;

                    for ($month = $currentMonth; $month <= 12; $month++) {
                        $garbage_fund = [
                            'nomor_kk' => $data['nomor_kk'],
                            'bulan' => Carbon::create($currentYear, $month, 1)->format('Y-m-d'),
                            'status' => 'Belum Lunas'
                        ];

                        GarbageFundModel::create($garbage_fund);
                    }
                }
                Log::info('Berhasil.');
            } catch (\Exception $e) {
                dd($e);
                Log::error("Error saving data: " . $e->getMessage());
            }
        }

        // Clear session after saving
        Session::forget('dataPreview');
        Session::forget('importErrors');
        Log::info('Data saved successfully, session cleared.');
    }
}
