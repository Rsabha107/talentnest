<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeBank extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'employee_banks';

    public function scopeIsActive($query, $flag)
    {
        return $query->where('archived', $flag);
    }

    public function employees()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function attachments()
    {
        return $this->hasMany(EmployeeAttachment::class, 'model_id')->where('model_name', 'BANK');
    }
}
