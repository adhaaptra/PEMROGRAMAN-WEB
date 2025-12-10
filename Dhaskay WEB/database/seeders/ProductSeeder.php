<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Store;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $stores = Store::all();

        if ($stores->isEmpty()) {
            $store = Store::create(['name' => 'Toko Default', 'location' => 'Lokasi Default']);
        } else {
            $store = $stores->first();
        }

        $products = [
            ['name' => 'Produk A', 'price' => 10000, 'description' => 'Produk A contoh', 'store_id' => $store->id],
            ['name' => 'Produk B', 'price' => 25000, 'description' => 'Produk B contoh', 'store_id' => $store->id],
            ['name' => 'Produk C', 'price' => 50000, 'description' => 'Produk C contoh', 'store_id' => $store->id],
        ];

        foreach ($products as $p) {
            Product::firstOrCreate(['name' => $p['name']], [
                'price' => $p['price'],
                'description' => $p['description'],
                'store_id' => $p['store_id'],
            ]);
        }
    }
}
