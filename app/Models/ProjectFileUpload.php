<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectFileUpload extends Model
{
    use HasFactory;

    protected $table = 'project_files';

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
