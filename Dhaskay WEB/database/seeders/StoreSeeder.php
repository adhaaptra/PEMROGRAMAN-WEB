<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store;

class StoreSeeder extends Seeder
{
    public function run()
    {
        $stores = [
            ['name' => 'Toko Pusat', 'location' => 'Jakarta'],
            ['name' => 'Toko Cabang Bandung', 'location' => 'Bandung'],
            ['name' => 'Toko Cabang Surabaya', 'location' => 'Surabaya'],
        ];

        foreach ($stores as $s) {
            Store::firstOrCreate(['name' => $s['name']], ['location' => $s['location']]);
        }
    }
}
