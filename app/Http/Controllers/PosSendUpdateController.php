<?php

namespace App\Http\Controllers;

use App\Events\PizzaStatusUpdated;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PosSendUpdateController
{
    public function create()
    {
        return Inertia::render('Pos/SendUpdate');
    }

    public function store(Request $request)
    {
        event(new PizzaStatusUpdated(auth()->user()->id, $request->input('status')));

        return redirect()
            ->back()
            ->with('flash', sprintf('Pizza status updated to %s!', $request->input('status')));
    }
}