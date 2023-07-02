<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_images')->insert([
            'disk' => 'images',
            'path' => '/product/hat1.jpeg',
            'title' => 'Шляпа1',
            'product_id' => '1',
            'size' => '1213',
        ]);
        DB::table('product_images')->insert([
            'disk' => 'images',
            'path' => '/product/hat1_1.jpeg',
            'title' => 'Шляпа1',
            'product_id' => '1',
            'size' => '1213',
        ]);
        DB::table('product_images')->insert([
            'disk' => 'images',
            'path' => '/product/hat1_2.jpeg',
            'title' => 'Шляпа1',
            'product_id' => '1',
            'size' => '1213',
        ]);
//
        DB::table('product_images')->insert([
            'disk' => 'images',
            'path' => '/product/Untitled3.jpeg',
            'title' => 'Шляпа2',
            'product_id' => '2',
            'size' => '1213',
        ]);
        DB::table('product_images')->insert([
            'disk' => 'images',
            'path' => '/product/Untitled4.jpeg',
            'title' => 'Шляпа2',
            'product_id' => '2',
            'size' => '1213',
        ]);
    }
}
