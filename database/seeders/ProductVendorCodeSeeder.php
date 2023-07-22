<?php

namespace Database\Seeders;

use App\Models\ProductVendorCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductVendorCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductVendorCode::factory()
            ->count(100)
            ->create();
    }
}
