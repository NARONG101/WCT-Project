<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
             User::create([
            'name' => 'Rong',
            'email' => 'admin@gmail.com',
            'password' => '12345678',
        ]);

    }
}