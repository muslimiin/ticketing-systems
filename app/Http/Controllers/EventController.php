<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::with('tickets');

        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        if ($request->has('province') && $request->province != '') {
            $query->where('province', $request->province);
        }

        if ($request->has('start_date') && $request->start_date != '' && $request->has('end_date') && $request->end_date != '') {
            $query->whereBetween('start_time', [$request->start_date, $request->end_date]);
        }

        $events = $query->orderBy('start_time', 'asc')->get();
        return response()->json($events);
    }

    public function show($id)
    {
        $event = Event::with('tickets')->findOrFail($id);
        return response()->json($event);
    }
}
