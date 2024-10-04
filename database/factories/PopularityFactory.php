<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Popularity;

class PopularityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Popularity::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'popularity_ulid' => (string) Str::ulid(),
            'popularity_date' => $this->faker->date(),
        ];
    }
}
