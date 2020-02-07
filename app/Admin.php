<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
	protected $table = 't_orm_admins';
	
	public $timestamps = false;
}
