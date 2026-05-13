<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity ?? 1;

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'name'     => $product->name,
                'price'    => $product->sale_price ?? $product->price,
                'quantity' => $quantity,
                'image'    => $product->image,
                'slug'     => $product->slug,
            ];
        }

        session()->put('cart', $cart);

        if ($request->expectsJson()) {
            return response()->json([
                'success'   => true,
                'cartCount' => count($cart),
                'message'   => 'Product added to cart!'
            ]);
        }

        return back()->with('success', 'Product added to cart!');
    }

    public function remove(Request $request)
    {
        $productId = $request->product_id;
        $cart = session()->get('cart', []);
        unset($cart[$productId]);
        session()->put('cart', $cart);
        return back()->with('success', 'Product removed from cart!');
    }

    public function update(Request $request)
    {
        $productId = $request->product_id;
        $quantity  = $request->quantity;
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            if ($quantity <= 0) {
                unset($cart[$productId]);
            } else {
                $cart[$productId]['quantity'] = $quantity;
            }
        }

        session()->put('cart', $cart);
        return back()->with('success', 'Cart updated!');
    }

    public function clear()
    {
        session()->forget('cart');
        return back()->with('success', 'Cart cleared!');
    }
}