<?php

namespace Database\Seeders;

use App\Models\Poll;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class PollResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $polls = Poll::with('poll_options')->get();
        foreach ($users as $user) {
            foreach ($polls as $poll) {
                $option = Arr::random($poll->poll_options->toArray());
                $user->poll_options()->attach($option['id']);
            }
        }
    }
}
