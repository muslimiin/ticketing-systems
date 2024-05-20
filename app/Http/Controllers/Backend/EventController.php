<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class EventController extends Controller
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
        if (is_null($this->user) || !$this->user->can('event.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any Event !');
        }

        $events = Event::all();
        return view('backend.pages.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('event.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any event !');
        }

        $events = Event::all();
        return view('backend.pages.events.create', compact('events'));
    }

    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('event.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any event !');
        }

        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'province' => 'required',
            'category' => 'required',
            'description' => 'required',
            'information' => 'required',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
        ]);

        // Handle image upload
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/events', $imageName); // Store the image in storage/app/public/events directory
        }

        // Create New Event
        $event = new Event();
        $event->name = $request->name;
        $event->location = $request->location;
        $event->province = $request->province;
        $event->category = $request->category;
        $event->description = $request->description;
        $event->information = $request->information;
        $event->image = $imageName || $request->image;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->save();

        session()->flash('success', 'Event has been created !!');
        return redirect()->route('admin.events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        if (is_null($this->user) || !$this->user->can('event.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any event !');
        }

        $events = Event::all();
        return view('backend.pages.events.view', compact('events'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        if (is_null($this->user) || !$this->user->can('event.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any event !');
        }

        $event = Event::find($id);
        return view('backend.pages.events.edit', compact('event'));
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
        if (is_null($this->user) || !$this->user->can('event.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any event !');
        }

        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'province' => 'required',
            'category' => 'required',
            'description' => 'required',
            'information' => 'required',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/events', $imageName); // Store the image in storage/app/public/events directory
        }

        $event = Event::find($id);

        $event->name = $request->name;
        $event->location = $request->location;
        $event->province = $request->province;
        $event->category = $request->category;
        $event->description = $request->description;
        $event->information = $request->information;
        $event->image = $imageName || $request->image;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->save();

        session()->flash('success', 'Event has been updated !!');
        return redirect()->route('admin.events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        if (is_null($this->user) || !$this->user->can('event.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to delete any event !');
        }

        $event = Event::find($id);
        if (is_null($event)) {
            session()->flash('error', 'Sorry !! Event not found !');
            return back();
        }
        $event->delete();
        session()->flash('success', 'Event has been deleted !!');
        return back();
    }
}
