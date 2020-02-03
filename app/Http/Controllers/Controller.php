<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Session;

use Illuminate\Support\Facades\DB;
use App\SearchQuery;
use App\Event;
use App\Position;
use App\AccountRef;
use App\Account;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	// Login
	
	public function HasSessionData($key = 'id')
	{
		return Session::has($key) && Account::where('id', '=', $this->GetSessionData())->count() > 0;
	}
	
	public function GetSessionData($key = 'id')
	{
		return Session::get($key);
	}
	
	public function SetSessionData($value, $key = 'id')
	{
		Session::put($key, $value);
	}
	
	public function ClearSessionData($key = 'id')
	{
		Session::forget($key);
	}	
	
	public function commonStep0Logic()
	{
		if ($this->HasSessionData())
		{
			return $this->commonStep1Logic();
		}
		else
		{
			return view('welcome.index');			
		}
	}
	
	public function commonStep1Logic()
	{
		if ($this->HasSessionData())
		{
			$squeries = SearchQuery::where('account_id', $this->GetSessionData())->get();
			
			if ($squeries->isEmpty())
			{		
				$events = Event::where('is_active', 1)->get()->toArray();
				$eventsKvps = array_column($events, 'description', 'id');
				
				$positions = Position::where('is_active', 1)->get();
				$positionsKvps = array_column($positions->toArray(), 'description', 'id');
				
				$positionsWithEndingsKvps = array();
				
				foreach($positions as $item)
				{
					if ($item)
					{
						$positionsWithEndingsKvps[$item->id] = $item->description . $item->ending;
					}
				}			
				
				return view('welcome.step1')->with('events', $eventsKvps)->
				with('positions', $positionsKvps)->
				with('positionsWithEndings', $positionsWithEndingsKvps);	
			}
			
			$this->SetSessionData('has_search_query', true);			
			return $this->commonStep2Logic();
		}		
		return view('welcome.index');
	}
	
	public function commonStep2Logic()
	{
		if ($this->HasSessionData())
		{
			$refs = AccountRef::where('account_id', $this->GetSessionData())->get();
			
			if ($refs->isEmpty())
			{
				return view('welcome.step2');
			}
			return $this->commonMainLogic();
		}		
		return view('welcome.index');
	}
	
	public function IsTelegram($reference)
	{
		return false;
	}
	
	public function commonMainLogic()
	{
		$account = Account::with('searchQueries')->with('accountRefs')->where('id', $this->GetSessionData())->first();
		$currentSearch = $account->searchQueries->where('is_active', 1)->first();
		
		$fittedLogins = DB::table('t_orm_search_query')->where('is_active', 1)->where('search_position_id', $currentSearch->self_position_id)
		->where('self_position_id', $currentSearch->search_position_id)->where('event_id', $currentSearch->event_id)->pluck('account_id');
		
		$accounts = Account::with('accountRefs')->whereIn('id', $fittedLogins)->simplePaginate(1);		
		return view('main.index')->with('accounts', $accounts);
	}
	
	public function commonMainSettings()
	{
		$account = Account::with('searchQueries')->with('accountRefs')->where('id', $this->GetSessionData())->first();

		$events = Event::where('is_active', 1)->get()->toArray();
		$eventsKvps = array_column($events, 'description', 'id');

		$positions = Position::where('is_active', 1)->get();
		$positionsKvps = array_column($positions->toArray(), 'description', 'id');

		$positionsWithEndingsKvps = array();	
		foreach($positions as $item)
		{
			if ($item)
			{
				$positionsWithEndingsKvps[$item->id] = $item->description . $item->ending;
			}
		}			
			
		$currentSearch = $account->searchQueries->where('is_active', 1)->first();

		return view('main.settings')->with('events', $eventsKvps)->
		with('positions', $positionsKvps)->
		with('account', $account)->
		with('currentSearch', $currentSearch)->with('positionsWithEndings', $positionsWithEndingsKvps);
	}
}
