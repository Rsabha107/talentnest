<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'event_venue';

    public function locations()
    {
        return $this->belongsTo(EventLocation::class, 'location_id');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_venue', 'venue_id', 'project_id');
        // return $this->belongsToMany(Project::class, 'project_venue', 'project_id', 'venue_id');
    }

    public function active_status()
    {
        return $this->belongsTo(GlobalStatus::class, 'active_flag');
    }
}
