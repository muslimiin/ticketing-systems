<?php

namespace App\Observers;

use App\Models\Event;
use Illuminate\Support\Facades\Log;

class EventObserver
{
    public function created(Event $event)
    {
        Log::info('Event Created', [
            'event_id' => $event->id,
            'user_id' => auth()->id(),
            'time' => now(),
        ]);
    }

    public function updated(Event $event)
    {
        Log::info('Event Updated', [
            'event_id' => $event->id,
            'user_id' => auth()->id(),
            'time' => now(),
        ]);
    }
}
