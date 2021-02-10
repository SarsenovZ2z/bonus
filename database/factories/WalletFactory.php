<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Wallet;
use App\Models\Site;
use App\Models\Client;

class WalletFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Wallet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'is_active' => $this->faker->boolean,
            'site_id' => Site::factory(),
            'client_id' => Client::factory(),
            'frozen' => $this->faker->randomFloat(null, 0, 5000),
            'available' => $this->faker->randomFloat(null, 0, 10000),
        ];
    }
}
