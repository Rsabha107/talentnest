<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeaveAttachment extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'employee_leave_attachments';

    public function scopeIsActive($query, $flag)
    {
        return $query->where('archived', $flag);
    }
}
