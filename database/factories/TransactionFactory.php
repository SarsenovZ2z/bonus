<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Transaction;
use App\Models\Order;
use App\Models\Wallet;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status' => $this->faker->randomElement(array_keys(Transaction::getStatusOptions())),
            'order_id' => Order::factory(),
            'wallet_id' => Wallet::factory(),
            'amount' => function(array $attributes) {
                if (!$attributes['order_id']) {
                    return $this->faker->numberBetween(500, 2000);
                }
                $order = Order::find($attributes['order_id']);

                return $order->used != 0 ? -$order->used : $order->total * $order->cashback / 100;
            }
        ];
    }
}
