<?php

use Illuminate\Database\Seeder;
use App\Task;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i< 20; $i++) {
            Task::create([
                'user_id' => 1,
                'title' => Str::random(10),
                'description' => Str::random(30),
                'registration_date' => date('Y-m-d'),
                'expiration_date' => '2021-12-31',
            ]);
        }
    }
}
