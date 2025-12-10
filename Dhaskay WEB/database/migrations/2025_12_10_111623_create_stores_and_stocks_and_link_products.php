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
        // Create stores table
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location')->nullable();
            $table->timestamps();
        });

        // Create stocks table
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->integer('quantity')->default(0);
            $table->timestamps();
        });

        // Add store_id to products
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('store_id')->nullable()->after('id')->constrained('stores')->nullOnDelete();
        });

        // Migrate existing data from `toko` and `stok` columns (if present)
        if (Schema::hasColumn('products', 'toko') || Schema::hasColumn('products', 'stok')) {
            // Use DB facade to migrate data
            $products = \DB::table('products')->get();
            foreach ($products as $p) {
                $storeId = null;
                if (isset($p->toko) && $p->toko) {
                    // find existing store or create
                    $existing = \DB::table('stores')->where('name', $p->toko)->first();
                    if ($existing) {
                        $storeId = $existing->id;
                    } else {
                        $storeId = \DB::table('stores')->insertGetId([
                            'name' => $p->toko,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }

                // Update product with store_id
                if ($storeId) {
                    \DB::table('products')->where('id', $p->id)->update(['store_id' => $storeId]);
                }

                // Create stock row from existing stok column
                if (isset($p->stok)) {
                    \DB::table('stocks')->insert([
                        'product_id' => $p->id,
                        'quantity' => (int) $p->stok,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            // Drop old columns
            Schema::table('products', function (Blueprint $table) {
                if (Schema::hasColumn('products', 'stok')) {
                    $table->dropColumn('stok');
                }
                if (Schema::hasColumn('products', 'toko')) {
                    $table->dropColumn('toko');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove store_id from products
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'store_id')) {
                $table->dropConstrainedForeignId('store_id');
            }
        });

        // Drop stocks and stores tables
        Schema::dropIfExists('stocks');
        Schema::dropIfExists('stores');
    }
};
