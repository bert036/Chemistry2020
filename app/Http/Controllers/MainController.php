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
	
	public function update(Request $request)
	{		
		if ($this->HasSessionData())
		{
			// Update search
			
			$currentQuery = SearchQuery::findOrFail($request->post('currentSearchQueryId'));
			
			if ($currentQuery->self_position_id != $request->post('self_position') ||
				$currentQuery->search_position_id != $request->post('search_position') ||
				$currentQuery->event_id != $request->post('event') ||
				$currentQuery->description != $request->post('description'))
			{
				$currentQuery->update(['is_active' => false]);
							
				$newQuery = new SearchQuery;
				$newQuery->account_id = $this->GetSessionData();
				$newQuery->self_position_id = $request->post('self_position');
				$newQuery->search_position_id = $request->post('search_position');
				$newQuery->event_id = $request->post('event');
				$newQuery->description = $request->post('description');
				$newQuery->save();	
			}			
			
			// Update references
			
			$new = $request->post('name');			
			$existing = AccountRef::where('account_id', $this->GetSessionData())->where('is_active', 1)->get();
			
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
				if (!in_array($item, $refs) && !empty($item))
				{
					$accountRef = new AccountRef;
					$accountRef->account_id = $this->GetSessionData();
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
