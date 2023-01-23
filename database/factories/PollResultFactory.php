<?php

namespace Database\Factories;

use App\Models\PollOption;
use App\Models\PollResult;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PollResultFactory extends Factory
{

    protected $model = PollResult::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'poll_option_id' => PollOption::factory(),
            'user_id' => PollResult::factory()
        ];
    }
}
