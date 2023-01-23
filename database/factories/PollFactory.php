<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Poll;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PollFactory extends Factory
{

    protected $model = Poll::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(60),
            'description' => $this->faker->text(),
            'start_date' => $this->faker->dateTimeBetween('-1 month', '-1 week'),
            'end_date' => $this->faker->dateTimeBetween('now', '+1 month'),

        ];
    }

    public function activePoll(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'start_date' => $this->faker->dateTimeBetween('-1 week', 'now'),
                'end_date' => $this->faker->dateTimeBetween('+1 day', '+1 week'),

            ];
        });
    }
    public function finishedPoll(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'start_date' => $this->faker->dateTimeBetween('-2 month', '-1 month'),
                'end_date' => $this->faker->dateTimeBetween('-1 week', 'now'),

            ];
        });
    }
    public function pendingPoll(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'start_date' => $this->faker->dateTimeBetween('+1 day', '+1 week'),
                'end_date' => $this->faker->dateTimeBetween('+1 month'),

            ];
        });
    }
}
