<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountRef extends Model
{
	protected $table = 't_orm_account_refs';
		
	public $timestamps = false;
	
	protected $fillable = ['account_id', 'reference', 'is_telegram', 'is_active'];
	
	public function account()
	{
		return $this->belongsTo('App\Account', 'account_id', 'id');
	}
}
