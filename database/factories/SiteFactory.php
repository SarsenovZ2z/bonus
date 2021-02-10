<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Site;

class SiteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Site::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'is_active' => $this->faker->boolean,
            'name' => $this->faker->company,
            'url' => $this->faker->url,
            'password' => \Hash::make('password'),
            'key' => function(array $attributes) {
                return \Str::slug($attributes['name'], '_');
            }
        ];
    }
}
