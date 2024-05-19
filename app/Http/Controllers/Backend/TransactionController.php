<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Transaction;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function index()
    {
        if (is_null($this->user) || !$this->user->can('transaction.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any transaction!');
        }

        $transactions = Transaction::with('event', 'ticket')->get();
        return view('backend.pages.transactions.index', compact('transactions'));
    }

    public function create()
    {
        if (is_null($this->user) || !$this->user->can('transaction.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any transaction!');
        }

        $events = Event::all();
        return view('backend.pages.transactions.create', compact('events'));
    }

    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('transaction.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any transaction!');
        }

        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'ticket_id' => 'required|exists:tickets,id',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'buyer_name' => 'required',
            'buyer_email' => 'required|email',
            'buyer_phone' => 'required',
        ]);

        $ticket = Ticket::find($validated['ticket_id']);

        if ($ticket) {
            if ($ticket->max_purchase && $validated['quantity'] > $ticket->max_purchase) {
                return redirect()->back()->withInput()->withErrors(['quantity' => 'Maksimal pembelian tiket terlampaui']);
            }

            if ($validated['quantity'] > $ticket->quota) {
                return redirect()->back()->withInput()->withErrors(['quantity' => 'Jumlah pembelian melebihi kuota tiket yang tersedia']);
            }
        }

        $validated['transaction_date'] = now(); // Set transaction date to current date
        $validated['total'] = $validated['price'] * $validated['quantity'];
        Transaction::create($validated);

        return redirect()->route('admin.transactions.index')->with('success', 'Transaction created successfully!');
    }

    public function show(Transaction $transaction)
    {
        if (is_null($this->user) || !$this->user->can('transaction.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any transaction!');
        }

        $transaction = $transaction->load('event', 'ticket');
        return view('backend.pages.transactions.show', compact('transaction'));
    }

    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('transaction.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any transaction!');
        }

        $transaction = Transaction::findOrFail($id);
        $events = Event::all();
        $tickets = Ticket::where('event_id', $transaction->event_id)->get();
        return view('backend.pages.transactions.edit', compact('transaction', 'events', 'tickets'));
    }

    public function update(Request $request, $id)
    {
        if (is_null($this->user) || !$this->user->can('transaction.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any transaction!');
        }

        $request->validate([
            'event_id' => 'required|exists:events,id',
            'ticket_id' => 'required|exists:tickets,id',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'total' => 'required|numeric',
            'buyer_name' => 'required|string|max:255',
            'buyer_email' => 'required|email|max:255',
            'buyer_phone' => 'required|string|max:15',
        ]);

        $transaction = Transaction::findOrFail($id);

        $ticket = Ticket::find($request->ticket_id);

        if ($ticket) {
            if ($ticket->max_purchase && $request->quantity > $ticket->max_purchase) {
                return redirect()->back()->withInput()->withErrors(['quantity' => 'Maksimal pembelian tiket terlampaui']);
            }

            if ($request->quantity > $ticket->quota) {
                return redirect()->back()->withInput()->withErrors(['quantity' => 'Jumlah pembelian melebihi kuota tiket yang tersedia']);
            }
        }

        $transaction->event_id = $request->event_id;
        $transaction->ticket_id = $request->ticket_id;
        $transaction->price = $request->price;
        $transaction->quantity = $request->quantity;
        $transaction->total = $request->total;
        $transaction->buyer_name = $request->buyer_name;
        $transaction->buyer_email = $request->buyer_email;
        $transaction->buyer_phone = $request->buyer_phone;
        $transaction->save();

        return redirect()->route('admin.transactions.index')->with('success', 'Transaction updated successfully!');
    }

    public function destroy(Transaction $transaction)
    {
        if (is_null($this->user) || !$this->user->can('transaction.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to delete any transaction!');
        }

        $transaction->delete();
        return redirect()->route('admin.transactions.index')->with('success', 'Transaction deleted successfully!');
    }
}
