<?php

use App\Http\Controllers\Api\v1\TimelineController;
use App\Http\Controllers\EventsController;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {



    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function (Request $request) {
    $timelines = $request->user()->timelines;
    return Inertia::render('Dashboard', ['timelines' => $timelines]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware' => ['auth']], function(){
    Route::get('timeline', [TimelineController::class, 'index'])->name('timeline.index');
    Route::get('timeline/{timeline}', [TimelineController::class, 'show'])->name('timeline.show');
    Route::post('timeline/create-root-tl', [TimelineController::class, 'createRootTl'])->name('timeline.create-root-tl');

    Route::get('timeline/{timeline}/events', [EventsController::class, 'index'])->name('events.index');
    Route::get('timeline/{timeline}/events', [EventsController::class, 'showCreate'])->name('events.create-form');
    Route::post('timeline/{timeline}/events', [EventsController::class, 'create'])->name('events.create');
    Route::get('timeline/{timeline}/events/{event}', [EventsController::class, 'show'])->name('events.show');

});
require __DIR__.'/auth.php';
