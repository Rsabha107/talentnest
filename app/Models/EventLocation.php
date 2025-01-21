<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventLocation extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'event_location';

    public function active_status()
    {
        return $this->belongsTo(GlobalStatus::class, 'active_flag');
    }

}
