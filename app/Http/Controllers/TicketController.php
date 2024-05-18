<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        return Ticket::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'name' => 'required',
            'price' => 'required|numeric',
            'quota' => 'required|integer',
            'description' => 'nullable',
            'max_purchase' => 'required|integer',
        ]);

        return Ticket::create($validated);
    }

    public function show(Ticket $ticket)
    {
        return $ticket;
    }

    public function update(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'name' => 'required',
            'price' => 'required|numeric',
            'quota' => 'required|integer',
            'description' => 'nullable',
            'max_purchase' => 'required|integer',
        ]);

        $ticket->update($validated);

        return $ticket;
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return response()->noContent();
    }
}
