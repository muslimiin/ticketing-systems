<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return Event::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'location' => 'required',
            'province' => 'required',
            'category' => 'required',
            'description' => 'required',
            'information' => 'required',
            'image' => 'required',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
        ]);

        return Event::create($validated);
    }

    public function show(Event $event)
    {
        return $event;
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'required',
            'location' => 'required',
            'province' => 'required',
            'category' => 'required',
            'description' => 'required',
            'information' => 'required',
            'image' => 'required',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
        ]);

        $event->update($validated);

        return $event;
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return response()->noContent();
    }
}
