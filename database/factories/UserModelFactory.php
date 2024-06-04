<?php

namespace Database\Factories;

use App\Models\UserModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserModel>
 */
class UserModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = UserModel::class;
    private static $nikCounter = 3579011402040001;
    private static $nomor_kk = 3507010201082551;
    
    
    public function definition()
    {
        $faker = Faker::create('id_ID');
        $nik = self::$nikCounter++;
        $nomor_kk = self::$nomor_kk;
        return [
            'tgl_lahir' => $this->faker->date(),
            'nik' => str_pad($nik, 16, '0', STR_PAD_LEFT),
            'nomor_kk'=> $this->faker->regexify('[0-9]{16}'),
            'nama' => $faker->name,
            'tempat_lahir' => $this->faker->randomElement(['Batu', 'Malang']),
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'rt' => fake()->numberBetween(1, 10),
            'status_kawin' => fake()->randomElement(['Belum Menikah', 'Menikah', 'Cerai Hidup', 'Cerai Mati']),
            'status_keluarga' => fake()->randomElement(['Kepala Keluarga', 'Istri', 'Anak']),
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', 'Kepercayaan Lain']),
            'alamat' => 'Desa Sumberejo, Kecamatan Batu, Kota Batu, Jawa Timur',
            'pendidikan' => fake()->randomElement(['SD', 'SMP', 'SMA', 'Diploma', 'Sarjana']),
            'pekerjaan' => fake()->randomElement(['PNS', 'TNI/Polri', 'Wirausaha', 'Wiraswasta', 'Pelajar/Mahasiswa', 'Tidak Bekerja']),
            'akseptor_kb' => $this->faker->boolean,
            'jenis_akseptor' => $this->faker->randomElement(['IUD', 'Pil', 'Suntik']),
            'aktif_posyandu' => $this->faker->boolean,
            'has_BKB' => $this->faker->boolean,
            'has_tabungan' => $this->faker->boolean,
            'ikut_kel_belajar' => $this->faker->boolean,
            'jenis_kel_belajar' => $this->faker->randomElement(['Sekolah Dasar', 'Sekolah Menengah', 'Perguruan Tinggi']),
            'ikut_paud' => $this->faker->boolean,
            'ikut_koperasi' => $this->faker->boolean,
            'gaji' => $this->faker->randomFloat(2, 10000000, 100000000),
            'pajak_bumi' => $this->faker->randomFloat(2, 100000, 500000),
            'biaya_listrik' => $this->faker->randomFloat(2, 50000, 200000),
            'biaya_air' => $this->faker->randomFloat(2, 50000, 100000),
            'total_pajak_kendaraan' => $this->faker->randomFloat(2, 100000, 500000),
            'jumlah_tanggungan' =>0,

        ];
    }

    public function kepalaKeluarga($religion)
    {
        return $this->state(function (array $attributes) use ($religion) {
            $faker = Faker::create('id_ID');
            return [
                'nama' =>$faker->name('male'),
                'tgl_lahir' => $this->faker->date('Y-m-d', '-40 years'),
                'jenis_kelamin' => 'Laki-laki',
                'status_keluarga' => 'Kepala Keluarga',
                'status_kawin' => 'Menikah',
                'agama' => $religion,
                'jumlah_tanggungan' => 3,
                'akseptor_kb' => 0,
                'jenis_akseptor' => null,
                'aktif_posyandu' => 0,
                'has_BKB' => 0,
                'has_tabungan' => $this->faker->randomElement([0, 1]),
                'ikut_kel_belajar' => 0,
                'jenis_kel_belajar' => 0,
                'ikut_paud' => 0,
                'ikut_koperasi' => 0,

            ];
        });
    }

    public function wife($nomorKk, $religion, $rt, $address)
    {
        return $this->state(function (array $attributes) use ($nomorKk,$religion, $rt, $address) {
            $faker = Faker::create('id_ID');
            return [
                'nomor_kk' => $nomorKk,
                'nama' => $faker->name('female'),
                'tgl_lahir' => $this->faker->date('Y-m-d', '-35 years'),
                'status_keluarga' => 'Istri',
                'status_kawin' => 'Menikah',
                'agama' => $religion,
                'alamat' => $address,
                'rt' => $rt,
                'jenis_kelamin' => 'Perempuan',
                'gaji' => 0,
                'pajak_bumi' => 0,
                'biaya_listrik' => 0,
                'biaya_air' => 0,
                'total_pajak_kendaraan' => 0,
                'jumlah_tanggungan' =>0 ,
            ];
        });
    }

    public function child($nomorKk, $religion, $rt, $address)
    {
        return $this->state(function (array $attributes) use ($nomorKk, $religion, $rt, $address) {
            $faker = Faker::create('id_ID');
            $genderOptions = ['Laki-laki', 'Perempuan'];
            $gender= $genderOptions[array_rand($genderOptions)];
            return [
                'nomor_kk' => $nomorKk,
                'tgl_lahir' => $this->faker->date('Y-m-d', '-15 years'),
                'nama' => $gender=='Perempuan'? $faker->name('female'): $faker->name('male'),
                'status_keluarga' => 'anak',
                'status_kawin' => 'Belum Menikah',
                'agama' => $religion,
                'alamat' => $address,
                'rt' => $rt,
                'gaji' => 0,
                'pajak_bumi' => 0,
                'biaya_listrik' => 0,
                'biaya_air' => 0,
                'total_pajak_kendaraan' => 0,
                'jumlah_tanggungan' => 0,
                'akseptor_kb' => 0,
                'jenis_akseptor' => null,
                'aktif_posyandu' => 0,
                'has_BKB' => 0,
                'has_tabungan' => $this->faker->randomElement([1, 2]),
                'ikut_kel_belajar' => 0,
                'jenis_kel_belajar' => 0,
                'ikut_paud' => 0,
                'ikut_koperasi' => 0,
            ];
        });
    }
    public function workingWife($nomorKk, $religion, $rt, $address)
    {
        return $this->state(function (array $attributes) use ($nomorKk, $religion, $rt, $address) {
            return [
                'nomor_kk' => $nomorKk,
                'tgl_lahir' => $this->faker->date('Y-m-d', '-35 years'),
                'status_keluarga' => 'Istri',
                'status_kawin' => 'Menikah',
                'agama' => $religion,
                'alamat' => $address,
                'rt' => $rt,
                'jenis_kelamin' => 'Perempuan',
                'pajak_bumi' => 0,
                'biaya_listrik' => 0,
                'biaya_air' => 0,
                'total_pajak_kendaraan' => 0,
                'jumlah_tanggungan' => 0,
            ];
        });
    }
    
}
