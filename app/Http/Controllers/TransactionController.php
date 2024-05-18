<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return Transaction::with('event', 'ticket')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'transaction_date' => 'required|date',
            'event_id' => 'required|exists:events,id',
            'ticket_id' => 'required|exists:tickets,id',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'buyer_name' => 'required',
            'buyer_email' => 'required|email',
            'buyer_phone' => 'required',
        ]);

        $ticket = Ticket::find($validated['ticket_id']);
        if ($validated['quantity'] > $ticket->max_purchase) {
            return response()->json(['error' => 'Maksimal pembelian tiket terlampaui'], 400);
        }

        $validated['total'] = $validated['price'] * $validated['quantity'];
        return Transaction::create($validated);
    }

    public function show(Transaction $transaction)
    {
        return $transaction->load('event', 'ticket');
    }

    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'transaction_date' => 'required|date',
            'event_id' => 'required|exists:events,id',
            'ticket_id' => 'required|exists:tickets,id',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'buyer_name' => 'required',
            'buyer_email' => 'required|email',
            'buyer_phone' => 'required',
        ]);

        $ticket = Ticket::find($validated['ticket_id']);
        if ($validated['quantity'] > $ticket->max_purchase) {
            return response()->json(['error' => 'Maksimal pembelian tiket terlampaui'], 400);
        }

        $validated['total'] = $validated['price'] * $validated['quantity'];
        $transaction->update($validated);

        return $transaction;
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return response()->noContent();
    }
}
