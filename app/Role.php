<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];

    public function permissions(){
        return $this->belongsToMany(Permission::class,'permission_role','role_id','permission_id');
    }

    public function scopeFilterFreeText($query, $freeText){
        if(!$freeText) return $query;
        return $query->where('name', 'like', "%$freeText%");
    }
}

