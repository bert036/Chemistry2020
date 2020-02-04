<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\AboutInfo;

use DB;

class AboutController extends Controller
{
	
	const DescType = 'desc';
	const RefType = 'ref';
	
	function index()
	{
		$desc = AboutInfo::where('type', self::DescType)->first();
		$refs = AboutInfo::where('type', self::RefType)->get();		
		return view('about.index')->with('description', $desc)->with('refs', $refs);
	}
	
	function edit()
	{
		$desc = AboutInfo::where('type', self::DescType)->first();
		$refs = AboutInfo::where('type', self::RefType)->get();	
		return view('about.edit')->with('description', $desc)->with('refs', $refs);
	}
	
	function update(Request $request)
	{		
		if ($this->HasSessionData())
		{			
			$deleted = DB::delete('delete from t_orm_about');			
			
			if (!empty($request->post('description')))
			{
				$currentContent = new AboutInfo;
				$currentContent->type = self::DescType;		
				$currentContent->content = $request->post('description');
				$currentContent->save();				
			}
			
			echo count($request->post('ref'));
			
			for ($i = 0; $i < count($request->post('ref')); $i++) 
			{				
				$r = $request->post('ref')[$i];
				$a = $request->post('add')[$i];
				
				if (!empty($r))
				{
					$currentContent = new AboutInfo;
					$currentContent->type = self::RefType;		
					$currentContent->content = $r;
					$currentContent->additional = $a;
					$currentContent->save();				
				}
			}
			
			// To check
			return $this->index();							
		}
		
		return view('welcome.index');
	}	
}
