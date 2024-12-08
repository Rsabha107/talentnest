<?php

namespace App\Policies;

use App\Models\EmployeeTimeSheet;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Log;

class TimesheetPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, EmployeeTimeSheet $employeeTimeSheet): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, EmployeeTimeSheet $employeeTimeSheet): bool
    {
        //
        Log::info('inside policy TimesheetPolicy::update use_employee_id='.$user->employee_id.' employeeTimesheet_employee_id='.$employeeTimeSheet->employee_id);
        return $user->employee_id == $employeeTimeSheet->employee_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, EmployeeTimeSheet $employeeTimeSheet): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, EmployeeTimeSheet $employeeTimeSheet): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, EmployeeTimeSheet $employeeTimeSheet): bool
    {
        //
    }
}
