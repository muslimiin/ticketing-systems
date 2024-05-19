<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class TicketController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('ticket.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any Ticket !');
        }

        $tickets = Ticket::with('event')->get();
        return view('backend.pages.tickets.index', compact('tickets'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('ticket.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any ticket !');
        }

        $tickets = Ticket::all();
        $events = Event::all();
        return view('backend.pages.tickets.create', compact('tickets', 'events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('ticket.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any ticket !');
        }

        $request->validate([
            'event_id' => 'required|exists:events,id',
            'name' => 'required',
            'price' => 'required|numeric',
            'quota' => 'required|integer',
            'description' => 'nullable',
        ]);

        // Create New Ticket
        $ticket = new Ticket();
        $ticket->event_id = $request->event_id;
        $ticket->name = $request->name;
        $ticket->price = $request->price;
        $ticket->quota = $request->quota;
        $ticket->description = $request->description;
        $ticket->max_purchase = $request->max_purchase;
        $ticket->save();

        session()->flash('success', 'Ticket has been created !!');
        return redirect()->route('admin.tickets.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        if (is_null($this->user) || !$this->user->can('ticket.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any ticket !');
        }

        $tickets = Ticket::all();
        return view('backend.pages.tickets.view', compact('tickets'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        if (is_null($this->user) || !$this->user->can('ticket.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any ticket !');
        }

        $ticket = Ticket::find($id);
        $events = Event::all();
        return view('backend.pages.tickets.edit', compact('ticket', 'events'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        if (is_null($this->user) || !$this->user->can('ticket.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any ticket !');
        }

        $request->validate([
            'event_id' => 'required|exists:events,id',
            'name' => 'required',
            'price' => 'required|numeric',
            'quota' => 'required|integer',
            'description' => 'nullable',
        ]);

        $ticket = Ticket::find($id);

        $ticket->event_id = $request->event_id;
        $ticket->name = $request->name;
        $ticket->price = $request->price;
        $ticket->quota = $request->quota;
        $ticket->description = $request->description;
        $ticket->max_purchase = $request->max_purchase;
        $ticket->save();

        session()->flash('success', 'Ticket has been updated !!');
        return redirect()->route('admin.tickets.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        if (is_null($this->user) || !$this->user->can('ticket.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to delete any ticket !');
        }

        $ticket = Ticket::find($id);
        if (is_null($ticket)) {
            session()->flash('error', 'Sorry !! Ticket not found !');
            return back();
        }
        $ticket->delete();
        session()->flash('success', 'Ticket has been deleted !!');
        return back();
    }
}
