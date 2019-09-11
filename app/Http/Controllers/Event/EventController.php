<?php

namespace App\Http\Controllers\Event;

use App\Lib\Notification\Notification;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{

    public function AllEvents(Request $request)
    {
        $events = Event::select('id', 'title', 'start', 'end', 'description', 'className')->where('is_deleted', false)->get();
        return response()->json($events);
    }

    public function store(Request $request)
    {
        $events = $request->all();
        $event = new Event();
        foreach ($events as $key => $val):
            $event->$key = $val;
        endforeach;
        $event->user_id = auth()->id();
        $event->userc_id = auth()->id();
        $event->save();
        Notification::CreateReminder($event);
        return $event;
    }

    public function editEvent($id)
    {
        $event = Event::find($id);
        return view('default.pages.calendar.modal.editEvent', compact('event'));
    }

    public function updateEvent(Request $request, $id)
    {
        $events = $request->all();
        $event = Event::find($id);
        foreach ($events as $key => $val):
            $event->$key = $val;
        endforeach;
        $event->user_id = auth()->id();
        $event->userc_id = auth()->id();
        $event->save();
        return $event;
    }
}
