<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Log;

class Task extends Model
{
    use HasFactory;
    protected $appends = ["open"];
    protected $table='tasks';
    protected $guarded = [];


    protected static function booted(){
        // self::addGlobalScope(function(EloquentBuilder $builder){
        //     $builder->when(session()->get('workspace_id'), function ($query, $workspace) {
        //         return $query->where('tasks.workspace_id', $workspace);
        //     });
        // });
    }

    public function getOpenAttribute(){
        return true;
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_assignment_id');
    }

    public function assigned_by()
    {
        return $this->belongsTo(Person::class, 'assignment_id');
    }

    public function assigned_to()
    {
        return $this->belongsTo(Employee::class, 'assignment_id');
    }

    public function venue()
    {
        return $this->belongsTo(venue::class, 'venue_id');
    }

    public function functional_area()
    {
        return $this->belongsTo(FunctionalArea::class, 'functional_area_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function employees() : BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'employee_task', 'task_id', 'employee_id');
    }

    public function tags() : BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'task_tag', 'task_id', 'tag_id');
    }

    public function files()
    {
        return $this->hasMany(TaskFileUpload::class)->orderBy('created_at', 'desc');
    }

    public function notes()
    {
        return $this->hasMany(TaskNote::class)->orderBy('created_at', 'desc');
    }

    public function subtask()
    {
        return $this->hasMany(Subtask::class, 'parent_task_id');
    }

    // public function users()
    // {
    //     return $this->belongsTo(User::class, 'created_by');
    // }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_task');
    }

    public function workspaces()
    {
        return $this->belongsTo(Workspace::class, 'workspace_id');
    }
}
