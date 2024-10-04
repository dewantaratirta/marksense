<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\TradePnl;
use App\Models\Wallet;

class TradePnlFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TradePnl::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'trade_pnl_ulid' => (string) Str::ulid(),
            'trade_pnl_amount' => $this->faker->randomFloat(0, 0, 9999999999.),
            'trade_pnl_percentage' => $this->faker->randomFloat(0, 0, 9999999999.),
            'trade_pnl_date' => $this->faker->date(),
            'trade_proof_id' => $this->faker->word(),
            'trade_proof_data' => $this->faker->word(),
            'wallet_id' => Wallet::factory(),
        ];
    }
}
