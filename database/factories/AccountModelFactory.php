<?php

namespace Database\Factories;


use App\Models\AccountModel;
use App\Models\UserModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AccountModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = AccountModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $resident =UserModel::factory()->create();
        return [
            'id_penduduk' => $resident->id_penduduk,
            'urlProfile' => fake()->imageUrl(),
            'noHp' => fake()->phoneNumber(),
            'username' => $resident->nik,
            'email' => fake()->unique()->email(),
            'email_verified_at' => now(),
            'password' => bcrypt('asdfasdf'),
            'role' => $this->faker->randomElement(['admin', 'resident']),
            'image_public_id' => $this->faker->randomElement(['1', '2', '3', '4', '5']),
            'remember_token' => Str::random(10),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (AccountModel $account) {
            if ($account->id <= 5) {
                $account->role = 'admin';
            } else {
                $account->role = 'resident';
            }
            $account->save();
        });
    }
}
