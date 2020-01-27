<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SearchQuery extends Model
{
	protected $table = 't_orm_search_query';
	
	public $timestamps = false;
	
	protected $fillable = ['facebook_login', 'self_position_id', 'search_position_id', 'description', 'is_active'];	

	public function account()
	{
		return $this->belongsTo('App\Account', 'facebook_login', 'facebook_login');
	}
}
