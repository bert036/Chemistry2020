<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	protected $table = 't_orm_event';
	
	public $timestamps = false;
	
	protected $fillable = ['description', 'start_date', 'end_date', 'is_active'];
}
