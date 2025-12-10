<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use App\Models\Stock;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $stores = Store::all();
        return view('products.create', compact('stores'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'stok' => 'nullable|integer|min:0',
            'store_id' => 'nullable|exists:stores,id',
        ]);

        $product = Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'] ?? null,
            'store_id' => $validated['store_id'] ?? null,
        ]);

        // Create stock record
        $quantity = isset($validated['stok']) ? (int) $validated['stok'] : 0;
        Stock::create([
            'product_id' => $product->id,
            'quantity' => $quantity,
            'store_id' => $validated['store_id'] ?? null,
        ]);

        return redirect('/products')->with('success', '✅ Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        $stores = Store::all();
        return view('products.edit', compact('product','stores'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'stok' => 'nullable|integer|min:0',
            'store_id' => 'nullable|exists:stores,id',
        ]);

        $product->store_id = $validated['store_id'] ?? null;
        $product->name = $validated['name'];
        $product->price = $validated['price'];
        $product->description = $validated['description'] ?? null;
        $product->save();

        // Update or create stock for this store-product
        $quantity = isset($validated['stok']) ? (int) $validated['stok'] : 0;
        $storeId = $validated['store_id'] ?? null;
        $stock = Stock::where('product_id', $product->id)->where('store_id', $storeId)->first();
        if ($stock) {
            $stock->update(['quantity' => $quantity]);
        } else {
            Stock::create(['product_id' => $product->id, 'store_id' => $storeId, 'quantity' => $quantity]);
        }

        return redirect('/products')->with('success', '✏️ Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('/products')->with('success', '🗑️ Produk berhasil dihapus!');
    }
}
