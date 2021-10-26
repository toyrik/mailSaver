<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Message::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 50; $i++) {
            Message::create([
                'name' => $faker->name,
                'mail' => $faker->email,
                'content' => $faker->paragraph,
                'confirm' => $faker->boolean,
            ]);
        }
    }
}
