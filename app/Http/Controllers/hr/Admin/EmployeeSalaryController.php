<?php

namespace App\Http\Controllers\hr\Admin;

use App\Http\Controllers\Controller;

use App\Models\AddressType;
use App\Models\Allowance;
use App\Models\Country;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\employeeAddress;
use App\Models\EmployeeFile;
use App\Models\EmployeeSalary;
use Spatie\Permission\Models\Permission;
use App\Models\EmployeeType;
use App\Models\Gender;
use App\Models\Language;
use App\Models\MaritalStatus;
use App\Models\Nationality;
use App\Models\PayrollPeriod;
use App\Models\Relationship;
use App\Models\Salutation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class EmployeeSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // dd($id);
        $employee_salaries = EmployeeSalary::all();
        $payroll_cycles = PayrollPeriod::all();
        $employees = Employee::where('administrator_flag', 'N')->get();
        $allowances = Allowance::all();
        // dd($emps);


        // dd(FacadesRoute::currentRouteName());
        // dd(FacadesRequest::url());
        return view('hr.admin.salary.list', compact('employee_salaries', 'employees', 'allowances', 'payroll_cycles'));
    }



    /**
     * add a new resource.
     */
    public function add()
    {
        //
        return view('tracki.employee.address.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $id = Auth::user()->id;
        $op = new EmployeeSalary();
        // $emp = new Employee();
        // $data = new employeeAddress();

        $rules = [
            'employee_id' => 'required',
            'net_salary' => 'required|numeric',
            'payroll_cycle_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        // dd($validator);

        // Log::info($request->all());

        if ($validator->fails()) {
            // Log::info($validator->errors());
            $error = true;
            $message = implode($validator->errors()->all());
            // $message = 'Salary not create.' . $op->id;
        } else {
            $error = false;
            $message = 'Salary created .' . $op->id;

            $op->employee_id = $request->employee_id;
            $op->net_salary = $request->net_salary;
            $op->payroll_cycle_id = $request->payroll_cycle_id;
            $op->active_flag = 1;
            $op->creator_id = $id;

            $op->save();

            // dd($op->number);
        }

        return response()->json(['error' => $error, 'message' => $message]);
    }

    public function list($id = null)
    {

        // dd('test');
        $user = User::find(Auth::user()->id);
        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";


        $op = EmployeeSalary::orderBy($sort, $order);

        if ($search) {
            $op = $op->where(function ($query) use ($search) {
                $query->where('net_salary', 'like', '%' . $search . '%')
                    ->orWhereHas('employees', function ($query) use ($search) {
                        $query->where('full_name', 'like', '%' . $search . '%')
                            ->orWhere('employee_number', 'like', '%' . $search . '%')
                            ->orWhere('work_email_address', 'like', '%' . $search . '%');
                    });
            });
        }

        $total = $op->count();

        //apply scope
        $op = $op->isActive('N');

        $op = $op->paginate(request("limit"))->through(function ($op) use ($user) {

            // $profile_url = route('tracki.employee.profile', $op->id);
            if ($op->employees->emp_files?->file_path) {
                $image = ' <div class="avatar avatar-m ">
                                <a  href="#" role="button" title="' . $op->employees->full_name . '">
                                    <img class="rounded-circle pull-up" src="' . $op->employees->emp_files->file_path . $op->employees->emp_files->file_name . '" alt="" />
                                </a>
                            </div>';
            } else {
                $image = '  <div class="avatar avatar-m  me-1" id="project_team_members_init">
                                <a class="dropdown-toggle dropdown-caret-none d-inline-block" href="#" role="button" title="' . $op->employees->full_name . '">
                                    <div class="avatar avatar-m  rounded-circle pull-up">
                                        <div class="avatar-name rounded-circle me-2"><span>' . generateInitials($op->employees->full_name) . '</span></div>
                                    </div>
                                </a>
                            </div>';
            }

            $actions =
                '<div class="font-sans-serif btn-reveal-trigger position-static">';


            $actions = $actions . '<a href="javascript:void(0)" class="btn btn-sm" id="edit_employee_salary" data-action="update" " data-type="edit" data-id=' .
                $op->id .
                ' data-table="employee_salary_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Update">' .
                '<i class="fa-solid fa-pen-to-square text-primary"></i></a>';

            $actions = $actions .    '<a href="javascript:void(0)" class="btn btn-sm" data-table="employee_salary_table" data-id="' .
                $op->id .
                '" id="deleteEmployeeSalary" data-bs-toggle="tooltip" data-bs-placement="right" title="Delete">' .
                '<i class="bx bx-trash text-danger"></i></a></div></div>';

            $profile_url = route('hr.admin.employee.profile', encrypt($op->employees->id));


            return [
                'id1' => '<div class="ms-3">' . $op->id . '</div>',
                'id' => $op->id,
                'image' => $image,
                'full_name' => '<div class="ms-3">' . $op->employees->full_name . '</div>',
                'employee_number' => '<div class="ms-3 fw-bold fs-9"><a href="' . $profile_url . '">' . $op->employees->employee_number . '</a></div>',
                'email_address' => '<div class="ms-3">' . $op->employees->work_email_address . '</div>',
                'join_date' => '<div class="ms-3">' . format_date($op->employees->contract_start_date) . '</div>',
                'designation' => '<div class="ms-3">' . $op->employees->designation->name . '</div>',
                'net_salary' => '<div class="ms-3">' . $op->net_salary . '</div>',
                'payroll_period' => $op->payroll_cycle?->title,
                'actions' => $actions,
                'created_at' => format_date($op->created_at,  'H:i:s'),
                'updated_at' => format_date($op->updated_at, 'H:i:s'),
            ];
        });

        return response()->json([
            "rows" => $op->items(),
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $rules = [
            // 'employee_id' => 'required',
            'net_salary' => 'required|numeric',
            'payroll_cycle_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Log::info($validator->errors());
            $error = true;
            $message = implode($validator->errors()->all());
        } else {
            $id = Auth::user()->id;
            $op = EmployeeSalary::findOrFail($request->id);

            $error = false;
            $message = 'Salary updated.';

            // $op->employee_id = $request->employee_id;
            $op->net_salary = $request->net_salary;
            $op->payroll_cycle_id = $request->payroll_cycle_id;
            $op->creator_id = $id;

            $op->save();
        }
        // Log::info($request->all());

        return response()->json(['error' => $error, 'message' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        //
        EmployeeSalary::where('id', '=', $id)->delete();

        $notification = array(
            'message'       => 'Salary address deleted successfully',
            'alert-type'    => 'success'
        );

        // dd($taskId);

        return response()->json([
            'error' => false,
            'message' => 'Salary address deleted successfully',
        ]);
    }

    // return the edit employee view
    public function getEmpSalaryEditView($id)
    {
        $emps = Employee::all();  // used for managers
        $employee_salary = EmployeeSalary::findOrFail($id);
        $payroll_cycles = PayrollPeriod::all();

        // Log::alert('EmployeeController::getEmpEditView file_name: ' . $emp->emp_files?->file_name);

        $view = view('/hr/admin/salary/mv/edit', [
            'employee_salary' => $employee_salary,
            'emps' => $emps,
            'payroll_cycles' => $payroll_cycles,
        ])->render();

        return response()->json(['view' => $view]);
    }
}
