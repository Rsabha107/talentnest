<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSponsorship extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'employee_sponsorship';

    public function scopeIsActive($query, $flag)
    {
        return $query->where('archived', $flag);
    }
    
    public function employees()
    {
        return $this->hasMany(Employee::class, 'sponsorship_id');
    }

}
