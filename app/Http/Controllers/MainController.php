<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SearchQuery;
use App\AccountRef;

class MainController extends Controller
{
	public function index()
	{
		return $this->commonMainLogic();
	}
	
	public function settings()
	{
		return  $this->commonMainSettings();
	}
	
	public function updateSearch(Request $request)
	{		
		if ($this->HasSessionData())
		{
			$query = SearchQuery::findOrFail($request->post('currentSearchQueryId'));
			$query->update(['is_active' => false]);	
		
			$squery = new SearchQuery;
			$squery->facebook_login = $this->GetSessionData();
			$squery->self_position_id = $request->post('self_position');
			$squery->search_position_id = $request->post('search_position');
			$squery->event_id = $request->post('event');
			$squery->description = $request->post('description');
			$squery->save();
			
			return  $this->commonMainSettings();
		}		
		return view('welcome.index');
	}	
	
	public function updateRefs(Request $request)
	{		
		if ($this->HasSessionData())
		{
			$new = $request->post('name');			
			$existing = AccountRef::where('facebook_login', $this->GetSessionData())->where('is_active', 1)->get();
			
			foreach($existing as $item)
			{
				if (!in_array($item->reference, $new))
				{
					$item->update(['is_active' => false]);
				}
			}	
			
			$refs = array_column($existing->toArray(), 'reference');
			
			foreach($request->post('name') as $item)
			{
				if (!in_array($item, $refs))
				{
					$accountRef = new AccountRef;
					$accountRef->facebook_login = $this->GetSessionData();
					$accountRef->reference = $item;
					$accountRef->is_telegram = $this->IsTelegram($accountRef->reference);		
					$accountRef->save();					
				}			
			}

			
			return $this->commonMainSettings();
		}		
		return view('welcome.index');
	}
	
	public function about()
	{
		return view('main.about');
	}
}
