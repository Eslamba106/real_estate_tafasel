<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerLog extends Model
{
    use HasFactory;
    protected $guarded  = [ ];

    public function main_user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

}
