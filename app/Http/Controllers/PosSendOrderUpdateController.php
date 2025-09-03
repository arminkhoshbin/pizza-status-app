<?php

namespace App\Http\Controllers;

use App\Events\PizzaStatusUpdated;
use App\Models\Order;
use App\Models\OrderHistory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PosSendOrderUpdateController
{
    public function create(Order $order, Request $request)
    {
        abort_if($order->user_id !== $request->user()->id, 403);

        return Inertia::render('Pos/SendUpdate', [
            'order' => $order,
            'nextAvailableStatus' => $order->nextAvailableOrderStatus(),
        ]);
    }

    public function store(Order $order, Request $request)
    {
        OrderHistory::create([
            'order_id' => $order->id,
            'status' => $request->input('status'),
        ]);

        event(new PizzaStatusUpdated(
            $request->user()->id,
            $order,
            $request->input('status')));

        return redirect()
            ->back()
            ->with('flash', sprintf('Pizza status updated to %s!', $request->input('status')));
    }
}