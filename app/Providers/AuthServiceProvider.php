<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\EmployeeTimeSheet;
use App\Models\EmployeeTimeSheetEntry;
use App\Policies\TimesheetEntriesPolicy;
use App\Policies\TimesheetPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */

    protected $policies = [
        EmployeeTimeSheet::class => TimesheetPolicy::class,
        EmployeeTimeSheetEntry::class => TimesheetEntriesPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
