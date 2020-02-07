<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\SearchQuery;
use App\AccountRef;
use App\Admin;

class WelcomeController extends Controller
{
	function index()
	{
		return $this->commonStep0Logic();
	}
	
	function admin()
	{
		if ($this->HasOnlySessionData(self::AdminSessionData))
		{
			return view('admins.index');
		}
		return view('welcome.admin');
	}
	
	function step036(Request $request)
	{
		if (Admin::where('hash', hash('tiger192,3', $request->post('password')))->exists()) {
			$this->SetSessionData(1, self::AdminSessionData);
			return view('admins.index');
		}
		echo 'Такого Одмена нет!';
		return view('welcome.admin');
	}
	
	function logout()
	{
		$this->ClearSessionData();
		$this->ClearSessionData(self::SearchQuerySessionData);
		$this->ClearSessionData(self::AdminSessionData);
		return view('welcome.index');
	}
	
	function step1()
	{
		return $this->commonStep1Logic();
	}

	function step1b(Request $request)
	{
		if ($this->HasSessionData())
		{
			$squery = new SearchQuery;
			$squery->account_id = $this->GetSessionData();
			$squery->self_position_id = $request->post('self_position');
			$squery->search_position_id = $request->post('search_position');
			$squery->event_id = $request->post('event');
			$squery->save();
			
			$this->SetSessionData(1, self::SearchQuerySessionData);		
			return view('welcome.step1b');
		}		
		return view('welcome.index');
	}
	
	function step2(Request $request)
	{
		if ($this->HasSessionData())
		{
			$squery = SearchQuery::where('is_active', 1)->where('account_id', $this->GetSessionData())->first();
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
				if (!empty($item))
				{
					$accountRef = new AccountRef;
					$accountRef->account_id = $this->GetSessionData();
					$accountRef->reference = $item;
					$accountRef->is_telegram = $this->IsTelegram($accountRef->reference);		
					$accountRef->save();					
				}				
			}
			return $this->commonMainLogic();
		}		
		return view('welcome.index');
	}		
}
