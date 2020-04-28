<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Common;

use DB;

class CommonController extends Controller
{
	
	const Id = 'id';
	const Description = 'description';
	
	const Id_Description = 'description';
	
	
	function index()
	{
		if ($this->HasOnlySessionData(self::AdminSessionData))
		{
			$item = Common::where(self::Id, self::Id_Description)->first();	
			return view('common.index')->with('item', $item);
		}
		return view('welcome.admin');
	}
	
	function update(Request $request)
	{	
		if ($this->HasOnlySessionData(self::AdminSessionData))
		{
			if (!empty($request->post(self::Description)))
			{
				$desc = Common::where(self::Id, self::Id_Description)->first();
				
				if ($desc->id = self::Id_Description)
				{
					$desc->update(['description' => $request->post(self::Description)]);	
				}
				else
				{
					$currentContent = new Common;
					$currentContent->id = self::Description;		
					$currentContent->description = $request->post(self::Description);
					$currentContent->save();	
				}				
			}
			return view('admins.index');
		}
		return view('welcome.admin');		
	}	
}