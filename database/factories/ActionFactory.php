<?php

namespace Database\Factories;

use App\Models\Action;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Site;

class ActionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Action::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'transaction_id' => Transaction::factory(),
            'action' => $this->faker->randomElement(array_keys(Action::getActionOptions())),
            'reason' => $this->faker->optional()->realText(50),
            'responsible_type' => $this->faker->randomElement([User::class, Site::class]),
            'responsible_id' => function(array $attributes) {
                return $attributes['responsible_type'] ? $attributes['responsible_type']::factory() : null;
            },
        ];
    }
}
