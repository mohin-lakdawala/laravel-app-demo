<?php

namespace Database\Factories;

use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;

class GameFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Game::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'started_at' => $started_at = $this->faker->dateTimeBetween('-30 days'),
            'finished_at' => $this->faker->dateTimeBetween($started_at),
            'player_life' => $this->faker->numberBetween(0, 100),
            'dragon_life' => $this->faker->numberBetween(0, 100),
        ];
    }
}
