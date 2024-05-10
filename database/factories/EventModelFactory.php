<?php

namespace Database\Factories;

use App\Models\EventModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventModel>
 */
class EventModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = EventModel::class;

    public function definition(): array
    {
        return [
            'id_admin' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'url_gambar' => $this->faker->imageUrl(),
            'judul' => $this->faker->sentence,
            'isi' => $this->faker->paragraph,
            'tanggal' => $this->faker->date(),
        ];
    }
}
