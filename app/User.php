<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasRoles;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'cv', 'image', 'school', 'team', 'category_id', 'phone', 'norek', 'tf'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    // public function getJWTIdentifier()
    // {
    //     return $this->getKey();
    // }
    // public function getJWTCustomClaims()
    // {
    //     return [];
    // }
    
    public function business()
    {
        return $this->hasOne(Business::class);
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    
    public function packages()
    {
        return $this->hasMany(Package::class);
    }
    
    public function subscription()
    {
        return $this->hasMany(Subscription::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }


    public function teams()
    {
        return $this->hasMany(Team::class, 'team_id', 'id');
    }
    public function members()
    {
        return $this->hasMany(Member::class, 'team_id', 'id');
    }
    public function documents()
    {
        return $this->hasMany(Document::class, 'team_id', 'id');
    }
    public function logbooks()
    {
        return $this->hasMany(Logbook::class, 'team_id', 'id');
    }
    public function transfers()
    {
        return $this->hasMany(Transfer::class, 'team_id', 'id');
    }
}
