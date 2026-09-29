<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'category_id' => 1,
            'code' => 'P001',
            'name' => 'Pensil',
            'unit' => 'pcs',
            'price' => 3000,
            'stock' => 20,
        ]);

        Product::create([
            'category_id' => 1,
            'code' => 'P002',
            'name' => 'Buku',
            'unit' => 'pcs',
            'price' => 5000,
            'stock' => 5,
        ]);

        Product::create([
            'category_id' => 1,
            'code' => 'P003',
            'name' => 'Pulpen',
            'unit' => 'pcs',
            'price' => 2000,
            'stock' => 0,
        ]);
    }
}