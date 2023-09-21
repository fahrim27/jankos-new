<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{   
    protected $table = 'videos';
    protected $guarded = ['id'];
    
    //protected $fillable = ['category', 'name', 'link'];
    
    public function team()
    {
        return $this->belongsTo(User::class, 'team_id', 'id');
    }
}
