<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\SearchQuery;
use App\AccountRef;

class WelcomeController extends Controller
{
	function index()
	{
		return view('welcome.index');
	}
	
	function about()
	{
		return view('welcome.about');
	}
	
	function logout()
	{
		$this->ClearSessionData();
		return view('welcome.index');
	}
	
	function step1()
	{
		return $this->commonStep1Logic();
	}

	function step2(Request $request)
	{
		if ($this->HasSessionData())
		{
			$squery = new SearchQuery;
			$squery->facebook_login = $this->GetSessionData();
			$squery->self_position_id = $request->post('self_position');
			$squery->search_position_id = $request->post('search_position');
			$squery->event_id = $request->post('event');
			$squery->description = $request->post('description');
			$squery->save();
			
			return $this->commonStep2Logic();
		}		
		return view('welcome.index');
	}

	function step3(Request $request)
	{
		if ($this->HasSessionData())
		{
			foreach($request->post('name') as $item)
			{
				$accountRef = new AccountRef;
				$accountRef->facebook_login = $this->GetSessionData();
				$accountRef->reference = $item;
				$accountRef->is_telegram = $this->IsTelegram($accountRef->reference);		
				$accountRef->save();				
			}
			return $this->commonMainLogic();
		}		
		return view('welcome.index');
	}		
}
