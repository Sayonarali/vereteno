<?php

namespace Database\Seeders;

use App\Models\ProductVendorCodeAttributeValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductVendorCodeAttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductVendorCodeAttributeValue::factory()
            ->count(300)
            ->create();
    }
}
