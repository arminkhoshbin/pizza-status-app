<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrdersController
{
    public function create(Request $request)
    {
        return Inertia::render('Pos/Orders', [
            'orders' => Order::with('history')
                ->forUser($request->user())
                ->get()
                ->map(fn (Order $order) => [
                    'id' => $order->id,
                    'name' => $order->name,
                    'latest_status' => $order->latestOrderStatus(),
                ]),
        ]);
    }
}