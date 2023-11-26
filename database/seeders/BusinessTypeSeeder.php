<?php

namespace Database\Seeders;

use App\Models\BusinessType;
use Illuminate\Database\Seeder;

class BusinessTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BusinessType::factory()->create([
            'name' => 'Food Only',
        ]);

        BusinessType::factory()->create([
            'name' => 'Beverages Only',
        ]);

        BusinessType::factory()->create([
            'name' => 'Food and Beverages',
        ]);

        BusinessType::factory()->create([
            'name' => 'Accessories',
        ]);

        BusinessType::factory()->create([
            'name' => 'Clothing',
        ]);
    }
}
