<?php

namespace Database\Factories;

use App\Models\DocumentModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DocumentModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = DocumentModel::class;

    public function definition(): array
    {
        return [
            'id_penduduk' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'jenis' => $this->faker->randomElement(['SKTM','SPU','Surat Pengadaan Tanah']),
            'status' => $this->faker->randomElement(['Bisa Amnbil', 'Proses Verivikasi', 'Ditolak']),
            'keterangan_status' => $this->faker->sentence,
            'keperluan' => $this->faker->sentence,
            'alasan_ditolak' => $this->faker->sentence,
        ];
    }
}
