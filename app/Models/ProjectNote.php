<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectNote extends Model
{
    use HasFactory;

    protected $table = 'project_notes';

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
