<?php

namespace Database\Seeders;

use App\Models\ProductVendorCodeAttribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductVendorCodeAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductVendorCodeAttribute::factory()
            ->count(300)
            ->create();
    }
}
