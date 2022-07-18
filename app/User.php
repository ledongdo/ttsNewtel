<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

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

    public function scopeFilterFreeText($query, $freeText){
        if(!$freeText) return $query;
        return $query->where('name', 'like', "%$freeText%");
    }

    public function scopeActive($query){
      return $query->orderBy('id','asc');
    }

    public function roles(){
        return $this->belongsToMany(Role::class,'roles_users','user_id','role_id');
    }
}
