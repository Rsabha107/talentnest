<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class EmployeeLeave extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $guarded = [];
    protected $table = 'employee_leave_requests';

    public function scopeIsActive($query, $flag)
    {
        return $query->where('archived', $flag);
    }    
    
    public function employees()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function leave_types()
    {
        return $this->belongsTo(EmployeeLeaveType::class, 'leave_type_id');
    }

    public function leave_statuses()
    {
        return $this->belongsTo(EmployeeLeaveStatus::class, 'status_id');
    }

    public function attachements()
    {
        return $this->hasMany(EmployeeLeaveAttachment::class, 'leave_id');
    }

    public function performer()
    {
        return $this->belongsTo(Employee::class, 'performer_id');
    }
}
