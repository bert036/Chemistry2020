<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
	protected $table = 't_orm_position';
	
	public $timestamps = false;
	
	protected $fillable = ['description', 'order', 'is_active'];
}
