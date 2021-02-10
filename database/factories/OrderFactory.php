<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'total' => $this->faker->numberBetween(1000, 20000),
            'cashback' => $this->faker->randomElement([0, 3, 5, 7, 10]),
            'used' => function(array $attributes) {
                if ($attributes['cashback'] > 0) {
                    return 0;
                }
                return $this->faker->numberBetween(500, $attributes['total']);
            },
        ];
    }
}
