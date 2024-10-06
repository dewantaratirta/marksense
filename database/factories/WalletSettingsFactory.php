<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Wallet;
use App\Models\WalletSettings;

class WalletSettingsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WalletSettings::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'ulid' => (string) Str::ulid(),
            'wallet_settings_name' => $this->faker->word(),
            'wallet_settings_value' => $this->faker->word(),
            'wallet_id' => Wallet::factory(),
        ];
    }
}
