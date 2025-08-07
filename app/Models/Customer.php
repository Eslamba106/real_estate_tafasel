<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function project(){
        return $this->belongsTo(Project::class , 'project_id');
    }
    public function floor(){
        return $this->belongsTo(FloorManagement::class , 'floor_id');
    }
    public function unit(){
        return $this->belongsTo(UnitManagement::class , 'unit_id');
    }
}
