<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Store;
use App\Models\Product;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stocks = Stock::with(['product','store'])->get();
        return view('stocks.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stores = Store::all();
        $products = Product::all();
        return view('stocks.create', compact('stores','products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'store_id' => 'nullable|exists:stores,id',
            'quantity' => 'required|integer|min:0',
        ]);

        Stock::updateOrCreate([
            'product_id' => $validated['product_id'],
            'store_id' => $validated['store_id'],
        ], ['quantity' => $validated['quantity']]);

        return redirect()->route('stocks.index')->with('success', 'Stok berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $stock = Stock::findOrFail($id);
        return view('stocks.show', compact('stock'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $stock = Stock::findOrFail($id);
        $stores = Store::all();
        $products = Product::all();
        return view('stocks.edit', compact('stock','stores','products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $stock = Stock::findOrFail($id);
        $validated = $request->validate([
            'quantity' => 'required|integer|min:0',
        ]);
        $stock->update(['quantity' => $validated['quantity']]);
        return redirect()->route('stocks.index')->with('success', 'Stok berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $stock = Stock::findOrFail($id);
        $stock->delete();
        return redirect()->route('stocks.index')->with('success', 'Stok berhasil dihapus.');
    }
}
