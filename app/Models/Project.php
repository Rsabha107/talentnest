<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function clients()
    {
        return $this->belongsToMany(Client::class, 'client_project');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id', 'id');
    }

    public function fundCategories()
    {
        return $this->belongsTo(FundCategory::class, 'fund_category_id', 'id');
    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_project');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'project_tag');
    }

    public function functional_areas()
    {
        return $this->belongsToMany(FunctionalArea::class, 'project_funtional_area', 'project_id', 'functional_area_id');
    }

    public function venues()
    {
        return $this->belongsToMany(Venue::class, 'project_venue', 'project_id', 'venue_id');
    }

    public function notes()
    {
        return $this->hasMany(ProjectNote::class, 'project_id', 'id');
    }

    public function files()
    {
        return $this->hasMany(ProjectFileUpload::class, 'project_id', 'id');
    }

    public function locations()
    {
        return $this->belongsTo(EventLocation::class, 'location_id', 'id');
    }

    public function categories()
    {
        return $this->belongsTo(EventCategory::class, 'category_id', 'id');
    }

    public function types()
    {
        return $this->belongsTo(ProjectType::class, 'project_type_id', 'id');
    }

    public function attendances()
    {
        return $this->hasMany(EventAttendance::class, 'event_id', 'id');
    }
}
