<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'area',
        'location',
        'status',
        'type',
        'image',
        'description',
        'branch_id'
    ];

    public function project_type(){
        return $this->belongsTo(PropertyType::class , 'type');
    }

    public function floor_management(){
        return $this->hasMany(FloorManagement::class , 'project_id'  ,'id');
    }
}
