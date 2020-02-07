<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Position;

class PositionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		if ($this->HasOnlySessionData(self::AdminSessionData))
		{
			$positions = Position::where('is_active', 1)->simplePaginate(10);
			return view('positions.index')->with('positions', $positions);
		}
		return view('welcome.admin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		if ($this->HasOnlySessionData(self::AdminSessionData))
		{
			return view('positions.create');
		}
		return view('welcome.admin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		if ($this->HasOnlySessionData(self::AdminSessionData))
		{
			$position = new Position;
			$position->description = $request->post('description');
			$position->order = $request->post('order');
			$position->ending = $request->post('ending');
			$position->save();

			return redirect()->route('positions.index');
		}
		return view('welcome.admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		if ($this->HasOnlySessionData(self::AdminSessionData))
		{
			$position = Position::findOrFail($id);
			return view('positions.edit')->with('position', $position);
		}
		return view('welcome.admin');
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
		if ($this->HasOnlySessionData(self::AdminSessionData))
		{
			$position = Position::findOrFail($id);
			$position->update([
			'description' => $request->post('description'),
			'order' => $request->post('order'),
			'ending' => $request->post('ending')]);		
			return redirect()->route('positions.index');
		}
		return view('welcome.admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		if ($this->HasOnlySessionData(self::AdminSessionData))
		{
			$position = Position::findOrFail($id);
			$position->update(['is_active' => false]);	
			return redirect()->route('positions.index');
		}
		return view('welcome.admin');
    }
}
