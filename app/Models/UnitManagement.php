<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitManagement extends Model
{
    use HasFactory;
        protected $guarded    = []; 

   
    public function project_unit_management()
    {
        return $this->belongsTo(Project::class, "project_id", "id");
    }
  
    public function floor_unit_management()
    {
        return $this->belongsTo(FloorManagement::class, "floor_management_id", "id");
    }
 
    public function unit_type()
    {
        return $this->belongsTo(UnitType::class, "unit_type_id", "id");
    }
    public function unit_condition()
    {
        return $this->belongsTo(UnitCondition::class, "unit_condition_id", "id");
    }
    public function unit_description()
    {
        return $this->belongsTo(UnitDescription::class, "unit_description_id", "id");
    }
    // public function schedules()
    // {
    //     return $this->hasMany(Schedule::class, 'unit_id', 'id');
    // }
     
    public function view()
    {
        return $this->belongsTo(View::class, "view_id", "id");
    }
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
    public function scopeEmptyUnit($query)
    {
        return $query->where('booking_status', 'empty');
    }
 

    
 

    // public function booking_main()
    // {
    //     return $this->belongsTo(BookingUnits::class, "id", "unit_id") ;
    // }

    // public function agreement_main()
    // {
    //     return $this->belongsTo(AgreementUnits::class, "id", "unit_id") ;
    // }
}
