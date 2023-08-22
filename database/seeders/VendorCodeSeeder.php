<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\VendorCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VendorCode::factory()
            ->count(30)
            ->create();
    }
}
