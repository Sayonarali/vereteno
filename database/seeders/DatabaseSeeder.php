<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ColorSeeder::class,
            MaterialSeeder::class,
            SizeSeeder::class,
            VendorCodeSeeder::class,
            CategorySeeder::class,
            AttributeSeeder::class,
            AttributeValueSeeder::class,
            DiscountSeeder::class,
            ProductSeeder::class,
            CartItemSeeder::class,
            ProductImageSeeder::class,
            OrderSeeder::class,
            ProductVendorCodeSeeder::class,
            ProductVendorCodeAttributeSeeder::class,
        ]);
    }
}
