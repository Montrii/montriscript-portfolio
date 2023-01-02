<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Projects;
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
        // \App\Models\User::factory(10)->create();


        User::factory()->create([
            'name' => "Montri",
            'email' => "montripublic@gmail.com",
            'password' => bcrypt("JrUtMK12."),
        ]);


        Projects::factory()->create([
            'title' => "DiscordBot",
            'description' => "Checking for information..",
            'online' => true,
        ]);

    }
}
