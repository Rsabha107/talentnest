<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeGeneratedLetter extends Model
{
    use HasFactory;

    public function letter_title()
    {
        return $this->belongsTo(EmployeeLetter::class, 'letter_type');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
