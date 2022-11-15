<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Timeline;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventsController extends Controller
{
    public function index(Timeline $timeline, Request $request)
    {

        return Inertia::render("Events/Index", ['timeline' => $timeline]);
    }

    public function showCreate(Timeline $timeline,)
    {
        return Inertia::render("Events/Create", ['timeline' => $timeline]);
    }

    public function create(Timeline $timeline, Request $request)
    {
        $data = $request->all();

        if ($request->user()->id == $timeline->user_id) {

            $event = $timeline->events()->create([
                'user_id' => $timeline->user_id,
                'title' => $data['title'],
                'body' => $data['body'],
            ]);

            if (count($data['updates'])) {
                foreach ($data['updates'] as $update) {
                    $event->updatesRelation()->create([
                        'user_id' => $event->user_id,
                        'text' => $update['title'],
                        'remind_at' => Carbon::createFromTimestampMs(($update['timestamp']))->format('Y-m-d H:i:s'),
                    ]);
                }
            }

            return redirect()->route('events.show', [$timeline, $event]);
        }

        return redirect()->back();
    }


    public function show(Timeline $timeline, Event $event)
    {
        $event->load('updatesRelation');
        return Inertia::render('Events/Show', [
            'timeline' => $timeline,
            'event' => $event
        ]);
    }
}
