<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stock;
use App\Models\Product;
use App\Models\Store;

class StockSeeder extends Seeder
{
    public function run()
    {
        $products = Product::all();
        $stores = Store::all();

        foreach ($products as $product) {
            $storeId = $stores->first()->id ?? null;
            Stock::updateOrCreate([
                'product_id' => $product->id,
                'store_id' => $storeId,
            ], [
                'quantity' => rand(10, 100),
            ]);
        }
    }
}
