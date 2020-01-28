<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SearchQuery extends Model
{
	protected $table = 't_orm_search_query';
	
	public $timestamps = false;
	
	protected $fillable = ['account_id', 'self_position_id', 'search_position_id', 'description', 'is_active'];	

	public function account()
	{
		return $this->belongsTo('App\Account', 'account_id', 'id');
	}
}
