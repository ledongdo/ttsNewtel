<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $guarded = [];
    
    public function scopeFilterFreeText($query, $freeText){
        if(!$freeText) return $query;
        return $query->where('name', 'like', "%$freeText%");
    }
}
