<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAttachment extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'employee_attachments';

    public function scopeIsActive($query, $flag)
    {
        return $query->where('archived', $flag);
    }

    public function employees()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    
}
