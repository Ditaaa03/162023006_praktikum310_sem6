<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function add($id)
    {
        $product = Product::find($id);

        $cart = session()->get('cart', []);

        $cart[$id] = [
            "name" => $product->product_name,
            "price" => $product->product_price
        ];

        session()->put('cart', $cart);

        return back();
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    public function remove($id)
    {
        $cart = session()->get('cart');
        unset($cart[$id]);
        session()->put('cart', $cart);

        return back();
    }
}
