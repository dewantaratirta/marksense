<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Wallet;

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
     */
    public function definition(): array
    {
        $ethereum = '0x' . Str::random(40);
        return [
            'wallet_address' => $ethereum,
            'wallet_name' => $this->faker->name(),
            'wallet_username' => $this->faker->userName(),
        ];
    }
}
