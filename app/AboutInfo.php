<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AboutInfo extends Model
{
	protected $table = 't_orm_about';
	
	public $timestamps = false;
	
	protected $fillable = ['id', 'type', 'content', 'additional'];
}
