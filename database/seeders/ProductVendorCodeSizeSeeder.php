<?php

namespace Database\Seeders;

use App\Models\ProductVendorCodeSize;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductVendorCodeSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductVendorCodeSize::factory()
            ->count(300)
            ->create();
    }
}
