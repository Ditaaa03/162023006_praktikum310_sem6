<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $product = Product::create($request->all());

        $product->categories()->sync($request->categories);

        return redirect('/admin/products');
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update($request->all());

        $product->categories()->sync($request->categories);

        return redirect('/admin/products');
    }
}