<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->foreignId('store_id')->nullable()->after('product_id')->constrained('stores')->nullOnDelete();
        });

        // Backfill existing stocks using products.store_id when available
        $stocks = \DB::table('stocks')->get();
        foreach ($stocks as $stock) {
            $product = \DB::table('products')->where('id', $stock->product_id)->first();
            if ($product && isset($product->store_id) && $product->store_id) {
                \DB::table('stocks')->where('id', $stock->id)->update(['store_id' => $product->store_id]);
            } else {
                // if product has no store, attempt to assign to a default store
                $default = \DB::table('stores')->where('name', 'Default Store')->first();
                if (!$default) {
                    $defaultId = \DB::table('stores')->insertGetId(['name' => 'Default Store', 'created_at' => now(), 'updated_at' => now()]);
                } else {
                    $defaultId = $default->id;
                }
                \DB::table('stocks')->where('id', $stock->id)->update(['store_id' => $defaultId]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stocks', function (Blueprint $table) {
            if (Schema::hasColumn('stocks', 'store_id')) {
                $table->dropConstrainedForeignId('store_id');
            }
        });
    }
};
