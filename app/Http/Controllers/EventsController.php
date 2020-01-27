<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$events = Event::where('is_active', 1)->simplePaginate(10);
		return view('events.index')->with('events', $events);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
	 * $request->input()
     */
    public function store(Request $request)
    {
		$event = new Event;
		$event->description = $request->post('description');
		$event->start_date = $request->post('start_date');
		$event->end_date = $request->post('end_date');
		$event->save();

		return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$event = Event::findOrFail($id);
		return view('events.show')->with('event', $event);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$event = Event::findOrFail($id);
		return view('events.edit')->with('event', $event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$event = Event::findOrFail($id);
		$event->update([
		'description' => $request->post('description'),
		'start_date' => $request->post('start_date'),
		'end_date' => $request->post('end_date')]);	
		return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	 
    public function destroy($id)
    {
		$event = Event::findOrFail($id);
		$event->update(['is_active' => false]);	
		return redirect()->route('events.index');
    }
}
