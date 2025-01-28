<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Linkx;
use App\Models\Taskx;
use App\Models\Event;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\DB;


class GanttController extends Controller
{
    //
    public function index($id=null)
    {
        $project = Project::find($id);
        return view('projects/admin/project/gantt/gantt', ['project_id' => $project->id]);
    }

    public function get($id)
    {

        // $eventData = Event::join('colors', 'colors.id', '=', 'events.color_id')
        //     ->whereNull('archived')
        //     // ->where('events.id','=', $id)
        //     ->get(([
        //         'events.id',
        //         'events.name',
        //         'events.duration',
        //         'events.progress',
        //         'events.start_date',
        //         'events.end_date',
        //         'events.parent',
        //         'colors.name as color',
        //     ]));

        $projectData = DB::table('projects')
            ->select('id', 'name', 'duration', 'progress', 'start_date', 'end_date', 'parent', 'color_id')
            ->where('id', '=', $id)
            ->get();
        //  dd($id);
        $data_arr = [];
        foreach ($projectData as $key => $record) {
            $progress = get_project_progress($record->id)/100;

            $data_arr[] = [
                "id"      => $record->id,
                "text"    => $record->name,
                "department"      => 'see tasks',
                "duration"    => $record->duration,
                "progress"    => $progress,
                "start_date"    => $record->start_date,
                "end_date"    => $record->end_date,
                "parent"    => $record->parent,
                "color"     => '#d8f9f5',
                // "color"     => $record->color,
                "type"      => 'event',
                "open"      => true,
            ];

            $taskData = DB::table('tasks')
                ->leftjoin('colors', 'colors.id', '=', 'tasks.color_id')
                ->join('departments', 'departments.id', '=', 'tasks.department_assignment_id')
                ->select(
                    "tasks.id",
                    DB::raw("concat(departments.name, ' / ', tasks.name) as name"),
                    "departments.name as dept",
                    "tasks.name as task_name",
                    "duration",
                    "progress",
                    "status_id",
                    "start_date",
                    "due_date",
                    "project_id as parent",
                    "colors.name as color"
                )
                ->where('project_id', '=', $record->id)
                ->orderBy('tasks.start_date', 'asc')
                ->get();

            // $taskData = DB::table('tasks')
            // ->select('id','name', 'duration','progress','start_date','due_date', 'event_id as parent')
            // ->where('event_id', '=', $record->id)->get();

            foreach ($taskData as $key => $record) {

                $color = null;
                // if ($record->status_id == config('tracki.task_status.completed')) {
                //     $color = '#DAF7A6';
                // } else {
                //     $color = '#E5E4E2';
                // }
                array_push($data_arr, [
                    "id"      => $record->id,
                    "text"    => $record->task_name,
                    "department"      => $record->name,
                    "duration"    => $record->duration,
                    "progress"    => $record->progress,
                    "start_date"    => $record->start_date,
                    "end_date"    => $record->due_date,
                    "parent"    => $record->parent,
                    "color"    => $color,
                    "type"      => 'task',
                    "open"      => true,
                ]);
            }
        }



        // $taskData = DB::table('tasks')
        // ->select('id','name as text', 'duration','progress','start_date','event_id as parent')
        // ->where('event_id', '=', $id);


        // $evenData = DB::table('events')
        //     ->select('id','name as text', 'duration','progress','start_date','parent')
        //     ->where('id', '=', $id)
        //     ->union($taskData)
        //     ->get();




        // $users = DB::table('users')
        //         ->whereNull('last_name')
        //         ->union($first)
        //         ->get();

        // $evenData = Event::all('name as text', 'duration','progress','start_date','parent');
        // $taskData = Task::all('name as text', 'duration','progress','start_date','parent')->union($evenData);

        // $linkData = DB::table('tasks')
        //             ->select('id', 'id as source','event_id as target','type')
        //             ->where('event_id', '=', $id)->get();

        $linkData = DB::table('tasks')
            ->select('id', 'project_id as source', 'id as target', 'type')
            ->get();

        $tasks = Taskx::all();
        $links = new Linkx();

        // dd($data_arr);
        return response()->json([
            "data" => $data_arr,
            "links" => $linkData
        ]);
    }
}
