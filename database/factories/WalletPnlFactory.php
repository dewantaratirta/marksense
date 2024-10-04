<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Wallet;
use App\Models\WalletPnl;

class WalletPnlFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WalletPnl::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'wallet_pnl_ulid' => (string) Str::ulid(),
            'wallet_pnl_amount' => $this->faker->randomFloat(0, 0, 9999999999.),
            'wallet_pnl_percentage' => $this->faker->randomFloat(0, 0, 9999999999.),
            'wallet_pnl_date' => $this->faker->date(),
            'wallet_proof_id' => $this->faker->word(),
            'wallet_proof_data' => $this->faker->word(),
            'wallet_id' => Wallet::factory(),
        ];
    }
}
