<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAddress extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'employee_addresses';

    public function scopeIsActive($query, $flag)
    {
        return $query->where('archived', $flag);
    }
    
    public function employees()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function address_types()
    {
        return $this->hasOne(AddressType::class, 'id', 'address_type');
    }


}
