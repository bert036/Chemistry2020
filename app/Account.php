<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
	protected $table = 't_orm_account';
	
	public $timestamps = false;
	
	public $incrementing = false;

	protected $fillable = ['id', 'facebook_login', 'first_name', 'middle_name', 'last_name', 'description'];
	
	public function accountRefs()
	{
		return $this->hasMany('App\AccountRef', 'account_id', 'id')->where('is_active', true);
	}
	
	public function searchQueries()
	{
		return $this->hasMany('App\SearchQuery', 'account_id', 'id');
	}
}
