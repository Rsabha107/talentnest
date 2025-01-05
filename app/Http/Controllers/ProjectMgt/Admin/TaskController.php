<?php

namespace App\Http\Controllers\ProjectMgt\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Project;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    //
    public function index()
    {
        $projects = Project::all();
        // $eventData = Event::all();
        $users = User::all();
        $employees = Employee::all();
        $statuses = Status::all();
        $departments = Department::all();

        return view('projects.admin.task.list', [
            'projects' => $projects,
            'users' => $users,
            'statuses' => $statuses,
            'departments' => $departments,
            // 'eventData' => $eventData,
            'employees' => $employees,
        ]);
    } // End index

    public function list($id=null)
    {
        $workspace = session()->get('workspace_id');
        $user = User::findOrFail(auth()->user()->id);

        $user_department = auth()->user()->department_assignment_id;

        $search = request()->search;
        $sort = (request()->sort) ? request()->sort : "id";
        $order = (request()->order) ? request()->order : "DESC";
        $project_id = (request()->project_id) ? request()->project_id : "";
        $status_id = (request()->status) ? request()->status : "";
        $person_id = (request()->person_id) ? request()->person_id : "";
        $department_id = (request()->department_id) ? request()->department_id : "";

        if ($id) {
            $project = Project::find($id);
            $ops = $project->tasks()->orderBy($sort, $order);
        } else {
            $ops = Task::orderBy($sort, $order);
        }

        // Log::alert($request->all());
        // Log::info(request());
        // Log::info('request get: '.$request->get('project_id'));
        // Log::info('request(): '.request('project_id'));
        Log::alert('allTaskDt search: ' . $search);
        Log::alert('allTaskDt project_id: ' . $project_id);
        Log::alert('allTaskDt status_id: ' . $status_id);
        Log::alert('allTaskDt person_id: ' . $person_id);
        Log::alert('allTaskDt department_id: ' . $department_id);

        $where = [];
        // $tasks = Task::when($user_department, function ($query, $user_department) {
        //     return $query->where('tasks.department_assignment_id', $user_department);
        // })
        //     ->when(auth()->user()->functional_area_id, function ($query, $user_fa) {
        //         return $query->where('events.functional_area_id', $user_fa);
        //     });
        // ->first();

        // Log::info('route name:'.Route::current()->getName());
        // $user = User::find(4);
        // $tasks = $user->tasks();

        Log::info('workspace: ' . $workspace);
        Log::info('project_id1: ' . $project_id);

        // $tasks = Task::when($workspace, function ($query, $workspace) {
        //     return $query->where('tasks.workspace_id', $workspace);
        // })->when($id, function ($query, $project_id){
        //     return $query->where('tasks.event_id', $project_id);
        // });

        // $tasks = Task::all();
        $statuses = Status::all();

        if ($search) {
            $ops = $ops->where(function ($query) use ($search) {
                $query->where('tasks.name', 'like', '%' . $search . '%');
            });
        }

        if ($department_id) {
            $ops = $ops->where(function ($query) use ($department_id) {
                $query->where('department_assignment_id', 'like', '%' . $department_id . '%');
            });
        }

        if ($status_id) {
            $ops = $ops->where(function ($query) use ($status_id) {
                $query->where('status_id', 'like', '%' . $status_id . '%');
            });
        }

        if ($project_id) {
            $ops = $ops->where(function ($query) use ($project_id) {
                $query->where('project_id', 'like', '%' . $project_id . '%');
            });
        }

        if ($person_id) {
            $employee = Employee::find($person_id);
            $ops = $employee->tasks()->orderBy($sort, $order);
            // dd($ops);
            // Log::
        }

        $total = $ops->count();

        $ops = $ops->orderBy($sort, $order)->paginate(request('limit'))->through(function ($op) use ($statuses, $user) {

            $mytime = Carbon::now();

            $due_date_text_color = 'primary';
            if ($op->due_date < $mytime && $op->status->title != 'Completed') {
                $due_date_text_color = 'danger';
            } elseif ($op->status->title == 'Completed') {
                $due_date_text_color = 'success';
            }

            $statusOptions = '';
            foreach ($statuses as $status) {
                // $disabled = canSetStatus($status)  ? '' : 'disabled';
                $selected = $op->status_id == $status->id ? 'selected' : '';
                $statusOptions .= '<option value="' . $status->id . '" ' . $selected . '>' . $status->title . '</option>';
            }

            $icons = (($op->notes->count()) ? '<button class="btn p-0 text-body-tertiary fs-10 me-2"><span class="fas fa-sticky-note me-1"></span>' . $op->notes->count() . '</button>' : "") .
                (($op->files->count()) ? '<button class="btn p-0 text-body-tertiary fs-10 me-2"><span class="fas fa-paperclip me-1"></span>' . $op->files->count() . '</button>' : "") .
                (($op->subtask->count()) ? '<button class="btn p-0 text-body-tertiary fs-10 me-2"><span class="fas fas fa-network-wired me-1"></span>' . $op->subtask->count() . '</button>' : "");

            $div_action = '<div class="font-sans-serif btn-reveal-trigger position-static">';
            $profile_action =
                '<a href="' . route("hr.admin.employee.profile", encrypt($op->id)) . '" class="btn-table btn-sm me-2" id="employeeCardView" data-id="' .
                $op->id .
                '" data-table="employee_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Employee Details">' .
                '<i class="fa-solid fa-lightbulb text-warning"></i></a>';
            $update_action =
                '<a href="javascript:void(0)" class="btn-table btn-sm me-2" id="edit_project" data-id=' . $op->id .
                ' data-table="project_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Update">' .
                '<i class="fa-solid fa-pen-to-square text-primary"></i></a>';
            $duplicate_action =
                '<a href="javascript:void(0)" class="btn-table btn-sm me-2" id="duplicate_employee" data-action="update" data-type="duplicate" data-id=' .
                $op->id .
                ' data-table="employee_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Duplicate">' .
                '<i class="fa-solid fa-copy text-success"></i></a>';
            $delete_action =
                '<a href="javascript:void(0)" class="btn-table btn-sm" data-table="project_table" data-id="' .
                $op->id .
                '" id="delete" data-bs-toggle="tooltip" data-bs-placement="right" title="Delete">' .
                '<i class="fa-solid fa-trash text-danger"></i></a></div></div>';
            $restore_action =
                '<a href="javascript:void(0)" class="btn btn-sm" data-table="employee_table" data-id="' .
                $op->id .
                '" id="restoreEmployee" data-bs-toggle="tooltip" data-bs-placement="right" title="Restore">' .
                '<i class="fa-solid fa-rotate-left test-warning"></i></a></div></div>';

            $delete_restore = ('N' == 'N') ? $delete_action : $restore_action;

            $actions = $div_action . $profile_action;

            ($user->can('employee.edit')) ? $actions = $actions . $update_action . $duplicate_action : $actions = $actions;
            ($user->can('employee.delete')) ? $actions = $actions . $delete_restore : $actions = $actions;

            $not_assigned_html = '<span class="badge text-black bg-light">Not assigned</span>';
            $assign_to = '<div class="avatar-group">';

            foreach ($op->employees as $key => $user) {
                if ($user->emp_files?->file_path) {
                    $assign_to = $assign_to . '<div class="avatar avatar-m ">
                        <a href="' . route('hr.admin.employee.profile', encrypt($user->id)) . '"
                            role="button" title="' . $user->full_name . '">
                            <img class="rounded-circle pull-up"
                                src="' . $user->emp_files->file_path . $user->emp_files->file_name . '"
                                alt="" />
                        </a>
                    </div>';
                } else {
                    $assign_to = $assign_to . '<div class="avatar avatar-m  me-1">
                        <a class="dropdown-toggle dropdown-caret-none d-inline-block"
                            href="' . route('hr.admin.employee.profile', encrypt($user->id)) . '"
                            role="button" title="' . $user->name . '">
                            <div class="avatar avatar-m  rounded-circle pull-up">
                                <div class="avatar-name rounded-circle me-2">
                                    <span>' . generateInitials($user->full_name) . '</span>
                                </div>
                            </div>
                        </a>
                    </div>';
                }
            }

            return [
                'id1' => '<div class="ms-3">' . $op->id . '</div>',
                'id' => $op->id,
                'project_id' => '<div class="d-flex align-items-center"><div><a class="fw-bold mb-0 line-clamp-3" href="/tracki/task/' . $op->project_id . '/list">' . $op->project?->name . '</a>',
                'name' => '<a class="fw-bold mb-0 line-clamp-3" id="taskCardView" href="javascript:void(0);"  data-id="' . $op->id . '" data-table="task_table">' . $op->name . '</a><div class="d-flex align-items-center">' .
                    '<p class="mb-0 text-body-highlight fw-semibold fs-10 me-2">' . $icons . '</p></div></div></div>',
                'workspace_id' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $op->workspaces?->title . '</div>',
                'department_assignment_id' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $op->department->name . '</div>',
                'assigned_by' => $op->assigned_by?->name,
                'assigned_to' => $assign_to,
                // 'assigned_to' => $op->employees,
                'start_date' =>  format_date($op->start_date,  'H:i:s'),
                'end_date' =>  '<span class="text-' . $due_date_text_color . '">' .  format_date($op->due_date,  'H:i:s') . '</spanc>',
                'budget' => $op->budget_allocation,
                'budget_consumed' => $op->actual_budget_allocated,
                'attributes' => (($op->notes->count()) ? '<button class="btn p-0 text-body-tertiary fs-10 me-2"><span class="fas fa-sticky-note me-1"></span>' . $op->notes->count() . '</button>' : "") .
                    (($op->files->count()) ? '<button class="btn p-0 text-body-tertiary fs-10 me-2"><span class="fas fa-paperclip me-1"></span>' . $op->files->count() . '</button>' : "") .
                    (($op->subtask->count()) ? '<button class="btn p-0 text-body-tertiary fs-10 me-2"><span class="fas fas fa-network-wired me-1"></span>' . $op->subtask->count() . '</button>' : ""),
                // 'attributes' => '<div class="ms-3 text-secondary">'.(($op->files->count()) ? '<span class="fas fa-file-alt me-1"></span>':"").' '.(($op->notes->count()) ? '<span class="fas fa-clipboard me-1"></span>':"").'</div>',
                // 'status' => '<select  class="form-select select2-with-image" id="statusSelect'.$op->id.'" data-id="'.$op->id.'" data-original-status-id="'.$op->status->id.'" data-type="task">'.$statusOptions.'</select>',
                'status' => '<span class="badge badge-phoenix fs--2 badge-phoenix-' . $op->status->color . ' " style="cursor: pointer;" id="editTaskStatus" data-id="' . $op->id . '" data-table="task_table"><span class="badge-label">' . $op->status->title . '</span><span class="ms-1 uil-edit-alt" style="height:12.8px;width:12.8px;cursor: pointer;"></span></span>',
                'description' => $op->description,
                // 'description' => '<button class="btn btn-secondary m-1" type="button" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Top Popover">Top Popover</button>',
                'actions' => $actions,
                'created_at' => format_date($op->created_at,  'H:i:s'),
                'updated_at' => format_date($op->updated_at, 'H:i:s'),
            ];
        });


        return response()->json([
            "rows" => $ops->items(),
            "total" => $total,
        ]);
    } //list

    public function employeeList($id=null)
    {
        $workspace = session()->get('workspace_id');
        $user = User::findOrFail(auth()->user()->id);

        $user_department = auth()->user()->department_assignment_id;

        $search = request()->search;
        $sort = (request()->sort) ? request()->sort : "id";
        $order = (request()->order) ? request()->order : "DESC";
        $project_id = (request()->project_id) ? request()->project_id : "";
        $status_id = (request()->status) ? request()->status : "";
        $person_id = (request()->person_id) ? request()->person_id : "";
        $department_id = (request()->department_id) ? request()->department_id : "";

        if ($id) {
            $employee = Employee::find($id);
            $ops = $employee->tasks()->orderBy($sort, $order);
        } else {
            $ops = Task::orderBy($sort, $order);
        }

        // Log::alert($request->all());
        // Log::info(request());
        // Log::info('request get: '.$request->get('project_id'));
        // Log::info('request(): '.request('project_id'));
        Log::alert('allTaskDt search: ' . $search);
        Log::alert('allTaskDt project_id: ' . $project_id);
        Log::alert('allTaskDt status_id: ' . $status_id);
        Log::alert('allTaskDt person_id: ' . $person_id);
        Log::alert('allTaskDt department_id: ' . $department_id);

        $where = [];
        // $tasks = Task::when($user_department, function ($query, $user_department) {
        //     return $query->where('tasks.department_assignment_id', $user_department);
        // })
        //     ->when(auth()->user()->functional_area_id, function ($query, $user_fa) {
        //         return $query->where('events.functional_area_id', $user_fa);
        //     });
        // ->first();

        // Log::info('route name:'.Route::current()->getName());
        // $user = User::find(4);
        // $tasks = $user->tasks();

        Log::info('workspace: ' . $workspace);
        Log::info('project_id1: ' . $project_id);

        // $tasks = Task::when($workspace, function ($query, $workspace) {
        //     return $query->where('tasks.workspace_id', $workspace);
        // })->when($id, function ($query, $project_id){
        //     return $query->where('tasks.event_id', $project_id);
        // });

        // $tasks = Task::all();
        $statuses = Status::all();

        if ($search) {
            $ops = $ops->where(function ($query) use ($search) {
                $query->where('tasks.name', 'like', '%' . $search . '%');
            });
        }

        if ($department_id) {
            $ops = $ops->where(function ($query) use ($department_id) {
                $query->where('department_assignment_id', 'like', '%' . $department_id . '%');
            });
        }

        if ($status_id) {
            $ops = $ops->where(function ($query) use ($status_id) {
                $query->where('status_id', 'like', '%' . $status_id . '%');
            });
        }

        if ($project_id) {
            $ops = $ops->where(function ($query) use ($project_id) {
                $query->where('project_id', 'like', '%' . $project_id . '%');
            });
        }

        if ($person_id) {
            $employee = Employee::find($person_id);
            $ops = $employee->tasks()->orderBy($sort, $order);
            // dd($ops);
            // Log::
        }

        $total = $ops->count();

        $ops = $ops->orderBy($sort, $order)->paginate(request('limit'))->through(function ($op) use ($statuses, $user) {

            $mytime = Carbon::now();

            $due_date_text_color = 'primary';
            if ($op->due_date < $mytime && $op->status->title != 'Completed') {
                $due_date_text_color = 'danger';
            } elseif ($op->status->title == 'Completed') {
                $due_date_text_color = 'success';
            }

            $statusOptions = '';
            foreach ($statuses as $status) {
                // $disabled = canSetStatus($status)  ? '' : 'disabled';
                $selected = $op->status_id == $status->id ? 'selected' : '';
                $statusOptions .= '<option value="' . $status->id . '" ' . $selected . '>' . $status->title . '</option>';
            }

            $icons = (($op->notes->count()) ? '<button class="btn p-0 text-body-tertiary fs-10 me-2"><span class="fas fa-sticky-note me-1"></span>' . $op->notes->count() . '</button>' : "") .
                (($op->files->count()) ? '<button class="btn p-0 text-body-tertiary fs-10 me-2"><span class="fas fa-paperclip me-1"></span>' . $op->files->count() . '</button>' : "") .
                (($op->subtask->count()) ? '<button class="btn p-0 text-body-tertiary fs-10 me-2"><span class="fas fas fa-network-wired me-1"></span>' . $op->subtask->count() . '</button>' : "");

            $div_action = '<div class="font-sans-serif btn-reveal-trigger position-static">';
            $profile_action =
                '<a href="' . route("hr.admin.employee.profile", encrypt($op->id)) . '" class="btn-table btn-sm me-2" id="employeeCardView" data-id="' .
                $op->id .
                '" data-table="employee_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Employee Details">' .
                '<i class="fa-solid fa-lightbulb text-warning"></i></a>';
            $update_action =
                '<a href="javascript:void(0)" class="btn-table btn-sm me-2" id="edit_project" data-id=' . $op->id .
                ' data-table="project_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Update">' .
                '<i class="fa-solid fa-pen-to-square text-primary"></i></a>';
            $duplicate_action =
                '<a href="javascript:void(0)" class="btn-table btn-sm me-2" id="duplicate_employee" data-action="update" data-type="duplicate" data-id=' .
                $op->id .
                ' data-table="employee_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Duplicate">' .
                '<i class="fa-solid fa-copy text-success"></i></a>';
            $delete_action =
                '<a href="javascript:void(0)" class="btn-table btn-sm" data-table="project_table" data-id="' .
                $op->id .
                '" id="delete" data-bs-toggle="tooltip" data-bs-placement="right" title="Delete">' .
                '<i class="fa-solid fa-trash text-danger"></i></a></div></div>';
            $restore_action =
                '<a href="javascript:void(0)" class="btn btn-sm" data-table="employee_table" data-id="' .
                $op->id .
                '" id="restoreEmployee" data-bs-toggle="tooltip" data-bs-placement="right" title="Restore">' .
                '<i class="fa-solid fa-rotate-left test-warning"></i></a></div></div>';

            $delete_restore = ('N' == 'N') ? $delete_action : $restore_action;

            $actions = $div_action . $profile_action;

            ($user->can('employee.edit')) ? $actions = $actions . $update_action . $duplicate_action : $actions = $actions;
            ($user->can('employee.delete')) ? $actions = $actions . $delete_restore : $actions = $actions;

            $not_assigned_html = '<span class="badge text-black bg-light">Not assigned</span>';
            $assign_to = '<div class="avatar-group">';

            foreach ($op->employees as $key => $user) {
                if ($user->emp_files?->file_path) {
                    $assign_to = $assign_to . '<div class="avatar avatar-m ">
                        <a href="' . route('hr.admin.employee.profile', encrypt($user->id)) . '"
                            role="button" title="' . $user->full_name . '">
                            <img class="rounded-circle pull-up"
                                src="' . $user->emp_files->file_path . $user->emp_files->file_name . '"
                                alt="" />
                        </a>
                    </div>';
                } else {
                    $assign_to = $assign_to . '<div class="avatar avatar-m  me-1">
                        <a class="dropdown-toggle dropdown-caret-none d-inline-block"
                            href="' . route('hr.admin.employee.profile', encrypt($user->id)) . '"
                            role="button" title="' . $user->name . '">
                            <div class="avatar avatar-m  rounded-circle pull-up">
                                <div class="avatar-name rounded-circle me-2">
                                    <span>' . generateInitials($user->full_name) . '</span>
                                </div>
                            </div>
                        </a>
                    </div>';
                }
            }

            return [
                'id1' => '<div class="ms-3">' . $op->id . '</div>',
                'id' => $op->id,
                'project_id' => '<div class="d-flex align-items-center"><div><a class="fw-bold mb-0 line-clamp-3" href="/tracki/task/' . $op->project_id . '/list">' . $op->project?->name . '</a>',
                'name' => '<a class="fw-bold mb-0 line-clamp-3" id="taskCardView" href="javascript:void(0);"  data-id="' . $op->id . '" data-table="task_table">' . $op->name . '</a><div class="d-flex align-items-center">' .
                    '<p class="mb-0 text-body-highlight fw-semibold fs-10 me-2">' . $icons . '</p></div></div></div>',
                'workspace_id' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $op->workspaces?->title . '</div>',
                'department_assignment_id' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $op->department->name . '</div>',
                'assigned_by' => $op->assigned_by?->name,
                'assigned_to' => $assign_to,
                // 'assigned_to' => $op->employees,
                'start_date' =>  format_date($op->start_date,  'H:i:s'),
                'end_date' =>  '<span class="text-' . $due_date_text_color . '">' .  format_date($op->due_date,  'H:i:s') . '</spanc>',
                'budget' => $op->budget_allocation,
                'budget_consumed' => $op->actual_budget_allocated,
                'attributes' => (($op->notes->count()) ? '<button class="btn p-0 text-body-tertiary fs-10 me-2"><span class="fas fa-sticky-note me-1"></span>' . $op->notes->count() . '</button>' : "") .
                    (($op->files->count()) ? '<button class="btn p-0 text-body-tertiary fs-10 me-2"><span class="fas fa-paperclip me-1"></span>' . $op->files->count() . '</button>' : "") .
                    (($op->subtask->count()) ? '<button class="btn p-0 text-body-tertiary fs-10 me-2"><span class="fas fas fa-network-wired me-1"></span>' . $op->subtask->count() . '</button>' : ""),
                // 'attributes' => '<div class="ms-3 text-secondary">'.(($op->files->count()) ? '<span class="fas fa-file-alt me-1"></span>':"").' '.(($op->notes->count()) ? '<span class="fas fa-clipboard me-1"></span>':"").'</div>',
                // 'status' => '<select  class="form-select select2-with-image" id="statusSelect'.$op->id.'" data-id="'.$op->id.'" data-original-status-id="'.$op->status->id.'" data-type="task">'.$statusOptions.'</select>',
                'status' => '<span class="badge badge-phoenix fs--2 badge-phoenix-' . $op->status->color . ' " style="cursor: pointer;" id="editTaskStatus" data-id="' . $op->id . '" data-table="task_table"><span class="badge-label">' . $op->status->title . '</span><span class="ms-1 uil-edit-alt" style="height:12.8px;width:12.8px;cursor: pointer;"></span></span>',
                'description' => $op->description,
                // 'description' => '<button class="btn btn-secondary m-1" type="button" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Top Popover">Top Popover</button>',
                'actions' => $actions,
                'created_at' => format_date($op->created_at,  'H:i:s'),
                'updated_at' => format_date($op->updated_at, 'H:i:s'),
            ];
        });


        return response()->json([
            "rows" => $ops->items(),
            "total" => $total,
        ]);
    } //end empoloyeeList

    public function taskOverview($id)
    {
        // dd('taskOverview');
        $taskData = Task::where('id', $id);
        $taskData = $taskData->paginate(request('limit'))->through(function ($task) {
            return  [
                'id' => $task->id,
                'project_title' => $task->project->name,
                // 'project_name' => $task->project->name,
                'name' => $task->name,
                'department_name' => $task->department->name,
                'assigned_by' => $task->assigned_by?->name,
                'assigned_to' => $task->employees,
                'status_name' => $task->status->title,
                'status_color' => $task->status->color,
                'start_date' => format_date($task->start_date,  'H:i:s'),
                'due_date' => format_date($task->due_date,  'H:i:s'),
                'budget_allocation' => $task->budget_allocation,
                'actual_budget_allocated' => $task->actual_budget_allocated,
                'event_id' => $task->event_id,
                'notes' => $task->notes,
                'files' => $task->files,
                'subtasks' => $task->subtask,
                'workspace' => $task->workspaces->title,
                'attributes' => (($task->notes->count()) ? '<button class="btn p-0 text-body-tertiary fs-10 me-2"><span class="fas fa-sticky-note me-1"></span>' . $task->notes->count() . '</button>' : "") .
                    (($task->files->count()) ? '<button class="btn p-0 text-body-tertiary fs-10 me-2"><span class="fas fa-paperclip me-1"></span>' . $task->files->count() . '</button>' : ""),
                // 'attributes' => '<div class="ms-3 text-secondary">'.(($task->files->count()) ? '<span class="fas fa-file-alt me-1"></span>':"").' '.(($task->notes->count()) ? '<span class="fas fa-clipboard me-1"></span>':"").'</div>',
                'status' => '<span class="badge badge-phoenix fs--2 badge-phoenix-' . $task->status->color . ' "><span class="badge-label" data-bs-toggle="modal" data-bs-target="#taskStatusModal" id="editTaskStatus" data-id="' . $task->id . '" data-table="task_table">' . $task->status->title . '</span><span class="ms-1" data-feather="x" style="height:12.8px;width:12.8px;"></span></span>',
                'workspace_formated' => '<span class="badge badge-phoenix fs--2 badge-phoenix-warning"><span class="badge-label" data-bs-toggle="modal" data-bs-target="#taskStatusModal" id="editTaskStatus" data-id="' . $task->workspaces->id . '" data-table="task_table">' . $task->workspaces->title . '</span><span class="ms-1" data-feather="x" style="height:12.8px;width:12.8px;"></span></span>',
                'description' => $task->description,
                // 'description' => '<button class="btn btn-secondary m-1" type="button" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Top Popover">Top Popover</button>',
                'created_at' => format_date($task->created_at,  'H:i:s'),
                'updated_at' => format_date($task->updated_at, 'H:i:s'),
            ];
        });

        return response()->json(['data' => $taskData,]);
    } // taskOverview

    public function getTaskNotesView($id)
    {
        $task = Task::findOrFail($id);
        $view = view('/projects/admin/task/overview/notes', ['task' => $task])->render();
        return response()->json(['view' => $view]);
    } // getTaskNotesView

    public function getTaskSubView($id)
    {
        $task = Task::findOrFail($id);
        $view = view('/projects/admin/task/overview/subtask', ['task' => $task])->render();
        return response()->json(['view' => $view]);
    } // getTaskSubView

    public function getTaskFilesView($id)
    {
        $task = Task::findOrFail($id);
        $view = view('/projects/admin/task/overview/files', ['task' => $task])->render();
        return response()->json(['view' => $view]);
    }// end getTaskFilesView

    public function getTaskView($id)
    {
        $task = Task::with('employees')->findOrFail($id);
        $project = $task->project()->with('employees')->firstOrFail();
        $departments = Department::all();
        $employees = Employee::all();

        // dd($project);

        // Log::alert('EmployeeController::getEmpEditView file_name: ' . $emp->emp_files?->file_name);

        $view = view('/projects/admin/task/mv/edit', [
            'task' => $task,
            'project' => $project,
            'departments' => $departments,
            'employees' => $employees,
        ])->render();

        return response()->json(['view' => $view]);
    }  // end getTaskView

    public function getTask($id)
    {
        $task = Task::with('employees')->findOrFail($id);
        $project = $task->project()->with('employees')->firstOrFail();

        return response()->json(['task' => $task, 'project' => $project, 'asg' => $task->employees]);
    } // getTask
}
