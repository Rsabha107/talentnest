<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectType extends Model
{
    use HasFactory;
    protected $table="project_type";

    public function active_status()
    {
        return $this->belongsTo(GlobalStatus::class, 'active_flag');
    }

}
