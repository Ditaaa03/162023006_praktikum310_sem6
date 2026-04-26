<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('categories')->get();
        return view('index', compact('products'));
    }

    public function admin()
    {
        $products = Product::with('categories')->get();
        $categories = Category::all();
        return view('admin', compact('products','categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'product_price' => 'required|numeric',
            'product_stock' => 'required|numeric',
            'category_id' => 'required|array'
        ]);

        $product = Product::create([
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_stock' => $request->product_stock,
        ]);

        $product->categories()->attach($request->category_id);

        return back()->with('success', 'Produk berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update([
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_stock' => $request->product_stock,
        ]);

        $product->categories()->sync($request->category_id);

        return back()->with('success', 'Produk berhasil diupdate');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return back()->with('success', 'Produk berhasil dihapus');
    }
}