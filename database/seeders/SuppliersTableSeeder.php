<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SuppliersTableSeeder extends Seeder
{
    public function run()
    {
        Supplier::factory()->create([
            'name' => 'TechSuppliers Inc.',
            'contact_person' => 'John Smith',
            'email' => 'john@techsuppliers.com',
            'phone' => '555-1234',
            'address' => '123 Tech Street, San Francisco, CA',
        ]);

        Supplier::factory()->create([
            'name' => 'OfficeFurn Co.',
            'contact_person' => 'Sarah Johnson',
            'email' => 'sarah@officefurn.com',
            'phone' => '555-5678',
            'address' => '456 Office Road, New York, NY',
        ]);

        Supplier::factory()->count(10)->create();
    }
}