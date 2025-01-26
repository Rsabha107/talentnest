<?php

namespace App\Http\Controllers\ProjectMgt\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UtilController;
use App\Models\Department;
use App\Models\Employee;
use App\Models\FunctionalArea;
use App\Models\Venue;
use App\Models\Project;
use App\Models\Status;
use App\Models\Tag;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    //
    protected $UtilController;

    public function __construct(UtilController $UtilController)
    {
        $this->UtilController = $UtilController;
    }

    public function index()
    {
        $projects = Project::all();
        // $eventData = Event::all();
        $users = User::all();
        $employees = Employee::all();
        $statuses = Status::all();
        $departments = Department::all();
        $functional_areas = FunctionalArea::all();
        $event_venue = Venue::all();
        $tags = Tag::all();

        return view('projects.admin.task.list', [
            'projects' => $projects,
            'users' => $users,
            'statuses' => $statuses,
            'departments' => $departments,
            // 'eventData' => $eventData,
            'employees' => $employees,
            'functional_areas' => $functional_areas,
            'event_venue' => $event_venue,
            'tags' => $tags,
        ]);
    } // End index

    public function list($id = null)
    {
        $workspace = session()->get('workspace_id');
        $user = User::findOrFail(auth()->user()->id);

        $user_department = auth()->user()->department_assignment_id;

        $search = request()->search;
        $sort = (request()->sort) ? request()->sort : "id";
        $order = (request()->order) ? request()->order : "DESC";
        $project_id = (request()->project_id) ? request()->project_id : "";
        $status_id = (request()->task_status_id) ? request()->task_status_id : "";
        $person_id = (request()->person_id) ? request()->person_id : "";
        $department_id = (request()->department_id) ? request()->department_id : "";

        if ($id) {
            $project = Project::find($id);
            $ops = $project->tasks()->orderBy($sort, $order);
        } else {
            $ops = Task::orderBy($sort, $order);
        }

        Log::alert(request()->all());
        // Log::info(request());
        // Log::info('request get: '.$request->get('project_id'));
        // Log::info('request(): '.request('project_id'));

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
                $query->where('department_assignment_id', '=', $department_id);
            });
        }

        if ($status_id) {
            $ops = $ops->where(function ($query) use ($status_id) {
                $query->where('status_id', 'like', '%' . $status_id . '%');
            });
        }


        if ($person_id) {
            // dd($person_id);
            // $employee = Employee::find($person_id);
            // $ops = $employee->tasks()->orderBy($sort, $order);

            $ops = $ops::with('employees', function ($query) use ($person_id) {
                $query->where('employee_id', $person_id);
            });

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
                '<a href="javascript:void(0)" class="btn btn-sm" id="taskCardView" data-id="' .
                $op->id .
                '" data-table="employee_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Employee Details">' .
                '<i class="fa-solid fa-lightbulb text-warning"></i></a>';
            $update_action =
                '<a href="javascript:void(0)" class="btn btn-sm" id="edit_task" data-id=' . $op->id .
                ' data-table="task_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Update">' .
                '<i class="fa-solid fa-pen-to-square text-primary"></i></a>';
            $duplicate_action =
                '<a href="javascript:void(0)" class="btn btn-sm" id="duplicate_employee" data-action="update" data-type="duplicate" data-id=' .
                $op->id .
                ' data-table="employee_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Duplicate">' .
                '<i class="fa-solid fa-copy text-success"></i></a>';
            $delete_action =
                '<a href="javascript:void(0)" class="btn btn-sm" data-table="task_table" data-id="' .
                $op->id .
                '" id="delete_task" data-bs-toggle="tooltip" data-bs-placement="right" title="Delete">' .
                '<i class="fa-solid fa-trash text-danger"></i></a></div></div>';
            $restore_action =
                '<a href="javascript:void(0)" class="btn btn-sm" data-table="employee_table" data-id="' .
                $op->id .
                '" id="restoreEmployee" data-bs-toggle="tooltip" data-bs-placement="right" title="Restore">' .
                '<i class="fa-solid fa-rotate-left test-warning"></i></a></div></div>';

            $delete_restore = ('N' == 'N') ? $delete_action : $restore_action;
            $details_url = route('projects.admin.project.d', $op->project_id);


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

            $assign_to = $assign_to .   '<div class="avatar avatar-m  me-1">
                                            <a class="dropdown-toggle dropdown-caret-none d-inline-block"
                                                href="javascript:void(0);" id="edit_task" data-table="task_table"
                                                data-id="' . $op->id . '" role="button" title="edit">
                                                <div class="avatar avatar-m  rounded-circle pull-up">
                                                    <div class="avatar-name rounded-circle me-2 text-warning"><span>+</span></div>
                                                </div>
                                            </a>
                                        </div>
                                        </div>';

            return [
                'id1' => '<div class="ms-3">' . $op->id . '</div>',
                'id' => $op->id,
                'project_id' => '<div class="d-flex align-items-center"><div><a class="fw-bold mb-0 line-clamp-3" href="' . $details_url . '">' . $op->project?->name . '</a>',
                'name' => '<a class="fw-bold mb-0 line-clamp-3" id="taskCardView" href="javascript:void(0);"  data-id="' . $op->id . '" data-table="task_table">' . $op->name . '</a><div class="d-flex align-items-center">' .
                    '<p class="mb-0 text-body-highlight fw-semibold fs-10 me-2">' . $icons . '</p></div></div></div>',
                // 'workspace_id' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $op->workspaces?->title . '</div>',
                'venue_id' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $op->venue?->name . '</div>',
                'functional_area_id' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $op->functional_area?->name . '</div>',
                'department_assignment_id' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $op->department?->name . '</div>',
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

    public function employeeList($id = null)
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

        // Log::alert(request()->all());
        // Log::info(request());
        // Log::info('request get: '.$request->get('project_id'));
        // Log::info('request(): '.request('project_id'));


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
                '<a href="javascript:void(0)" class="btn btn-sm" id="taskCardView" data-id="' .
                $op->id .
                '" data-table="employee_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Employee Details">' .
                '<i class="fa-solid fa-lightbulb text-warning"></i></a>';
            $update_action =
                '<a href="javascript:void(0)" class="btn btn-sm" id="edit_task" data-id=' . $op->id .
                ' data-table="task_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Update">' .
                '<i class="fa-solid fa-pen-to-square text-primary"></i></a>';
            $duplicate_action =
                '<a href="javascript:void(0)" class="btn btn-sm" id="duplicate_employee" data-action="update" data-type="duplicate" data-id=' .
                $op->id .
                ' data-table="employee_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Duplicate">' .
                '<i class="fa-solid fa-copy text-success"></i></a>';
            $delete_action =
                '<a href="javascript:void(0)" class="btn btn-sm" data-table="task_table" data-id="' .
                $op->id .
                '" id="delete_task" data-bs-toggle="tooltip" data-bs-placement="right" title="Delete">' .
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

            $assign_to = $assign_to .   '<div class="avatar avatar-m  me-1">
                                            <a class="dropdown-toggle dropdown-caret-none d-inline-block"
                                                href="javascript:void(0);" id="edit_project" data-table="task_table"
                                                data-id="' . $op->id . '" role="button" title="add">
                                                <div class="avatar avatar-m  rounded-circle pull-up">
                                                    <div class="avatar-name rounded-circle me-2 text-warning"><span>+</span></div>
                                                </div>
                                            </a>
                                        </div>
                                        </div>';

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
                // 'workspace' => $task->workspaces->title,
                'attributes' => (($task->notes->count()) ? '<button class="btn p-0 text-body-tertiary fs-10 me-2"><span class="fas fa-sticky-note me-1"></span>' . $task->notes->count() . '</button>' : "") .
                    (($task->files->count()) ? '<button class="btn p-0 text-body-tertiary fs-10 me-2"><span class="fas fa-paperclip me-1"></span>' . $task->files->count() . '</button>' : ""),
                // 'attributes' => '<div class="ms-3 text-secondary">'.(($task->files->count()) ? '<span class="fas fa-file-alt me-1"></span>':"").' '.(($task->notes->count()) ? '<span class="fas fa-clipboard me-1"></span>':"").'</div>',
                'status' => '<span class="badge badge-phoenix fs--2 badge-phoenix-' . $task->status->color . ' "><span class="badge-label" data-bs-toggle="modal" data-bs-target="#taskStatusModal" id="editTaskStatus" data-id="' . $task->id . '" data-table="task_table">' . $task->status->title . '</span><span class="ms-1" data-feather="x" style="height:12.8px;width:12.8px;"></span></span>',
                // 'workspace_formated' => '<span class="badge badge-phoenix fs--2 badge-phoenix-warning"><span class="badge-label" data-bs-toggle="modal" data-bs-target="#taskStatusModal" id="editTaskStatus" data-id="' . $task->workspaces->id . '" data-table="task_table">' . $task->workspaces->title . '</span><span class="ms-1" data-feather="x" style="height:12.8px;width:12.8px;"></span></span>',
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
    } // end getTaskFilesView

    public function getTaskView($id)
    {
        $task = Task::with('employees')->findOrFail($id);
        $project = $task->project()->with('employees')->firstOrFail();
        $departments = Department::all();
        $employees = Employee::all();
        $functional_areas = $project->functional_areas;
        $event_venue = $project->venues;
        $tags = $project->tags;

        // dd($project);

        // Log::alert('EmployeeController::getEmpEditView file_name: ' . $emp->emp_files?->file_name);

        $view = view('/projects/admin/task/mv/edit', [
            'task' => $task,
            'project' => $project,
            'departments' => $departments,
            'employees' => $employees,
            'functional_areas' => $functional_areas,
            'event_venue' => $event_venue,
            'tags' => $tags,
        ])->render();

        return response()->json(['view' => $view]);
    }  // end getTaskView

    public function getTask($id)
    {
        $task = Task::with('employees', 'tags')->findOrFail($id);
        $project = $task->project()->with('employees')->firstOrFail();

        return response()->json(['task' => $task, 'project' => $project, 'asg' => $task->employees]);
    } // getTask

    public function store(Request $request)
    { 
            // dd('createTask');

            // Log::info('taskStore');
            // Log::info($request);
            $user_id = Auth::user()->id;
            $task = new Task();
            $projects = Project::findOrFail($request->project_id);

            // $util = new UtilController;

            $task->name = $request->name;
            $task->start_date = Carbon::createFromFormat('d/m/Y', $request->start_date)->toDateString();
            // $task->start_time = $request->start_time;
            $task->due_date = Carbon::createFromFormat('d/m/Y', $request->due_date);
            // $task->due_date =  $request->end_time;
            $task->budget_allocation = $request->budget_allocation;
            $task->workspace_id = session()->get('workspace_id') ? session()->get('workspace_id') : $projects->workspace_id;
            $task->department_assignment_id = $request->department_assignment_id;
            $task->assignment_id = 10; //$request->assignment_id;
            $task->description = $request->description;
            $task->status_id = $request->status_id;
            $task->project_id = $request->project_id;
            $task->venue_id = $request->venue_id;
            $task->functional_area_id = $request->functional_area_id;
            $task->color_id = $request->color_id;
            $task->actual_budget_allocated = $request->actual_budget_allocated;
            $task->progress = $request->progress / 100;
            // $task->assignment_to_id = implode(',', $request->assignment_to_id);
            // $task->tag_id = implode(',', $request->tag_id);
            $task->created_by = $user_id;
            $task->updated_by = $user_id;
            $start_date_d = Carbon::createFromFormat('d/m/Y',  $request->start_date);
            $end_date_d = Carbon::createFromFormat('d/m/Y', $request->due_date);
            $duration =  $start_date_d->diffInDays($end_date_d, false);

            // Log::info('start_date_d: ' . $start_date_d . ' end_date_d: ' . $end_date_d . ' duration: ' . $duration);
            $completed_status = false;

            // Log::info('status_id: ' . $request->status_id . ' config completed: ' . config('tracki.task_status.completed') . ' completed_status: ' . $completed_status);

            // dd($duration);
            $task->duration = $duration;

            // Log::info('task request stored: ' . $task->status->title);


            if ($task->status->title == 'Completed') {
                $task->progress = 1;
                $completed_status = true;
            }

            if (config('tracki.show_task_progress')) {
                if (!$completed_status) {
                    if ($request->progress >= 100) {
                        $task->status_id = config('tracki.task_status.completed');
                    } elseif ($request->progress == 0) {
                        $task->status_id = config('tracki.task_status.active');
                    } else {
                        $task->status_id = config('tracki.task_status.inprogress');
                    }
                }
            }

            $task->save();
            
            // Log::info('TaskController::taskStore task count: ' . $projects->tasks->count());
            // Log::info('TaskController::taskStore sum progress: ' . $projects->tasks->sum('progress'));

            foreach ($request->assignment_to_id as $key => $data) {

                $task->employees()->attach($request->assignment_to_id[$key]);
            }

            foreach ($request->tag_id as $key => $data) {

                $task->tags()->attach($request->tag_id[$key]);
            }


            $util_controller = new UtilController;
            $update_project_status = $util_controller->updateProjectStatus($request->event_id);

            $details = [
                'subject' => 'Tracki Notification Center. New task assignment',
                'greeting' => 'Hi ' . $task->assigned_to_name . ',',
                'body' => 'task "' . $task->name . '" has been assigned to you and ready for some action. chop chop start churning',
                'startdate' => 'Start Date: ' . \Carbon\Carbon::parse($task->start_date)->format('d-M-Y'),
                'duedate' => 'Due by: ' . \Carbon\Carbon::parse($task->due_date)->format('d-M-Y'),
                'description' => $task->description,
                'actiontext' => 'Go to Tracki',
                'actionurl' => '/',
                'lastline' => 'Please check the task online for any notes or attachments',
            ];

            // if (config('tracki.send_task_assignment_emails')) {
            //     // Log::info('assignment to id: ' . $task->assignment_to_id);
            //     $emails = $this->UtilController->getAssignedToEmail($task->assignment_to_id);
            //     Notification::route('mail', $emails)->notify(new AnnouncementCenter($details));
            // }



            // if (config('tracki.send_task_assignment_emails')) {
            //     $emails = $this->getAssignedToName($task->assignment_to_id);
            //     $response = $this->SendMailController->sendTaskAssignmentEmail($task, $emails);
            // }

            $notification = array(
                'message'       => 'Event created successfully',
                'alert-type'    => 'success'
            );

            return response()->json([
                'error' => false,
                'message' => 'task added successfully to project ' . $task->project->name . '.',
                'user_name' => auth()->user()->username, //$data->users->username,
                // 'note_text' => $data->note_text,
                // 'note_date' => format_date($data->created_at,  'H:i:s'),
                'id' => $task->id
            ]);

            // Toastr::success('Has been add successfully :)','Success');
            // return Redirect::route('tracki.task.list', $request->event_id)->with($notification);
    }  // end store

    public function updateTask(Request $request)
    {
        // Log::info('TaskController::updateTask');
        // Log::info('request id: ' . $request->id);

        $user_id = Auth::user()->id;

        $task = Task::findOrFail($request->id);
        // $util = new UtilController;

        // Log::info($request);
        $task->name = $request->name;
        // Log::info('after name');
        $task->start_date = Carbon::createFromFormat('d/m/Y', $request->start_date);
        // $task->start_time = $request->start_time;
        $task->due_date = Carbon::createFromFormat('d/m/Y', $request->due_date);
        // $task->due_date =  $request->end_time;
        $task->budget_allocation = $request->budget_allocation;
        $task->actual_budget_allocated = $request->actual_budget_allocated;
        $task->department_assignment_id = $request->department_assignment_id;
        $task->assignment_id = $request->assignment_id;
        $task->description = $request->description;
        $task->status_id = $request->status_id;
        // $task->event_id = $request->event_id;
        $task->color_id = $request->color_id;
        // $task->event_id = $request->project_id;
        $task->progress = 0; //$request->progress / 100;
        // $task->assignment_to_id = implode(',', $request->assignment_to_id);
        $task->updated_by = $user_id;

        $start_date_d = Carbon::createFromFormat('d/m/Y', $request->start_date);
        $end_date_d = Carbon::createFromFormat('d/m/Y', $request->due_date);
        $duration =  $start_date_d->diffInDays($end_date_d, false);

        // Log::info('start_date_d: ' . $start_date_d . ' end_date_d: ' . $end_date_d . ' duration: ' . $duration);

        // dd($duration);
        $completed_status = false;

        // Log::debug('status_id: ' . $request->status_id . ' config completed: ' . config('tracki.task_status.completed') . ' completed_status: ' . $completed_status);

        // dd($duration);
        $task->duration = $duration;

        if ($request->status_id == config('tracki.task_status.completed')) {
            $task->progress = 1;
            $task->status_id = config('tracki.task_status.completed');
            $completed_status = true;
        }

        if (config('tracki.show_task_progress')) {
            if (!$completed_status) {
                Log::info('insided is completed status is true');
                if ($request->progress >= 100) {
                    $task->status_id = config('tracki.task_status.completed');
                } elseif ($request->progress == 0) {
                    $task->status_id = config('tracki.task_status.active');
                } else {
                    $task->status_id = config('tracki.task_status.inprogress');
                }
            }
        }



        $task->duration = $duration;

        // Log::debug('status_id: ' . $request->status_id . ' task->progress: ' . $task->progress . ' completed_status: ' . $completed_status);

        $task->save();

        // Log::debug('duration: ' . $duration);

        $util_controller = new UtilController;
        $update_project_status = $util_controller->updateProjectStatus($request->project_id);


        $task->employees()->detach();

        foreach ($request->assignment_to_id as $key => $data) {

            $task->employees()->attach($request->assignment_to_id[$key]);
        }

        $task->tags()->detach();

        foreach ($request->tag_id as $key => $data) {

            $task->tags()->attach($request->tag_id[$key]);
        }


        $notification = array(
            'message'       => 'Task updated successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return response()->json([
            'error' => false,
            'message' => 'Task ' . $task->name . ' Task updated successfully ',
        ]);
        // return Redirect::route('tracki.task.list', $request->event_id)->with($notification);
    } // updateTask

    public function editTaskStatus($id)
    {
        //  dd('editTaskProgress');
        $data = Task::find($id);
        //dd($data);
        $data_arr = [];

        $data_arr[] = [
            "id"        => $data->id,
            "event_id"  => $data->event_id,
            "status_id"  => $data->status_id,
        ];

        $response = ["retData"  => $data_arr];
        return response()->json($response);
    } // editTaskStatus

    public function updateTaskStatus(Request $request)
    {

        $task = Task::findOrFail($request->id);
        $status_title = Status::findOrFail($request->status_id);

        // Log::info($status_title->title);
        if (($status_title->title == 'Completed') || ($status_title->title == 'Suspended')) {
            $task->update([
                'status_id' => $request->status_id,
                'progress' => 1
            ]);
        } else {
            $task->update([
                'status_id' => $request->status_id,
                'progress' => 0
            ]);
        }

        $util_controller = new UtilController;
        $update_project_status = $util_controller->updateProjectStatus($request->event_id);

        $notification = array(
            'message'       => 'Task status updated successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => false, 'message' => 'Task Status updated successfully.', 'id' => $task->id]);

        // Toastr::success('Has been add successfully :)','Success');
        // return redirect()->back()->with($notification);
        // deleteEvent
    } //updateTaskStatus

    public function destroy($id)
    {
        Task::where('id', '=', $id)->delete();
        return response()->json([
            'error' => false,
            'message' => 'Task deleted successfully',
        ]); // deleteEvent
    } // destroy

}
