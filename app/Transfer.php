<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $guarded = ['id'];

    public function team()
    {
        return $this->belongsTo(User::class, 'team_id', 'id');
    }
}
