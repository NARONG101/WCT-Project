<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
            User::factory()->create([
            'name' => 'Rong',
            'email' => 'admin@gmail.com',
        ]);

    }
}