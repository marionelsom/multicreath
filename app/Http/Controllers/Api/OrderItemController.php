<?php

namespace App\Http\Controllers\Api;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderItemController extends Controller
{
    public function index(Request $request)
    {
        $query = OrderItem::query();

        if ($request->has('order_id')) {
            $query->where('order_id', $request->order_id);
        }

        return $query->with('order', 'productVariant')->get();
    }

    public function show(OrderItem $orderItem)
    {
        return $orderItem->load('order', 'productVariant');
    }
}