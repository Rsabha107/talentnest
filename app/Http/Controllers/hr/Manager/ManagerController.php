<?php

namespace App\Http\Controllers\hr\Manager;

use App\Http\Controllers\Controller;

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
use App\Models\EmployeeBank;
use App\Models\EmployeeContractType;
use App\Models\EmployeeDirectorate;
use App\Models\EmployeeEmergencyContact;
use App\Models\EmployeeEntity;
use App\Models\EmployeeFile;
use App\Models\EmployeeJobLevel;
use App\Models\EmployeeLeave;
use App\Models\EmployeeLeaveStatus;
use App\Models\EmployeeLeaveType;
use App\Models\EmployeeRelationship;
use App\Models\EmployeeSalary;
use App\Models\EmployeeSponsorship;
use App\Models\EmployeeTimeSheet;
use App\Models\EmployeeType;
use App\Models\EventCategory;
use App\Models\FunctionalArea;
use App\Models\Gender;
use App\Models\Language;
use App\Models\Location;
use App\Models\MaritalStatus;
use App\Models\MonthsNames;
use App\Models\Nationality;
use App\Models\ProjectType;
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
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Route as FacadesRoute;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\Datatables;

class ManagerController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('hr.manager.list');
    }


    public function list()
    {
        $user = User::findOrFail(auth()->user()->id);

        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";

        $employees = Employee::orderBy($sort, $order);
        $employees = $employees->where('reporting_to_id', auth()->user()->employee_id);

        if ($search) {
            $employees = $employees->where(function ($query) use ($search) {
                $query->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('work_email_address', 'like', '%' . $search . '%')
                    ->orWhere('employee_number', 'like', '%' . $search . '%');
            });
        }


        $total = $employees->count();

        $employees = $employees->paginate(request("limit"))->through(function ($employee) use ($user) {

            $full_name = $employee->first_name . ' ' . $employee->last_name;

            /* returns null if it does not exist */
            // $salary = EmployeeSalary::when($employee->id, function ($query, $sal) {
            //     return $query->where('employee_salary.employee_id', $sal);
            // })->first();

            $salary = EmployeeSalary::where('employee_id', $employee->id)->first();
            // dd($salary);

            if ($employee->emp_files?->file_path) {
                $image = ' <div class="avatar avatar-m ">
                                <a  href="#" role="button" title="' . $full_name . '">
                                    <img class="rounded-circle pull-up" src="' . $employee->emp_files->file_path . $employee->emp_files->file_name . '" alt="" />
                                </a>
                            </div>';
            } else {
                $image = '  <div class="avatar avatar-m  me-1" id="project_team_members_init">
                                <a class="dropdown-toggle dropdown-caret-none d-inline-block" href="#" role="button" title="' . $full_name . '">
                                    <div class="avatar avatar-m  rounded-circle pull-up">
                                        <div class="avatar-name rounded-circle me-2"><span>' . generateInitials($full_name) . '</span></div>
                                    </div>
                                </a>
                            </div>';
            }

            return [
                'id1' => '<div class="ms-3">' . $employee->id . '</div>',
                'id' => $employee->id,
                'image' => $image,
                'employee_number' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->employee_number . '</div>',
                // 'employee_type' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->employee_types->title . '</div>',
                'reporting_to_id' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->managers?->full_name . '</div>',
                'gender_id' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->genders->title . '</div>',
                'full_name' => '<div class="align-middle white-space-wrap fw-bold fs-9 ">' . $employee->full_name . '</div>',
                'entity_id' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->entities?->title . '</div>',
                'contract_start_date' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . format_date($employee->contract_start_date) . '</div>',
                'contract_end_date' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . format_date($employee->contract_end_date) . '</div>',
                'work_email_address' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->work_email_address . '</div>',
                'salary' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->salaries?->net_salary . '</div>',

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

}
