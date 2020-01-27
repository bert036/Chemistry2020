<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountRef extends Model
{
	protected $table = 't_orm_account_refs';
		
	public $timestamps = false;
	
	protected $fillable = ['facebook_login', 'reference', 'is_telegram', 'is_active'];
	
	public function account()
	{
		return $this->belongsTo('App\Account', 'facebook_login', 'facebook_login');
	}
}
