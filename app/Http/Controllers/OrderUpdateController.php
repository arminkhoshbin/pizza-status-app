<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Inertia\Inertia;

class OrderUpdateController
{
    public function create()
    {
        return Inertia::render('Pos/Updates', [
            'orders' => Order::with('history')
                ->get()
                ->map(fn (Order $order) => [
                    'id' => $order->id,
                    'name' => $order->name,
                    'latest_status' => $order->latestOrderStatus(),
                ]),
        ]);
    }
}