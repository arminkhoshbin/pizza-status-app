<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PosCreateOrderController
{
    public function create()
    {
        return Inertia::render('Pos/CreateOrder');
    }

    public function store(Request $request)
    {
        $order = Order::create([
            'name' => $request->input('name'),
            'user_id' => $request->user()->id,
        ]);

        return to_route('orders.send-update.create', $order->id);
    }
}