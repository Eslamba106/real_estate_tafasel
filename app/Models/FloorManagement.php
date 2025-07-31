<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FloorManagement extends Model
{
    use HasFactory;
        protected $guarded = [];
   
    public function project_floor(){
        return $this->belongsTo(Project::class,"project_id","id");
    } 
    public function floor_main(){
        return $this->belongsTo(Floor::class,"floor_id","id");
    }
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
    public function unit_child(){
        return $this->hasMany(UnitManagement::class,"floor_management_id","id");
    }
}
