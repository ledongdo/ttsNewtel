<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Department extends Model
{   
    protected $guarded = [];
    public function departmentChildrent(){
        return $this->hasMany(Department::class,'parent_id');
    }
    public function scopeFilterFreeText($query, $freeText){
        if(!$freeText) return $query;
        return $query->where('name', 'like', "%$freeText%");
    }
    
}
