<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded = [];
    
    public function job()
    {
		return $this->belongsToMany('App\Job')->where('due_at', '>=', date("Y-m-d"));
	}
}
