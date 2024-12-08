<?php

namespace App\Policies;

use App\Models\EmployeeTimeSheetEntry;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Log;

class TimesheetEntriesPolicy
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
    public function view(User $user, EmployeeTimeSheetEntry $employeeTimeSheetEntry): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, EmployeeTimeSheetEntry $employeeTimeSheetEntry): bool
    {
        //
        Log::info('inside policy TimesheetEntriesPolicy::update use_employee_id='.$user->employee_id.' employeeTimeSheetEntry_employee_id='.$employeeTimeSheet->employee_id);

        return $user->employee_id == $employeeTimeSheetEntry->employee_id;
        // return $user->id == $employeeTimeSheetEntry->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, EmployeeTimeSheetEntry $employeeTimeSheetEntry): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, EmployeeTimeSheetEntry $employeeTimeSheetEntry): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, EmployeeTimeSheetEntry $employeeTimeSheetEntry): bool
    {
        //
    }
}
