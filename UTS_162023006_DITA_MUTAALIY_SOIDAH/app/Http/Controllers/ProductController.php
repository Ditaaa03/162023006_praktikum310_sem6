<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!session()->has('user')) {
            return redirect()->route('login');
        }

        $products = Product::all();
        $totalProduk = Product::count();

        return view('dashboard', compact('products', 'totalProduk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if (!session()->has('user')) {
            return redirect()->route('login');
        }

        $validateData = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kode_produk' => 'required|string|max:255|unique:products',
            'stok_produk' => 'required|integer',
            'harga' => 'required|numeric',
        ]);

        Product::create($validateData);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!session()->has('user')) {
            return redirect()->route('login');
        }

        $product = Product::findOrFail($id);

        $validateData = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kode_produk' => 'required|string|max:255|unique:products,kode_produk,' . $id,
            'stok_produk' => 'required|integer',
            'harga' => 'required|numeric',
        ]);

        $product->update($validateData);

        return redirect()->route('dashboard')->with('success', 'Produk berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->back();
    }
}