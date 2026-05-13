<?php

namespace App\Http\Controllers\Admin;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderItemController extends Controller
{
    public function index()
    {
        $orderItems = OrderItem::all();
        return view('admin.order-items.index', ['orderItems' => $orderItems]);
    }
}

