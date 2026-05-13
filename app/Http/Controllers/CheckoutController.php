<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // Authentication middleware is applied via routes/web.php



    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect('/products')->with('error', 'Your cart is empty');
        }

        return view('checkout.index', compact('cart'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'phone' => 'required|string',
            'payment_method' => 'required|in:cod,credit_card',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Cart is empty');
        }

        $totalAmount = 0;
        foreach ($cart as $productId => $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        $shippingFee = 10;
        $totalAmount += $shippingFee;

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'payment_method' => $validated['payment_method'],
            'shipping_address' => $validated['address'] . ', ' . $validated['city'],
        ]);

        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'unit_price' => $item['price'],
            ]);

            // Decrement stock
            Product::find($productId)->decrement('stock', $item['quantity']);
        }

        session()->forget('cart');

        return redirect()->route('checkout.success', $order->id)
            ->with('success', 'Order placed successfully!');
    }

    public function success($orderId)
    {
        $order = Order::findOrFail($orderId);

        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('checkout.success', compact('order'));
    }
}
