<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Timeline;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TimelineController extends Controller
{
    public function index(Request $request)
    {
        dd($request->user());
    }

    public function show(Timeline $timeline)
    {
        $tl = $timeline
            ->with(['events' => function ($q) {
                return $q->with('updatesRelation')->orderByDesc('id')->limit(5);
            }])
            ->where('id', $timeline->id)
            ->first();

        $updates = $tl->events->pluck('updatesRelation')->flatten()->sortByDesc('remind_at');

        return Inertia::render('Timeline/Show', ['timeline' => $tl, 'updates' => $updates]);
    }

    public function createRootTl(Request $request)
    {
        $user = $request->user();

        $title = $request->get('title');

        $user->timelines()->create(['title' => $title]);

        return redirect()->route('dashboard');

    }
}

