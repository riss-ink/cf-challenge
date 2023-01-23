<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory(10)->create();
        $polls = \App\Models\Poll::factory(10)->recycle($users)->create();
        foreach ($polls as $poll) {
            \App\Models\PollOption::factory(5)->recycle($poll)->create();
        }
        User::factory(1)->admin()->create();
        User::factory(1)->testUser()->create();


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
