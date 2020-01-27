<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
	protected $table = 't_orm_account';
	
	public $timestamps = false;
	
	public $incrementing = false;

	protected $fillable = ['facebook_login', 'name', 'patronymic', 'surname', 'description'];
	
	public function accountRefs()
	{
		return $this->hasMany('App\AccountRef', 'facebook_login', 'facebook_login')->where('is_active', true);
	}
	
	public function searchQueries()
	{
		return $this->hasMany('App\SearchQuery', 'facebook_login', 'facebook_login');
	}
}
