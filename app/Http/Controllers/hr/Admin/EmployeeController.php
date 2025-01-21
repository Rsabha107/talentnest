<?php

namespace App\Http\Controllers\hr\Admin;
use App\Http\Controllers\Controller;

use App\Mail\SendForgotPasswordMail;
use App\Mail\SendWelcomeMail;
use App\Models\AddressType;
use App\Models\AreaCodes;
use App\Models\Atest;
use App\Models\Audience;
use App\Models\BudgetName;
use App\Models\Client;
use App\Models\Country;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\EmployeeAddress;
use App\Models\EmployeeAttachment;
use App\Models\EmployeeBank;
use App\Models\EmployeeContractType;
use App\Models\EmployeeDirectorate;
use App\Models\EmployeeEmergencyContact;
use App\Models\EmployeeEntity;
use App\Models\EmployeeFile;
use App\Models\EmployeeJobLevel;
use App\Models\EmployeeLeave;
use App\Models\EmployeeLeaveAttachment;
use App\Models\EmployeeLeaveStatus;
use App\Models\EmployeeLeaveType;
use App\Models\EmployeeRelationship;
use App\Models\EmployeeSalary;
use App\Models\EmployeeSponsorship;
use App\Models\EmployeeTimeSheet;
use App\Models\EmployeeType;
use App\Models\EventAudience;
use App\Models\EventCategory;
use App\Models\EventLocation;
use App\Models\FunctionalArea;
use App\Models\Gender;
use App\Models\Language;
use App\Models\Location;
use App\Models\MaritalStatus;
use App\Models\MonthsNames;
use App\Models\Nationality;
use App\Models\PayrollPeriod;
use App\Models\ProjectType;
use App\Models\RecordStatus;
use App\Models\Relationship;
use App\Models\Salutation;
use App\Models\Status;
use App\Models\Tag;
use App\Models\User;
use App\Models\Venue;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Route as FacadesRoute;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\Datatables;

class EmployeeController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $emps = Employee::all();
        $countries = Country::all();
        $nationalities = Nationality::all();
        $employee_types = EmployeeType::all();
        $salutations = Salutation::all();
        $genders = Gender::all();
        $marital_statuses = MaritalStatus::all();
        $departments = Department::all();
        $designations = Designation::all();
        $address_types = AddressType::all();
        $directorate = EmployeeDirectorate::all();
        $functional = FunctionalArea::all();
        $job_levels = EmployeeJobLevel::all();
        $entities = EmployeeEntity::all();
        $contract_types = EmployeeContractType::all();
        $relationships = EmployeeRelationship::all();
        $sponsorships = EmployeeSponsorship::all();
        $record_statuses = RecordStatus::all();
        $payroll_cycles = PayrollPeriod::all();

        return view('hr.admin.employee.list', compact(
            'emps',
            'countries',
            'nationalities',
            'employee_types',
            'salutations',
            'genders',
            'marital_statuses',
            'departments',
            'designations',
            'relationships',
            'address_types',
            'directorate',
            'functional',
            'job_levels',
            'entities',
            'contract_types',
            'relationships',
            'sponsorships',
            'record_statuses',
            'payroll_cycles',
        ));
    }

    // return the edit employee view
    public function getEmpEditView($id)
    {

        $emps = Employee::all();  // used for managers
        $emp = Employee::findOrFail($id);
        $countries = Country::all();
        $nationalities = Nationality::all();
        $employee_types = EmployeeType::all();
        $salutations = Salutation::all();
        $genders = Gender::all();
        $marital_statuses = MaritalStatus::all();
        $languages = Language::all();
        $departments = Department::all();
        $designations = Designation::all();

        $directorate = EmployeeDirectorate::all();
        $functional = FunctionalArea::all();
        $job_levels = EmployeeJobLevel::all();
        $entities = EmployeeEntity::all();
        $contract_types = EmployeeContractType::all();
        $relationships = EmployeeRelationship::all();
        $sponsorships = EmployeeSponsorship::all();

        // Log::alert('EmployeeController::getEmpEditView file_name: ' . $emp->emp_files?->file_name);

        $view = view('/hr/admin/employee/mv/edit', [
            'emp' => $emp,
            'emps' => $emps,
            'countries' => $countries,
            'nationalities' => $nationalities,
            'employee_types' => $employee_types,
            'salutations' => $salutations,
            'genders' => $genders,
            'marital_statuses' => $marital_statuses,
            'languages' => $languages,
            'departments' => $departments,
            'designations' => $designations,
            'relationships' => $relationships,
            'directorate' => $directorate,
            'functional' => $functional,
            'job_levels' => $job_levels,
            'entities' => $entities,
            'contract_types' => $contract_types,
            'sponsorships' => $sponsorships,
        ])->render();

        return response()->json(['view' => $view]);
    }

    // return the duplicate employee view
    public function duplicate_employee_view($id)
    {

        $emps = Employee::all();  // used for managers
        $emp = Employee::findOrFail($id);
        $countries = Country::all();
        $nationalities = Nationality::all();
        $employee_types = EmployeeType::all();
        $salutations = Salutation::all();
        $genders = Gender::all();
        $marital_statuses = MaritalStatus::all();
        $languages = Language::all();
        $departments = Department::all();
        $designations = Designation::all();

        $directorate = EmployeeDirectorate::all();
        $functional = FunctionalArea::all();
        $job_levels = EmployeeJobLevel::all();
        $entities = EmployeeEntity::all();
        $contract_types = EmployeeContractType::all();
        $relationships = EmployeeRelationship::all();
        $sponsorships = EmployeeSponsorship::all();

        // Log::alert('EmployeeController::getEmpEditView file_name: ' . $emp->emp_files?->file_name);

        $view = view('/hr/admin/employee/mv/duplicate', [
            'emp' => $emp,
            'emps' => $emps,
            'countries' => $countries,
            'nationalities' => $nationalities,
            'employee_types' => $employee_types,
            'salutations' => $salutations,
            'genders' => $genders,
            'marital_statuses' => $marital_statuses,
            'languages' => $languages,
            'departments' => $departments,
            'designations' => $designations,
            'relationships' => $relationships,
            'directorate' => $directorate,
            'functional' => $functional,
            'job_levels' => $job_levels,
            'entities' => $entities,
            'contract_types' => $contract_types,
            'sponsorships' => $sponsorships,
        ])->render();

        return response()->json(['view' => $view]);
    }


    public function create()
    {
        //
        $emps = Employee::all();
        $countries = Country::all();
        $nationalities = Nationality::all();
        $employee_types = EmployeeType::all();
        $salutations = Salutation::all();
        $genders = Gender::all();
        $marital_statuses = MaritalStatus::all();
        $departments = Department::all();
        $designations = Designation::all();

        return view('tracki.employee.create', compact(
            'emps',
            'countries',
            'nationalities',
            'employee_types',
            'salutations',
            'genders',
            'marital_statuses',
            'departments',
            'designations',
        ));
    }

    /**
     * add a new resource.
     */
    public function add()
    {
        //
        return view('tracki.employee.add');
    }

    /**
     * Show the form for creating a new resource.
     */

    // public function ateststore(Request $request)
    // {

    //     $op = new Atest();

    //     Log::alert($request->all());
    //     Log::alert($request->first_name);

    //     $op->first_name = $request->first_name;
    //     $op->last_name = $request->last_name;
    //     $op->address = $request->address;

    //     $op->save();

    //     $error = false;
    //     $message = 'Employee created .' . $op->id;

    //     return response()->json(['error' => $error, 'message' => $message]);
    // }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $id = Auth::user()->id;
        $op = new Employee();
        $data = new EmployeeFile();

        $rules = [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'work_email_address' => ['required', 'unique:employees_all'],
            'national_identifier_number' => 'required|unique:employees_all|min:11|max:11',
            'profile_image_name' => 'mimes:jpeg,png,jpg,gif,bmp|max:5120',
            'first_name' => [Rule::unique('employees_all', 'first_name')->where('last_name', $request->last_name)],
        ];
        
        $messages = [
            'first_name.unique' => 'first and last name already exists.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        // dd($validator);

        // Log::info($request->all());

        if ($validator->fails()) {
            // Log::info($validator->errors());
            $error = true;
            // $message = 'Employee not create.' . $op->id;
            $message = implode($validator->errors()->all('<div>:message</div>'));
        } else {

            $error = false;
            $message = 'Employee created .' . $op->id;

            $op->employee_number = 'ABC' . $op->id;
            $op->user_id = $id;
            $op->national_identifier_number = $request->national_identifier_number;
            $op->passport_number = $request->passport_number;
            $op->salutation = $request->salutation;
            $op->first_name = $request->first_name;
            $op->middle_name = $request->middle_name;
            $op->last_name = $request->last_name;
            $op->full_name = $request->first_name . ' ' . $request->last_name;
            $op->gender_id  = $request->gender_id;
            $op->marital_status_id = $request->marital_status_id;
            $op->employee_type = $request->employee_type;
            $op->date_of_birth = Carbon::createFromFormat('d/m/Y', $request->date_of_birth)->toDateString();
            // $op->date_of_hire = Carbon::createFromFormat('d/m/Y', $request->date_of_hire);
            // $op->join_date = Carbon::createFromFormat('d/m/Y', $request->join_date);
            $op->town_of_birth = $request->town_of_birth;
            $op->country_of_birth = $request->country_of_birth;
            $op->personal_email_address = $request->personal_email_address;
            $op->work_email_address = $request->work_email_address;
            $op->phone_area_code = $request->phone_area_code;
            $op->manager_flag = $request->manager_flag;
            $op->phone_number = $request->phone_number;
            $op->alt_phone_number = $request->alt_phone_number;
            $op->alt_area_code = $request->alt_area_code;
            $op->nationality = $request->nationality_id;
            $op->reporting_to_id = intval($request->reporting_to_id);
            $op->department_id = $request->department_id;
            $op->designation_id = $request->designation_id;

            $op->contract_start_date = Carbon::createFromFormat('d/m/Y', $request->contract_start_date)->toDateString();
            $op->contract_end_date = Carbon::createFromFormat('d/m/Y', $request->contract_end_date)->toDateString();

            $op->civil_id_expiry = Carbon::createFromFormat('d/m/Y', $request->civil_id_expiry)->toDateString();
            $op->passport_expiry = Carbon::createFromFormat('d/m/Y', $request->passport_expiry)->toDateString();

            $op->directorate_id = $request->directorate_id;
            $op->entity_id = $request->entity_id;
            $op->job_level_id = $request->job_level_id;
            $op->contract_type_id = $request->contract_type_id;
            $op->functional_area_id = $request->functional_area_id;
            $op->sponsorship_id = $request->sponsorship_id;
            $op->sponsorship_name = $request->sponsorship_name;

            // $op->language = $request->language;

            $op->save();

            if ($request->file('profile_image_name')) {
                $file = $request->file('profile_image_name');
                $filename = rand() . date('ymdHis') . $file->getClientOriginalName();
                $file->move(public_path('storage/upload/profile_images'), $filename);
                $data->file_name = $filename;
                $data->original_file_name = $file->getClientOriginalName();
                $data->file_extension = $file->getClientOriginalExtension();
                $data->file_size = $_FILES['profile_image_name']['size']; //$request->file('profile_image_name')->getSize();
                $data->file_path = '/storage/upload/profile_images/';
                $data->user_id = $id;
                $data->employee_id = $op->id;

                $data->save();
            }
            // Log::info('EmployeeController::store $op->id: '.$op->id);

            // dd($op->number);
            // after saving the employee lets create a default user.
            $isUser = User::where('email', $op->work_email_address)->first();

            if (!$isUser) {
                $user = new User();

                $user->username = substr($op->work_email_address, 0, strrpos($op->work_email_address, '@'));
                $user->name = $op->full_name;
                $user->email = $op->work_email_address;
                $user->employee_id = $op->id;
                $user->phone = $op->phone_area_code . $op->phone_number;
                // $user->address = $request->address;
                $user->password = Hash::make($request->national_identifier_number);
                $user->department_assignment_id = $op->department_id;
                $user->functional_area_id = $op->functional_area_id;
                $user->workspace_id = $request->workspace_id;
                $user->usertype = 'user';
                $user->role = 'user';
                $user->status = '0';
                $user->address = 'doha';
                $user->assignRole(6);

                $user->save();
                // send a welcome email with instruction to log in

                $content = [
                    'subject'   => 'Welcome to Talent Nest',
                    'name'      => $user->name,
                    'body'      => 'Welcome to the [Company Name] community! We’re thrilled to have you onboard.',
                    'user_name' => $user->email,
                    'url'       => route('employee'),
                ];
        
                Mail::to($user->email)->queue(new SendWelcomeMail($content));
            }
        }

        return response()->json(['error' => $error, 'message' => $message]);
    }

    public function list()
    {
        $user = User::findOrFail(auth()->user()->id);

        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";
        $employees = Employee::orderBy($sort, $order);

        $functional_area = (request()->functional_area) ? request()->functional_area : "";
        $department = (request()->department) ? request()->department : "";
        $entity = (request()->entity) ? request()->entity : "";
        $directorate = (request()->directorate) ? request()->directorate : "";
        $active_archived = (request()->active_archived) ? request()->active_archived : "";

        // dd(request()->all());

        if ($search) {
            $employees = $employees->where(function ($query) use ($search) {
                $query->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('work_email_address', 'like', '%' . $search . '%')
                    ->orWhere('employee_number', 'like', '%' . $search . '%');
            });
        }

        if ($functional_area) {
            $employees = $employees->where(function ($query) use ($functional_area) {
                $query->where('functional_area_id', 'like', '%' . $functional_area . '%');
            });
        }

        if ($department) {
            $employees = $employees->where(function ($query) use ($department) {
                $query->where('department_id', 'like', '%' . $department . '%');
            });
        }

        if ($directorate) {
            $employees = $employees->where(function ($query) use ($directorate) {
                $query->where('directorate_id', 'like', '%' . $directorate . '%');
            });
        }

        if ($entity) {
            $employees = $employees->where(function ($query) use ($entity) {
                $query->where('entity_id', 'like', '%' . $entity . '%');
            });
        }

        if ($entity) {
            $employees = $employees->where(function ($query) use ($entity) {
                $query->where('entity_id', 'like', '%' . $entity . '%');
            });
        }

        if ($active_archived) {
            $employees = $employees->where(function ($query) use ($active_archived) {
                $query->where('archived', 'like', '%' . $active_archived . '%');
            });
        }


        $employees = $employees->where('administrator_flag', 'N');

        $total = $employees->count();

        $employees = $employees->paginate(request("limit"))->through(function ($employee) use ($user) {

            $full_name = $employee->first_name . ' ' . $employee->last_name;

            /* returns null if it does not exist */
            // $salary = EmployeeSalary::when($employee->id, function ($query, $sal) {
            //     return $query->where('employee_salary.employee_id', $sal);
            // })->first();

            $salary = EmployeeSalary::where('employee_id', $employee->id)->first();
            // dd($salary);

            if ($employee->manager_flag == 'Y') {
                $avatar_status = 'status-away';
            } else {
                $avatar_status = '';
            }

            if ($employee->emp_files?->file_path) {
                $image = ' <div class="avatar avatar-m ' . $avatar_status . '">
                                <a  href="#" role="button" title="' . $full_name . '">
                                    <img class="rounded-circle pull-up" src="' . $employee->emp_files->file_path . $employee->emp_files->file_name . '" alt="" />
                                </a>
                            </div>';
            } else {
                $image = '  <div class="avatar avatar-m ' . $avatar_status . '  me-1" id="project_team_members_init">
                                <a class="dropdown-toggle dropdown-caret-none d-inline-block" href="#" role="button" title="' . $full_name . '">
                                    <div class="avatar avatar-m  rounded-circle pull-up">
                                        <div class="avatar-name rounded-circle me-2"><span>' . generateInitials($full_name) . '</span></div>
                                    </div>
                                </a>
                            </div>';
            }

            $div_action = '<div class="font-sans-serif btn-reveal-trigger position-static">';
            $profile_action =
                '<a href="' . route("hr.admin.employee.profile", encrypt($employee->id)) . '" class="btn-table btn-sm" id="employeeCardView" data-id="' .
                $employee->id .
                '" data-table="employee_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Employee Details">' .
                '<i class="fa-solid far fa-lightbulb text-warning"></i></a>';
            $update_action =
                '<a href="javascript:void(0)" class="btn btn-sm" id="edit_employee" data-action="update" data-type="edit" data-id=' .
                $employee->id .
                ' data-table="employee_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Update">' .
                '<i class="fa-solid fa-pen-to-square text-primary"></i></a>';
            $duplicate_action =
                '<a href="javascript:void(0)" class="btn btn-sm" id="duplicate_employee" data-action="update" data-type="duplicate" data-id=' .
                $employee->id .
                ' data-table="employee_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Duplicate">' .
                '<i class="fa-solid fa-copy text-success"></i></a>';
            $delete_action =
                '<a href="javascript:void(0)" class="btn btn-sm" data-table="employee_table" data-id="' .
                $employee->id .
                '" id="deleteEmployee" data-bs-toggle="tooltip" data-bs-placement="right" title="Delete">' .
                '<i class="fa-solid fa-trash text-danger"></i></a></div></div>';
            $restore_action =
                '<a href="javascript:void(0)" class="btn btn-sm" data-table="employee_table" data-id="' .
                $employee->id .
                '" id="restoreEmployee" data-bs-toggle="tooltip" data-bs-placement="right" title="Restore">' .
                '<i class="fa-solid fa-rotate-left test-warning"></i></a></div></div>';

            $delete_restore = ($employee->archived == 'N') ? $delete_action : $restore_action;

            $actions = $div_action . $profile_action;

            ($user->can('employee.edit')) ? $actions = $actions . $update_action . $duplicate_action : $actions = $actions;
            ($user->can('employee.delete')) ? $actions = $actions . $delete_restore : $actions = $actions;


            $profile_url = route('hr.admin.employee.profile', encrypt($employee->id));
            $name_color = ($employee->archived == "Y") ? "text-danger" : "";

            return [
                'id1' => '<div class="ms-3">' . $employee->id . '</div>',
                'id' => $employee->id,
                'image' => $image,
                'employee_number' => '<div class="align-middle white-space-wrap fw-bold fs-9"><a href="' . $profile_url . '">' . $employee->employee_number . '</a></div>',
                // 'employee_type' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->employee_types->title . '</div>',
                'reporting_to_id' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->managers?->full_name . '</div>',
                'gender_id' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->genders->title . '</div>',
                'full_name' => '<div class="align-middle white-space-wrap fw-bold fs-9 ' . $name_color . '">' . $employee->full_name . '</div>',
                'entity_id' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->entities?->title . '</div>',
                'contract_start_date' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . format_date($employee->contract_start_date) . '</div>',
                'contract_end_date' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . format_date($employee->contract_end_date) . '</div>',
                'work_email_address' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->work_email_address . '</div>',
                'salary' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->salaries?->net_salary . '</div>',
                'actions' => $actions,

                'sponsorship_id' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->sponsorships->title . '</div>',
                'sponsorship_name' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->sponsorship_name . '</div>',

                'first_name' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->first_name . '</div>',
                'middle_name' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->middle_name . '</div>',
                'last_name' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->last_name . '</div>',
                'personal_email_address' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->personal_email_address . '</div>',
                'salutation' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->salutations?->title . '</div>',
                'national_identifier_number' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->national_identifier_number . '</div>',
                'civil_id_expiry' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . format_date($employee->civil_id_expiry) . '</div>',
                'passport_number' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->passport_number . '</div>',
                'passport_expiry' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . format_date($employee->passport_expiry) . '</div>',
                'designation_id' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->designation->name . '</div>',
                'job_level_id' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->job_levels?->title . '</div>',
                'phone_number' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->phone_number . '</div>',
                'alt_phone_number' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->alt_phone_number . '</div>',
                'phone_area_code' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->phone_area_code . '</div>',
                'alt_area_code' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->alt_area_code . '</div>',
                'directorate_id' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->directorate?->title . '</div>',
                'department_id' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->departments?->name . '</div>',
                'functional_area_id' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->functional_areas?->name . '</div>',
                'marital_status_id' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->marital_status?->title . '</div>',
                'date_of_birth' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . format_date($employee->date_of_birth) . '</div>',
                'country_of_birth' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->countries?->country_name . '</div>',
                'nationality' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->nationalities?->nationality . '</div>',
                'countract_type_id' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->contract_types?->title . '</div>',
                'manager_flag' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->manager_flag . '</div>',
                'user_name' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->user?->email . '</div>',
                'created_at' => format_date($employee->created_at,  'H:i:s'),
                'updated_at' => format_date($employee->updated_at, 'H:i:s'),
            ];
        });

        return response()->json([
            "rows" => $employees->items(),
            "total" => $total,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function profile($id)
    {

        $user = User::find(Auth::user()->id);
        if ($user->hasAnyRole(['SuperAdmin', 'HRMSADMIN' ])) {
        $id = decrypt($id);
        } else {
            $id=$user->employee_id;
        }
        // dd($id);
        $employee_data = Employee::findOrFail($id);
        $total_leave_taken = EmployeeLeave::where('employee_id', $id)->sum('number_of_days');
        $countries = Country::all();
        $address_types = AddressType::all();
        $employee_emergencies = EmployeeEmergencyContact::all();
        $employee_banks = EmployeeBank::all();
        // $employee_salaries = $emp->salaries();

        // for projects
        $employees = Employee::all();
        $tags = Tag::all();
        $project_type = ProjectType::all();
        $event_category = EventCategory::all();
        $event_audience = EventAudience::all();
        $clients = Client::all();
        $event_venue = Venue::all();
        $event_location = EventLocation::all();
        $fund_category = EventLocation::all();
        $budget_name = BudgetName::all();
        $relationships = EmployeeRelationship::all();
        $employee_leave_types = EmployeeLeaveType::all();
        $employee_leave_statuses = EmployeeLeaveStatus::all();
        $files = $employee_data->attachments;
        $payroll_cycles = PayrollPeriod::all();

        $months_name = MonthsNames::orderBy('month_order', 'ASC')->get();

        if ($employee_data->emp_files?->file_path) {
            $image = ' <div class="avatar avatar-4xl ">
                            <a  href="#" role="button" title="' . $employee_data->full_name . '">
                                <img class="rounded-circle pull-up" src="' . $employee_data->emp_files->file_path . $employee_data->emp_files->file_name . '" alt="" />
                            </a>
                        </div>';
        } else {
            $image = '  <div class="avatar avatar-4xl  me-1" id="project_team_members_init">
                            <a class="dropdown-toggle dropdown-caret-none d-inline-block" href="#" role="button" title="' . $employee_data->full_name . '">
                                <div class="avatar avatar-4xl  rounded-circle pull-up">
                                    <div class="avatar-name rounded-circle me-2"><span>' . generateInitials($employee_data->full_name) . '</span></div>
                                </div>
                            </a>
                        </div>';
        }

        return view('hr.admin.employee.profile', compact(
            'employee_data',
            'countries',
            'employees',
            'tags',
            'project_type',
            'event_category',
            'event_audience',
            'clients',
            'event_venue',
            'event_location',
            'fund_category',
            'budget_name',
            'address_types',
            // 'employee_emergencies',
            'employee_banks',
            // 'employee_salaries',
            'relationships',
            // 'employee_leaves',
            'employee_leave_types',
            'employee_leave_statuses',
            // 'employee_timesheets',
            'months_name',
            'files',
            'total_leave_taken',
            'payroll_cycles',
            'image'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        // Log::alert('EmployeeController::update');
        // Log::alert(request()->all());
        $id = Auth::user()->id;
        $user = User::where('employee_id', $request->id)->first();
        $op = Employee::findOrFail($request->id);
        $data = EmployeeFile::where('employee_id', $request->id)->first();

        if (!$data) {
            // Log::info('inside data not defined.  new employeefile');
            $data = new EmployeeFile;
        }

        $rules = [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'work_email_address' => 'required|unique:employees_all,work_email_address,' . $op->id,
            'national_identifier_number' => 'required|unique:employees_all,national_identifier_number,' . $op->id . '|min:11|max:11',
            'profile_image_name' => 'mimes:jpeg,png,jpg,gif,bmp|max:5120',
            // 'first_name' => [Rule::unique('employees_all', 'first_name')->where('last_name', $request->last_name)],
        ];
        $messages = [
            'first_name.unique' => 'first and last name already exists.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        // dd($validator);

        // Log::info($request->all());

        if ($validator->fails()) {
            // Log::info($validator->errors());
            $error = true;
            // $message = 'Employee not create.' . $op->id;
            $message = implode($validator->errors()->all('<div>:message</div>'));
        } else {

            $error = false;
            $message = 'Employee Updated .' . $op->id;

            // $op->employee_number = 'ABC' . $op->id;
            $op->national_identifier_number = $request->national_identifier_number;
            $op->passport_number = $request->passport_number;
            $op->salutation = $request->salutation;
            $op->first_name = $request->first_name;
            $op->middle_name = $request->middle_name;
            $op->last_name = $request->last_name;
            $op->full_name = $request->first_name . ' ' . $request->last_name;
            $op->gender_id  = $request->gender_id;
            $op->marital_status_id = $request->marital_status_id;
            $op->employee_type = $request->employee_type;
            $op->manager_flag = $request->manager_flag;
            $op->date_of_birth = Carbon::createFromFormat('d/m/Y', $request->date_of_birth)->toDateString();
            // $op->date_of_hire = Carbon::createFromFormat('d/m/Y', $request->date_of_hire);
            // $op->join_date = Carbon::createFromFormat('d/m/Y', $request->join_date);
            $op->town_of_birth = $request->town_of_birth;
            $op->country_of_birth = $request->country_of_birth;
            $op->personal_email_address = $request->personal_email_address;
            $op->work_email_address = $request->work_email_address;
            $op->phone_number = $request->phone_number;
            $op->phone_area_code = $request->phone_area_code;
            $op->alt_phone_number = $request->alt_phone_number;
            $op->alt_area_code = $request->alt_area_code;
            $op->nationality = $request->nationality_id;
            $op->reporting_to_id = intval($request->reporting_to_id);
            $op->department_id = $request->department_id;
            $op->designation_id = $request->designation_id;

            $op->contract_start_date = Carbon::createFromFormat('d/m/Y', $request->contract_start_date)->toDateString();
            $op->contract_end_date = Carbon::createFromFormat('d/m/Y', $request->contract_end_date)->toDateString();

            $op->civil_id_expiry = Carbon::createFromFormat('d/m/Y', $request->civil_id_expiry)->toDateString();
            $op->passport_expiry = Carbon::createFromFormat('d/m/Y', $request->passport_expiry)->toDateString();

            $op->directorate_id = $request->directorate_id;
            $op->entity_id = $request->entity_id;
            $op->job_level_id = $request->job_level_id;
            $op->contract_type_id = $request->contract_type_id;
            $op->functional_area_id = $request->functional_area_id;
            $op->sponsorship_id = $request->sponsorship_id;
            $op->sponsorship_name = $request->sponsorship_name;

            if (!$user->hasRole('User')) {
                $user->assignRole('User');
            }
            if ($request->manager_flag == 'Y') {
                $user->removeRole('Manager');
                $user->assignRole('Manager');
            } else {
                $user->removeRole('Manager');
            }

            if ($request->file('profile_image_name')) {
                $file = $request->file('profile_image_name');
                $filename = rand() . date('ymdHis') . $file->getClientOriginalName();
                $file->move(public_path('storage/upload/profile_images'), $filename);
                $data->file_name = $filename;
                $data->original_file_name = $file->getClientOriginalName();
                $data->file_extension = $file->getClientOriginalExtension();
                $data->file_size = $_FILES['profile_image_name']['size']; //$request->file('profile_image_name')->getSize();
                $data->file_path = '/storage/upload/profile_images/';
                $data->user_id = $id;
                $data->employee_id = $request->id;

                $data->save();
            }

            $op->save();
        }
        // Log::info($request->all());
        return response()->json(['error' => $error, 'message' => $message]);
    }


    public function balance($id)
    {
        $op = EmployeeLeave::where('employee_id', $id)
            ->whereYear('date_from', Carbon::now()->year)
            ->whereMonth('date_from', Carbon::now()->month)
            ->sum('number_of_days');

        // Log::alert('EmployeeController::getEmpEditView file_name: ' . $emp->emp_files?->file_name);

        $view = view('/tracki/employee/leave/mv/balance', [
            'totalleavestaken' => $op,
        ])->render();

        return response()->json(['view' => $view]);
    }

    public function leave_balance($id)
    {
        $op = EmployeeLeave::where('employee_id', $id)->sum('number_of_days');
        return response()->json(['op' => $op]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        //
        // Employee::where('id', '=', $id)->delete();
        // soft delete
        // dd($id);
        $employee = Employee::find($id);
        $employee->archived = 'Y';
        $employee->save();

        // $employee_address = EmployeeAddress::where('employee_id', $id);
        // if ($employee_address->count()){
        //     $employee_address = $employee_address->get();
        //     $employee_address->toQuery()->update([
        //         'archived' => 'Y',
        //     ]);
        // }


        $notification = array(
            'message'       => 'Employee archived successfully',
            'alert-type'    => 'success'
        );

        // dd($taskId);

        return response()->json([
            'error' => false,
            'message' => 'Employee archived successfully',
        ]);
    }

    public function restore(string $id)
    {
        //
        // Employee::where('id', '=', $id)->delete();
        // soft delete
        // dd($id);
        $employee = Employee::find($id);
        $employee->archived = 'N';
        $employee->save();


        $notification = array(
            'message'       => 'Employee restored successfully',
            'alert-type'    => 'success'
        );

        // dd($taskId);

        return response()->json([
            'error' => false,
            'message' => 'Employee restored successfully',
        ]);
    }
}
