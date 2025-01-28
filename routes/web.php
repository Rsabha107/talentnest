<?php

use App\Http\Controllers\ActivityAuditController;
use App\Http\Controllers\AddressTypeController;
use App\Http\Controllers\hr\Admin\EmployeeAddressController as AdminEmployeeAddressController;
use App\Http\Controllers\hr\Admin\EmployeeBankController as AdminEmployeeBankController;
use App\Http\Controllers\hr\Admin\EmployeeController as AdminEmployeeController;
use App\Http\Controllers\hr\Admin\EmployeeDashboardController as AdminEmployeeDashboardController;
use App\Http\Controllers\hr\Admin\EmployeeEmergencyContactController as AdminEmployeeEmergencyContactController;
use App\Http\Controllers\hr\Admin\EmployeeGeneratedLetterController as AdminEmployeeGeneratedLetterController;
use App\Http\Controllers\hr\Admin\EmployeeLeaveController as AdminEmployeeLeaveController;
use App\Http\Controllers\hr\Admin\EmployeeLetterController as AdminEmployeeLetterController;
use App\Http\Controllers\hr\Admin\EmployeeSalaryController as AdminEmployeeSalaryController;
use App\Http\Controllers\hr\Admin\EmployeeTimeSheetController as AdminEmployeeTimeSheetController;
use App\Http\Controllers\hr\Admin\EmployeeTimeSheetEntryController as AdminEmployeeTimeSheetEntryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SetupController;
use App\Http\Controllers\ChartsController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CommunicationChannels;
// use App\Http\Controllers\GanttController;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\DirectorateController;
use App\Http\Controllers\ElementClassificationController;
use App\Http\Controllers\ElementController;
use App\Http\Controllers\ElementSetAssignmentController;
use App\Http\Controllers\ElementSetController;
use App\Http\Controllers\EmployeeAddressController;
use App\Http\Controllers\EmployeeAttachmentController;
use App\Http\Controllers\EmployeeBankController;
use App\Http\Controllers\EmployeeContractTypeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeDashboardController;
use App\Http\Controllers\EmployeeEmergencyContactController;
use App\Http\Controllers\EmployeeGeneratedLetterController;
use App\Http\Controllers\EmployeeLeaveController;
use App\Http\Controllers\EmployeeLetterController;
use App\Http\Controllers\EmployeeRelationshipController;
use App\Http\Controllers\EmployeeSalaryController;
use App\Http\Controllers\EmployeeSponsorshipController;
use App\Http\Controllers\EmployeeTimeSheetController;
use App\Http\Controllers\EmployeeTimeSheetEntryController;
use App\Http\Controllers\EmployeeTimeSheetInvoice;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\FunctionalAreaController;
use App\Http\Controllers\GanttController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\hr\Admin\EmployeeAttachmentController as AdminEmployeeAttachmentController;
use App\Http\Controllers\hr\Manager\ManagerController as ManagerManagerController;
use App\Http\Controllers\hr\Manager\ManagerTimesheetController as ManagerManagerTimesheetController;
use App\Http\Controllers\hr\Pay\PayrollBankController as PayPayrollBankController;
use App\Http\Controllers\hr\Pay\PayrollTimesheetController as PayPayrollTimesheetController;
use App\Http\Controllers\hr\Security\RoleController as SecurityRoleController;
use App\Http\Controllers\hr\Setting\ActivityAuditController as SettingActivityAuditController;
use App\Http\Controllers\hr\Setting\AddressTypeController as SettingAddressTypeController;
use App\Http\Controllers\hr\Setting\CountryController as SettingCountryController;
use App\Http\Controllers\hr\Setting\DepartmentController as SettingDepartmentController;
use App\Http\Controllers\hr\Setting\DesignationController as SettingDesignationController;
use App\Http\Controllers\hr\Setting\DirectorateController as SettingDirectorateController;
use App\Http\Controllers\hr\Setting\ElementClassificationController as SettingElementClassificationController;
use App\Http\Controllers\hr\Setting\ElementController as SettingElementController;
use App\Http\Controllers\hr\Setting\ElementSetAssignmentController as SettingElementSetAssignmentController;
use App\Http\Controllers\hr\Setting\ElementSetController as SettingElementSetController;
use App\Http\Controllers\hr\Setting\EmployeeContractTypeController as SettingEmployeeContractTypeController;
use App\Http\Controllers\hr\Setting\EmployeeRelationshipController as SettingEmployeeRelationshipController;
use App\Http\Controllers\hr\Setting\EmployeeSponsorshipController as SettingEmployeeSponsorshipController;
use App\Http\Controllers\hr\Setting\EmployeeTimeSheetInvoice as SettingEmployeeTimeSheetInvoice;
use App\Http\Controllers\hr\Setting\EntityController as SettingEntityController;
use App\Http\Controllers\hr\Setting\FunctionalAreaController as SettingFunctionalAreaController;
use App\Http\Controllers\hr\Setting\GenderController as SettingGenderController;
use App\Http\Controllers\hr\Setting\JobLevelController as SettingJobLevelController;
use App\Http\Controllers\hr\Setting\LeaveTypeController as SettingLeaveTypeController;
use App\Http\Controllers\hr\Setting\MaritalStatusController as SettingMaritalStatusController;
use App\Http\Controllers\hr\Setting\NationalityController as SettingNationalityController;
use App\Http\Controllers\hr\Setting\PayCycleController as SettingPayCycleController;
use App\Http\Controllers\hr\Setting\PrefixController as SettingPrefixController;
use App\Http\Controllers\JobLevelController;
use App\Http\Controllers\KanbanController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ManagerLeaveController;
use App\Http\Controllers\ManagerTimesheetController;
use App\Http\Controllers\MaritalStatusController;
use App\Http\Controllers\NationalityController;
use App\Http\Controllers\PayCycleController;
use App\Http\Controllers\PayrollBankController;
use App\Http\Controllers\PayrollTimesheetController;
use App\Http\Controllers\PrefixController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\ProjectMgt\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\projectMgt\Admin\Setting\AudienceController as AdminAudienceController;
use App\Http\Controllers\projectMgt\Admin\Setting\CategoryController as AdminCategoryController;
use App\Http\Controllers\projectMgt\Admin\Setting\DepartmentController as AdminSettingDepartmentController;
use App\Http\Controllers\projectMgt\Admin\Setting\FunctionalAreaController as AdminSettingFunctionalAreaController;
use App\Http\Controllers\projectMgt\Admin\Setting\LocationController as AdminLocationController;
use App\Http\Controllers\projectMgt\Admin\Setting\ProjectTypetController;
use App\Http\Controllers\projectMgt\Admin\Setting\TagController as AdminTagController;
use App\Http\Controllers\projectMgt\Admin\Setting\VenueController as AdminVenueController;
use App\Http\Controllers\ProjectMgt\Admin\TaskController as AdminTaskController;
use App\Http\Controllers\RandomController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\SubtaskController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkspaceController;
use App\Models\AddressType;
use App\Models\EmployeeEmergencyContact;
use App\Models\EmployeeEntity;
use App\Models\EmployeeRelationship;
use App\Models\EmployeeSponsorship;

// use App\Http\Controllers\ProjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



// ****************** ADMIN *********************
Route::group(['middleware' => 'prevent-back-history', 'XssSanitizer'], function () {
    Route::middleware(['auth', 'roles:admin', 'role:SuperAdmin', 'prevent-back-history', 'XssSanitizer'])->group(function () {

        // Add User
        Route::get('/tracki/auth/signup', [AdminController::class, 'signUp'])->name('tracki.auth.signup');
        Route::post('/admin/signup/create', [AdminController::class, 'createUser'])->name('admin.signup.create');
    });  // End group Admin middleware

    // HR Security Settings all routes
    Route::middleware(['auth', 'otp', 'XssSanitizer', 'role:SuperAdmin', 'roles:admin', 'prevent-back-history', 'auth.session'])->group(function () {

        Route::controller(SecurityRoleController::class)->group(function () {
            //Admin User
            Route::get('/sec/adminuser/list', 'listAdminUser')->name('sec.adminuser.list');
            Route::post('updateadminuser', 'updateAdminUser')->name('sec.adminuser.update');
            Route::post('createadminuser', 'createAdminUser')->name('sec.adminuser.create');
            Route::get('/sec/adminuser/{id}/edit', 'editAdminUser')->name('sec.adminuser.edit');
            Route::get('/sec/adminuser/{id}/delete', 'deleteAdminUser')->name('sec.adminuser.delete');
            Route::get('/sec/adminuser/add', 'addAdminUser')->name('sec.adminuser.add');
            Route::get('/sec/adminuser/add2', 'addAdminUser2')->name('sec.adminuser.add2');

            // Roles
            Route::get('/sec/roles/add', function () {
                return view('/sec/roles/add');
            })->name('sec.roles.add');
            Route::get('/sec/roles/roles/list', 'listRole')->name('sec.roles.list');
            Route::post('updaterole', 'updateRole')->name('sec.roles.update');
            Route::post('createrole', 'createRole')->name('sec.roles.create');
            Route::get('/sec/roles/{id}/edit', 'editRole')->name('sec.roles.edit');
            Route::get('/sec/roles/{id}/delete', 'deleteRole')->name('sec.roles.delete');

            // group
            Route::get('/sec/groups/add', function () {
                return view('/sec/groups/add');
            })->name('sec.groups.add');
            Route::get('/sec/groups/groups/list', 'listGroup')->name('sec.groups.list');
            Route::post('updategroup', 'updateGroup')->name('sec.groups.update');
            Route::post('creategroup', 'createGroup')->name('sec.groups.create');
            Route::get('/sec/groups/{id}/edit', 'editGroup')->name('sec.groups.edit');
            Route::get('/sec/groups/{id}/delete', 'deleteGroup')->name('sec.groups.delete');

            // Permission
            Route::get('/sec/permissions/list', 'listPermission')->name('sec.perm.list');
            Route::post('updatepermission', 'updatePermission')->name('sec.perm.update');
            Route::post('createpermission', 'createPermission')->name('sec.perm.create');
            Route::get('/sec/perm/{id}/edit', 'editPermission')->name('sec.perm.edit');
            Route::get('/sec/perm/{id}/delete', 'deletePermission')->name('sec.perm.delete');
            Route::get('/sec/permissions/add', 'addPermission')->name('sec.perm.add');

            Route::get('/sec/perm/import', 'ImportPermission')->name('sec.perm.import');
            Route::post('importnow', 'ImportNowPermission')->name('sec.perm.import.now');


            // Roles in Permission
            Route::get('/sec/rolesetup/list', 'listRolePermission')->name('sec.rolesetup.list');
            Route::post('updaterolesetup', 'updateRolePermission')->name('sec.rolesetup.update');
            Route::post('createrolesetup', 'createRolePermission')->name('sec.rolesetup.create');
            Route::get('/sec/rolesetup/{id}/edit', 'editRolePermission')->name('sec.rolesetup.edit');
            Route::get('/sec/rolesetup/{id}/delete', 'deleteRolePermission')->name('sec.rolesetup.delete');
            Route::get('/sec/rolesetup/add', 'addRolePermission')->name('sec.rolesetup.add');
        });  //
    });  //


    // PROJECT MANAGEMENT ******************************************************************** Admin All Route
    Route::middleware(['auth', 'otp', 'XssSanitizer', 'role:SuperAdmin|PROJECTMGT', 'roles:admin', 'prevent-back-history', 'auth.session'])->group(function () {

        // Projects Routes
        Route::controller(AdminProjectController::class)->group(function () {
            Route::get('/projects/admin/project/', 'index')->name('projects.admin.project')->middleware('permission:project.show');
            Route::get('/projects/admin/project/create', 'create')->name('projects.admin.project.create')->middleware('permission:project.show');
            Route::get('/projects/admin/project/duplicate/{id}', 'duplicate')->name('projects.admin.project.duplicate')->middleware('permission:project.show');
            Route::get('/projects/admin/project/list/{id?}', 'list')->name('projects.admin.project.list')->middleware('permission:project.show');
            Route::get('/projects/admin/project/employee/list/{id?}', 'employeeList')->name('projects.admin.employee.project.list')->middleware('permission:project.show');
            Route::get('/projects/admin/project/d/{id}', 'detail')->name('projects.admin.project.d')->middleware('permission:project.show');
            Route::get('/projects/admin/project/mv', 'projectCardMV')->name('projects.admin.project.mv');
            Route::post('/project/store', 'store')->name('project.store');
            Route::post('/project/update', 'update')->name('project.update');
            Route::get('/projects/admin/project/get/{id}', 'getProject')->name('projects.admin.project.get');
            Route::get('/projects/admin/project/delete/{id}', 'delete')->name('projects.admin.project.delete')->middleware('permission:project.delete');
            Route::get('/projects/admin/project/restore/{id}', 'restore')->name('projects.admin.project.restore')->middleware('permission:project.delete');

            Route::get('/projects/admin/project/member/list/{id?}', 'mlist')->name('projects.admin.project.member.list')->middleware('permission:project.show');
            Route::get('/projects/admin/project/member/{pid}/delete/{id}', 'mdelete')->name('projects.admin.project.member.delete')->middleware('permission:project.delete');
            Route::post('/projects/admin/project/member/update', 'mupdate')->name('projects.admin.project.member.update')->middleware('permission:project.delete');


            Route::get('/ganttxx/{id}', function () {
                    return view('/projects/admin/project/gantt/gantt');
            })->name('ganttxxx');

        });

        Route::get('/gantt/{id}', [GanttController::class, 'index'])->name('project.gantt.index');

        // Tasks Routes
        Route::controller(AdminTaskController::class)->group(function () {
            Route::get('/projects/admin/task/list/{id?}', 'list')->name('projects.admin.task.list')->middleware('permission:project.show');
            Route::get('/projects/admin/task/employee/list/{id?}', 'employeeList')->name('projects.admin.employee.task.list')->middleware('permission:project.show');
            Route::get('/projects/admin/task/overview/{id}', 'taskOverview')->name('projects.admin.task.overview')->middleware('permission:task.show');
            Route::get('/projects/admin/task/notes/{id}', 'getTaskNotesView')->name('projects.admin.task.notes')->middleware('permission:task.show');
            Route::get('/projects/admin/task/subtask/{id}', 'getTaskSubView')->name('projects.admin.task.subtask')->middleware('permission:task.show');
            Route::get('/projects/admin/task/files/{id}', 'getTaskFilesView')->name('projects.admin.task.files')->middleware('permission:task.show');
            Route::get('/projects/admin/task', 'index')->name('projects.admin.task')->middleware('permission:task.show');
            Route::delete('/projects/admin/task/delete/{id}', 'destroy')->name('projects.admin.task.delete');


            //task file upload
            Route::post('/projects/admin/task/file/store', 'taskFileStore')->name('projects.admin.task.file.store');
            Route::delete('/projects/admin/task/file/{id}/delete', 'taskFileDelete')->name('projects.admin.task.file.delete');


            //add task note
            Route::post('/projects/admin/task/note/store', 'taskNoteStore')->name('projects.admin.task.note.store');
            Route::delete('/projects/admin/task/note/{id}/delete', 'deleteTaskNote')->name('projects.admin.task.note.delete');

            //************************************ Subtask Methods *************************************************** */
            Route::post('/projects/admin/task/subtask', 'store')->name('projects.admin.task.subtask.store');
            Route::get('/projects/admin/task/subtask/{id}/overview', 'overview')->name('projects.admin.task.subtask.overview');
            Route::post('/projects/admin/task/subtask/update_status', 'updateStatus')->name('projects.admin.task.subtask.update_status');


            Route::get('/projects/admin/task/status/edit/{id}', 'editTaskStatus')->name('projects.admin.task.status.edit');
            Route::post('/projects/admin/task/status/update', 'updateTaskStatus')->name('projects.admin.task.status.update');
            Route::post('/projects/admin/task/store', 'store')->name('projects.admin.task.store');
            Route::get('/projects/admin/task/mv/edit/{id}', 'getTaskView')->name('projects.admin.task.mv.edit');
            Route::get('/projects/admin/task/get/{id}', 'getTask')->name('projects.admin.task.get');

            Route::post('/projects/admin/task/update', 'updateTask')->name('projects.admin.task.update');
        });

        //*****************************************************Project Setting All routes********************************

        //Category route
        Route::controller(AdminCategoryController::class)->group(function () {
            Route::get('/projects/admin/setting/category', 'index')->name('projects.admin.setting.category.index');
            Route::get('/projects/admin/setting/category/list', 'list')->name('projects.admin.setting.category.list');
            Route::post('/projects/admin/setting/category/update', 'update')->name('projects.admin.setting.category.update');
            Route::post('/projects/admin/setting/category/store', 'store')->name('projects.admin.setting.category.store');
            Route::get('/projects/admin/setting/category/edit/{id}', 'edit')->name('projects.admin.setting.category.edit');
            Route::delete('/projects/admin/setting/category/delete/{id}', 'destroy')->name('projects.admin.setting.category.delete');
        });

        //Audience route
        Route::controller(AdminAudienceController::class)->group(function () {
            Route::get('/projects/admin/setting/audience', 'index')->name('projects.admin.setting.audience.index');
            Route::get('/projects/admin/setting/audience/list', 'list')->name('projects.admin.setting.audience.list');
            Route::post('/projects/admin/setting/audience/update', 'update')->name('projects.admin.setting.audience.update');
            Route::post('/projects/admin/setting/audience/store', 'store')->name('projects.admin.setting.audience.store');
            Route::get('/projects/admin/setting/audience/edit/{id}', 'edit')->name('projects.admin.setting.audience.edit');
            Route::delete('/projects/admin/setting/audience/delete/{id}', 'destroy')->name('projects.admin.setting.audience.delete');
        });

        //Tag route
        Route::controller(AdminTagController::class)->group(function () {
            Route::get('/projects/admin/setting/tag', 'index')->name('projects.admin.setting.tag.index');
            Route::get('/projects/admin/setting/tag/list', 'list')->name('projects.admin.setting.tag.list');
            Route::post('/projects/admin/setting/tag/update', 'update')->name('projects.admin.setting.tag.update');
            Route::post('/projects/admin/setting/tag/store', 'store')->name('projects.admin.setting.tag.store');
            Route::get('/projects/admin/setting/tag/edit/{id}', 'edit')->name('projects.admin.setting.tag.edit');
            Route::delete('/projects/admin/setting/tag/delete/{id}', 'destroy')->name('projects.admin.setting.tag.delete');
        });

        //Venue route
        Route::controller(AdminVenueController::class)->group(function () {
            Route::get('/projects/admin/setting/venue', 'index')->name('projects.admin.setting.venue.index');
            Route::get('/projects/admin/setting/venue/list', 'list')->name('projects.admin.setting.venue.list');
            Route::post('/projects/admin/setting/venue/update', 'update')->name('projects.admin.setting.venue.update');
            Route::post('/projects/admin/setting/venue/store', 'store')->name('projects.admin.setting.venue.store');
            Route::get('/projects/admin/setting/venue/edit/{id}', 'edit')->name('projects.admin.setting.venue.edit');
            Route::delete('/projects/admin/setting/venue/delete/{id}', 'destroy')->name('projects.admin.setting.venue.delete');
        });


        //Location  route
        Route::controller(AdminLocationController::class)->group(function () {
            Route::get('/projects/admin/setting/location', 'index')->name('projects.admin.setting.location.index');
            Route::get('/projects/admin/setting/location/list', 'list')->name('projects.admin.setting.location.list');
            Route::post('/projects/admin/setting/location/update', 'update')->name('projects.admin.setting.location.update');
            Route::post('/projects/admin/setting/location/store', 'store')->name('projects.admin.setting.location.store');
            Route::get('/projects/admin/setting/location/edit/{id}', 'edit')->name('projects.admin.setting.location.edit');
            Route::delete('/projects/admin/setting/location/delete/{id}', 'destroy')->name('projects.admin.setting.location.delete');
        });

        //Project Type route
        Route::controller(ProjectTypetController::class)->group(function () {
            Route::get('/projects/admin/setting/projecttype', 'index')->name('projects.admin.setting.projecttype.index');
            Route::get('/projects/admin/setting/projecttype/list', 'list')->name('projects.admin.setting.projecttype.list');
            Route::post('/projects/admin/setting/projecttype/update', 'update')->name('projects.admin.setting.projecttype.update');
            Route::post('/projects/admin/setting/projecttype/store', 'store')->name('projects.admin.setting.projecttype.store');
            Route::get('/projects/admin/setting/projecttype/edit/{id}', 'edit')->name('projects.admin.setting.projecttype.edit');
            Route::delete('/projects/admin/setting/projecttype/delete/{id}', 'destroy')->name('projects.admin.setting.projecttype.delete');
        });

        ////Department route
        Route::controller(AdminSettingDepartmentController::class)->group(function () {
            Route::get('/projects/admin/setting/departments', 'index')->name('projects.admin.setting.departments');
        });

        ////Functional Area route
        Route::controller(AdminSettingFunctionalAreaController::class)->group(function () {
            Route::get('/projects/admin/setting/funcareas', 'index')->name('projects.admin.setting.funcareas');
        });
    });



    // HRMS ******************************************************************** Admin All Route
    Route::middleware(['auth', 'otp', 'XssSanitizer', 'role:SuperAdmin|HRMSADMIN', 'roles:admin', 'prevent-back-history', 'auth.session'])->group(function () {

        // dashboard All Route 
        Route::get('/dashboard', [AdminEmployeeDashboardController::class, 'dashboard'])->name('hr.admin.dashboard')->middleware('auth.session');

        // Employee Routes
        Route::controller(AdminEmployeeController::class)->group(function () {
            Route::get('/hr/admin/employee/', 'index')->name('hr.admin.employee')->middleware('permission:employee.show');
            Route::get('/hr/admin/employee/profile/{id}', 'profile')->name('hr.admin.employee.profile');
            Route::get('/hr/admin/employee/list', 'list')->name('hr.admin.employee.list')->middleware('permission:employee.show');
            Route::get('/hr/admin/employee/mv/edit/{id}', 'getEmpEditView')->name('hr.admin.employee.rv.edit')->middleware('permission:employee.edit');
            Route::get('/hr/admin/employee/mv/duplicate/{id}', 'duplicate_employee_view')->name('hr.admin.employee.mv.duplicate')->middleware('permission:employee.edit');
            Route::post('/hr/admin/employee/update', 'update')->name('hr.admin.employee.update')->middleware('permission:employee.edit');
            Route::get('hr/admin/employee/delete/{id}', 'delete')->name('hr.admin.employee.delete')->middleware('permission:employee.delete');
            Route::get('hr/admin/employee/restore/{id}', 'restore')->name('hr.admin.employee.restore')->middleware('permission:employee.delete');
            Route::get('/hr/admin/employee/create', 'create')->name('hr.admin.employee.create')->middleware('permission:employee.create');
            Route::post('/hr/admin/employee/store', 'store')->name('hr.admin.employee.store')->middleware('permission:employee.create');
        });

        // Bank Routes
        Route::controller(AdminEmployeeBankController::class)->group(function () {
            Route::get('/hr/admin/bank/', 'index')->name('hr.admin.bank')->middleware('permission:employee.show');
            Route::get('/hr/admin/bank/list/{id?}', 'list')->name('hr.admin.bank.list')->middleware('permission:employee.show');
            Route::get('/hr/admin/bank/add', 'add')->name('hr.admin.bank.add')->middleware('permission:employee.create');
            Route::post('/hr/admin/bank/store', 'store')->name('hr.admin.bank.store');
            Route::get('/hr/admin/bank/mv/edit/{id}', 'getEmpEditView')->name('hr.admin.bank.rv.edit');
            Route::post('/hr/admin/bank/bank/update', 'update')->name('hr.admin.bank.update');
            Route::get('hr/admin/bank/delete/{id}', 'delete')->name('hr.admin.bank.delete');
            Route::get('/hr/admin/bank/mv/attachment/{id}', 'getAttachmentView')->name('hr.admin.bank.rv.attachment');
        });

        // file Routes
        Route::controller(AdminEmployeeAttachmentController::class)->group(function () {
            Route::post('hr/admin/file/store', 'store')->name('hr.admin.file.store');
            Route::get('/hr/admin/files', 'index')->name('hr.admin.files')->middleware('permission:employee.file.list');
            Route::get('/hr/admin/files/list', 'list')->name('hr.admin.files.list')->middleware('permission:employee.file.list');
            Route::get('/hr/admin/files/get/{id}', 'get')->name('hr.admin.files.get');
            Route::post('/hr/admin/files/update', 'update')->name('hr.admin.files.update');
            Route::delete('/hr/admin/files/delete/{id}', 'delete')->name('hr.admin.files.delete');
            Route::get('/hr/admin/file/serve/{file}', 'serve')->name('hr.admin.file.serve');
        });


        // Address Routes
        Route::controller(AdminEmployeeAddressController::class)->group(function () {
            Route::get('/hr/admin/address/', 'index')->name('hr.admin.address')->middleware('permission:employee.show');
            Route::get('/hr/admin/address/list/{id?}', 'list')->name('hr.admin.address.list')->middleware('permission:employee.show');
            Route::get('/hr/admin/address/mv/edit/{id}', 'getAddressEditView')->name('hr.admin.address.mv.edit');
            Route::post('/hr/admin/address/update',  'update')->name('hr.admin.address.update');
            Route::get('/hr/admin/address/add', 'add')->name('hr.admin.address.add')->middleware('permission:employee.create');
            Route::post('/hr/admin/address/store', 'store')->name('hr.admin.address.store');
            Route::get('hr/admin/address/delete/{id}', 'delete')->name('hr.admin.address.delete');
        });

        // Leave Routes
        Route::controller(AdminEmployeeLeaveController::class)->group(function () {
            Route::get('/hr/admin/leave', 'index')->name('hr.admin.leave')->middleware('permission:leave.show');
            Route::get('/hr/admin/leave/add', 'add')->name('hr.admin.leave.add')->middleware('permission:leave.show');
            Route::get('/hr/admin/leave/list/{id?}', 'list')->name('hr.admin.leave.list')->middleware('permission:leave.show');
            Route::post('/hr/admin/leave/store', 'store')->name('hr.admin.leave.store')->middleware('permission:leave.show');
            Route::get('/hr/admin/leave/delete/{id}', 'delete')->name('hr.admin.leave.delete')->middleware('permission:leave.show');
            Route::post('/hr/admin/leave/leave/update', 'update')->name('hr.admin.leave.update')->middleware('permission:leave.show');
            Route::get('/hr/admin/leave/mv/edit/{id}', 'getEmpLeaveEditView')->name('hr.admin.leave.rv.edit')->middleware('permission:leave.show');
            Route::post('/hr/admin/leave/status/update', 'updateStatus')->name('hr.admin.leave.status.update')->middleware('permission:leave.show');
            Route::get('/hr/admin/leave/status/edit/{id}', 'editStatus')->name('hr.admin.leave.status.edit')->middleware('permission:leave.show');
        });

        // Salary routes
        Route::controller(AdminEmployeeSalaryController::class)->group(function () {
            Route::get('/hr/admin/salary',  'index')->name('hr.admin.salary')->middleware('permission:employee.show');
            Route::get('/hr/admin/salary/add',  'add')->name('hr.admin.salary.add')->middleware('permission:employee.create');
            Route::get('/hr/admin/salary/list/{id?}',  'list')->name('hr.admin.salary.list')->middleware('permission:employee.show');
            Route::post('/hr/admin/salary/store',  'store')->name('hr.admin.salary.store');
            Route::get('/hr/admin/salary/delete/{id}',  'delete')->name('hr.admin.salary.delete');
            Route::post('/hr/admin/salary/salary/update',  'update')->name('hr.admin.salary.update');
            Route::get('/hr/admin/salary/mv/edit/{id}',  'getEmpSalaryEditView')->name('hr.admin.salary.rv.edit');
        });

        // Emergency Contacts routes
        Route::controller(AdminEmployeeEmergencyContactController::class)->group(function () {
            Route::get('/hr/admin/emergency', 'index')->name('hr.admin.emergency')->middleware('permission:employee.show');
            Route::get('/hr/admin/emergency/add', 'add')->name('hr.admin.emergency.add')->middleware('permission:employee.create');
            Route::get('/hr/admin/emergency/list/{id?}', 'list')->name('hr.admin.emergency.list')->middleware('permission:employee.show');
            Route::post('/hr/admin/emergency/store', 'store')->name('hr.admin.emergency.store');
            Route::get('/hr/admin/emergency/delete/{id}', 'delete')->name('hr.admin.emergency.delete');
            Route::get('/hr/admin/emergency/get/{id}', 'get')->name('hr.admin.emergency.get');
            Route::post('/hr/admin/emergency/update', 'update')->name('hr.admin.emergency.update');
            Route::get('/hr/admin/emergency/mv/edit/{id}', 'getEditView')->name('hr.admin.emergency.rv.edit');
        });

        // Time Sheet routes
        Route::get('hr/admin/timesheet/invoice/{id}', [EmployeeTimeSheetInvoice::class, 'invoice'])->name('hr.admin.timesheet.invoice.pdf')->middleware('permission:employee.show');

        Route::controller(AdminEmployeeTimeSheetController::class)->group(function () {
            Route::get('/hr/admin/timesheet',  'index')->name('hr.admin.timesheet')->middleware('permission:employee.show');
            Route::get('/hr/admin/timesheet/add',  'add')->name('hr.admin.timesheet.add')->middleware('permission:employee.create');
            Route::get('/hr/admin/timesheet/list/{id?}',  'list')->name('hr.admin.timesheet.list')->middleware('permission:employee.show');
            Route::post('/hr/admin/timesheet/store',  'store')->name('hr.admin.timesheet.store');
            Route::get('/hr/admin/timesheet/delete/{id}',  'delete')->name('hr.admin.timesheet.delete');
            Route::post('/hr/admin/timesheet/update',  'update')->name('hr.admin.timesheet.update');
            Route::get('/hr/admin/timesheet/mv/edit/{id}',  'getEmpTimeSheetEditView')->name('hr.admin.timesheet.rv.edit');
            Route::post('/hr/admin/timesheet/status/update',  'updateStatus')->name('hr.admin.timesheet.status.update');
            Route::get('/hr/admin/timesheet/status/edit/{id}',  'editStatus')->name('hr.admin.timesheet.status.edit');
        });

        // Time Sheet entries
        Route::controller(AdminEmployeeTimeSheetEntryController::class)->group(function () {
            Route::get('hr/admin/timesheet/entries/{id}', 'index')->name('hr.admin.timesheet.entries')->middleware('permission:employee.show');
            Route::get('hr/admin/timesheet/entries/add/{id}', 'add')->name('hr.admin.timesheet.entries.add')->middleware('permission:employee.show');
            Route::get('hr/admin/timesheet/entries/list/{id}', 'list')->name('hr.admin.timesheet.entries.list')->middleware('permission:employee.show');
            Route::post('hr/admin/timesheet/entries/store', 'store')->name('hr.admin.timesheet.entries.store');
            Route::post('hr/admin/timesheet/entries/update', 'update')->name('hr.admin.timesheet.entries.update');
            Route::get('hr/admin/timesheet/entries/get/{id}', 'get')->name('hr.admin.timesheet.entries.rv.edit');
            Route::post('hr/admin/timesheet/entries/status/update', 'updateStatus')->name('hr.admin.timesheet.entries.status.update');
            Route::get('hr/admin/timesheet/entries/status/edit/{id}', 'editStatus')->name('hr.admin.timesheet.entries.status.edit');
        });

        // Letter Template route
        Route::controller(AdminEmployeeLetterController::class)->group(function () {
            Route::get('/hr/admin/letter', 'index')->name('hr.admin.letter')->middleware('permission:employee.show');
            Route::get('/hr/admin/letter/list', 'list')->name('hr.admin.letter.list')->middleware('permission:employee.show');
            Route::get('/hr/admin/letter/show/{id}', 'show')->name('hr.admin.letter.show');
            Route::get('/hr/admin/letter/edit/{id}', 'edit')->name('hr.admin.letter.edit');
            Route::get('/hr/admin/letter/create', 'create')->name('hr.admin.letter.create');
            Route::post('/hr/admin/letter/store', 'store')->name('hr.admin.letter.store');
            Route::post('/hr/admin/letter/update', 'update')->name('hr.admin.letter.update');
            Route::delete('/hr/admin/letter/delete/{id}', 'delete')->name('hr.admin.letter.delete');
        });

        //Generated Letter route
        Route::controller(AdminEmployeeGeneratedLetterController::class)->group(function () {
            Route::get('/hr/admin/letter/generate',  'index')->name('hr.admin.letter.generate')->middleware('permission:employee.show');
            Route::get('/hr/admin/letter/generate/list',  'list')->name('hr.admin.letter.generate.list')->middleware('permission:employee.show');
            Route::get('/hr/admin/letter/generate/create',  'create')->name('hr.admin.letter.generate.create');
            Route::post('/hr/admin/letter/generate/store',  'store')->name('hr.admin.letter.generate.store');
            Route::get('/hr/admin/letter/generate/gettemplate/{id}',  'getTemplate')->name('hr.admin.letter.generate.gettemplate');
            Route::get('/hr/admin/letter/generate/empvar/{id}',  'getEmp')->name('hr.admin.letter.generate.empvar');
            Route::get('/hr/admin/letter/generate/pdf/{id}',  'pdf')->name('hr.admin.letter.generate.pdf');
            Route::get('/hr/admin/letter/generate/show/{id}',  'show')->name('hr.admin.letter.generate.show');
        });

        //              *****************************************************Setting All routes********************************

        //Address Type route
        Route::controller(SettingAddressTypeController::class)->group(function () {
            Route::get('/hr/admin/setting/addresstype', 'index')->name('hr.admin.setting.addresstype');
            Route::get('/hr/admin/setting/addresstype/list', 'list')->name('hr.admin.setting.addresstype.list');
            Route::get('/hr/admin/setting/addresstype/get/{id}', 'get')->name('hr.admin.setting.addresstype.get');
            Route::post('hr/admin/setting/addresstype/update', 'update')->name('hr.admin.setting.addresstype.update');
            Route::delete('/hr/admin/setting/addresstype/delete/{id}', 'delete')->name('hr.admin.setting.addresstype.delete');
            Route::post('/hr/admin/setting/addresstype/store', 'store')->name('hr.admin.setting.addresstype.store');
        });

        //Address Type route
        Route::controller(SettingDesignationController::class)->group(function () {
            Route::get('/hr/admin/setting/designations', 'index')->name('hr.admin.setting.designations');
            Route::get('/hr/admin/setting/designations/list', 'list')->name('hr.admin.setting.designations.list');
            Route::get('/hr/admin/setting/designations/get/{id}', 'get')->name('hr.admin.setting.designations.get');
            Route::post('hr/admin/setting/designations/update', 'update')->name('hr.admin.setting.designations.update');
            Route::delete('/hr/admin/setting/designations/delete/{id}', 'delete')->name('hr.admin.setting.designations.delete');
            Route::post('/hr/admin/setting/designations/store', 'store')->name('hr.admin.setting.designations.store');
        });

        ////Job Level route
        Route::controller(SettingJobLevelController::class)->group(function () {
            Route::get('/hr/admin/setting/joblevel', 'index')->name('hr.admin.setting.joblevel');
            Route::get('/hr/admin/setting/joblevel/list', 'list')->name('hr.admin.setting.joblevel.list');
            Route::get('/hr/admin/setting/joblevel/get/{id}', 'get')->name('hr.admin.setting.joblevel.get');
            Route::post('/hr/admin/setting/joblevel/update', 'update')->name('hr.admin.setting.joblevel.update');
            Route::delete('/hr/admin/setting/joblevel/delete/{id}', 'delete')->name('hr.admin.setting.joblevel.delete');
            Route::post('/hr/admin/setting/joblevel/store', 'store')->name('hr.admin.setting.joblevel.store');
        });

        ////Sponsorships route
        Route::controller(SettingEmployeeSponsorshipController::class)->group(function () {
            Route::get('/hr/admin/setting/sponsorship', 'index')->name('hr.admin.setting.sponsorship');
            Route::get('/hr/admin/setting/sponsorship/list', 'list')->name('hr.admin.setting.sponsorship.list');
            Route::get('/hr/admin/setting/sponsorship/get/{id}', 'get')->name('hr.admin.setting.sponsorship.get');
            Route::post('/hr/admin/setting/sponsorship/update', 'update')->name('hr.admin.setting.sponsorship.update');
            Route::delete('/hr/admin/setting/sponsorship/delete/{id}', 'delete')->name('hr.admin.setting.sponsorship.delete');
            Route::post('/hr/admin/setting/sponsorship/store', 'store')->name('hr.admin.setting.sponsorship.store');
        });

        ////Contract Type route
        Route::controller(SettingEmployeeContractTypeController::class)->group(function () {
            Route::get('/hr/admin/setting/contracttype', 'index')->name('hr.admin.setting.contracttype');
            Route::get('/hr/admin/setting/contracttype/list', 'list')->name('hr.admin.setting.contracttype.list');
            Route::get('/hr/admin/setting/contracttype/get/{id}', 'get')->name('hr.admin.setting.contracttype.get');
            Route::post('/hr/admin/setting/contracttype/update', 'update')->name('hr.admin.setting.contracttype.update');
            Route::delete('/hr/admin/setting/contracttype/delete/{id}', 'delete')->name('hr.admin.setting.contracttype.delete');
            Route::post('/hr/admin/setting/contracttype/store', 'store')->name('hr.admin.setting.contracttype.store');
        });

        ////Functional Area route
        Route::controller(SettingFunctionalAreaController::class)->group(function () {
            Route::get('/hr/admin/setting/funcareas', 'index')->name('hr.admin.setting.funcareas');
            Route::get('/hr/admin/setting/funcareas/list', 'list')->name('hr.admin.setting.funcareas.list');
            Route::get('/hr/admin/setting/funcareas/get/{id}', 'get')->name('hr.admin.setting.funcareas.get');
            Route::post('/hr/admin/setting/funcareas/update', 'update')->name('hr.admin.setting.funcareas.update');
            Route::delete('/hr/admin/setting/funcareas/delete/{id}', 'delete')->name('hr.admin.setting.funcareas.delete');
            Route::post('/hr/admin/setting/funcareas/store', 'store')->name('hr.admin.setting.funcareas.store');
        });

        ////Gender route
        Route::controller(SettingGenderController::class)->group(function () {
            Route::get('/hr/admin/setting/gender', 'index')->name('hr.admin.setting.gender');
            Route::get('/hr/admin/setting/gender/list', 'list')->name('hr.admin.setting.gender.list');
            Route::get('/hr/admin/setting/gender/get/{id}', 'get')->name('hr.admin.setting.gender.get');
            Route::post('/hr/admin/setting/gender/update', 'update')->name('hr.admin.setting.gender.update');
            Route::delete('/hr/admin/setting/gender/delete/{id}', 'delete')->name('hr.admin.setting.gender.delete');
            Route::post('/hr/admin/setting/gender/store', 'store')->name('hr.admin.setting.gender.store');
        });

        ////Prefix route
        Route::controller(SettingPrefixController::class)->group(function () {
            Route::get('/hr/admin/setting/prefix', 'index')->name('hr.admin.setting.prefix');
            Route::get('/hr/admin/setting/prefix/list', 'list')->name('hr.admin.setting.prefix.list');
            Route::get('/hr/admin/setting/prefix/get/{id}', 'get')->name('hr.admin.setting.prefix.get');
            Route::post('/hr/admin/setting/prefix/update', 'update')->name('hr.admin.setting.prefix.update');
            Route::delete('/hr/admin/setting/prefix/delete/{id}', 'delete')->name('hr.admin.setting.prefix.delete');
            Route::post('/hr/admin/setting/prefix/store', 'store')->name('hr.admin.setting.prefix.store');
        });

        ////Marital Status route
        Route::controller(SettingMaritalStatusController::class)->group(function () {
            Route::get('/hr/admin/setting/marital', 'index')->name('hr.admin.setting.marital');
            Route::get('/hr/admin/setting/marital/list', 'list')->name('hr.admin.setting.marital.list');
            Route::get('/hr/admin/setting/marital/get/{id}', 'get')->name('hr.admin.setting.marital.get');
            Route::post('/hr/admin/setting/marital/update', 'update')->name('hr.admin.setting.marital.update');
            Route::delete('/hr/admin/setting/marital/delete/{id}', 'delete')->name('hr.admin.setting.marital.delete');
            Route::post('/hr/admin/setting/marital/store', 'store')->name('hr.admin.setting.marital.store');
        });

        ////Country route
        Route::controller(SettingCountryController::class)->group(function () {
            Route::get('/hr/admin/setting/countries', 'index')->name('hr.admin.setting.countries');
            Route::get('/hr/admin/setting/countries/list', 'list')->name('hr.admin.setting.countries.list');
            Route::get('/hr/admin/setting/countries/get/{id}', 'get')->name('hr.admin.setting.countries.get');
            Route::post('/hr/admin/setting/countries/update', 'update')->name('hr.admin.setting.countries.update');
            Route::delete('/hr/admin/setting/countries/delete/{id}', 'delete')->name('hr.admin.setting.countries.delete');
            Route::post('/hr/admin/setting/countries/store', 'store')->name('hr.admin.setting.countries.store');
        });

        ////Nationality route
        Route::controller(SettingNationalityController::class)->group(function () {
            Route::get('/hr/admin/setting/nationalities', 'index')->name('hr.admin.setting.nationalities');
            Route::get('/hr/admin/setting/nationalities/list', 'list')->name('hr.admin.setting.nationalities.list');
            Route::get('/hr/admin/setting/nationalities/get/{id}', 'get')->name('hr.admin.setting.nationalities.get');
            Route::post('/hr/admin/setting/nationalities/update', 'update')->name('hr.admin.setting.nationalities.update');
            Route::delete('/hr/admin/setting/nationalities/delete/{id}', 'delete')->name('hr.admin.setting.nationalities.delete');
            Route::post('/hr/admin/setting/nationalities/store', 'store')->name('hr.admin.setting.nationalities.store');
        });

        ////Department route
        Route::controller(SettingDepartmentController::class)->group(function () {
            Route::get('/hr/admin/setting/departments', 'index')->name('hr.admin.setting.departments');
            Route::get('/hr/admin/setting/departments/list', 'list')->name('hr.admin.setting.departments.list');
            Route::get('/hr/admin/setting/departments/get/{id}', 'get')->name('hr.admin.setting.departments.get');
            Route::post('/hr/admin/setting/departments/update', 'update')->name('hr.admin.setting.departments.update');
            Route::delete('/hr/admin/setting/departments/delete/{id}', 'delete')->name('hr.admin.setting.departments.delete');
            Route::post('/hr/admin/setting/departments/store', 'store')->name('hr.admin.setting.departments.store');
        });

        ////Entities route
        Route::controller(SettingEntityController::class)->group(function () {
            Route::get('/hr/admin/setting/entities', 'index')->name('hr.admin.setting.entities');
            Route::get('/hr/admin/setting/entities/list', 'list')->name('hr.admin.setting.entities.list');
            Route::get('/hr/admin/setting/entities/get/{id}', 'get')->name('hr.admin.setting.entities.get');
            Route::post('/hr/admin/setting/entities/update', 'update')->name('hr.admin.setting.entities.update');
            Route::delete('/hr/admin/setting/entities/delete/{id}', 'delete')->name('hr.admin.setting.entities.delete');
            Route::post('/hr/admin/setting/entities/store', 'store')->name('hr.admin.setting.entities.store');
        });


        ////Directorate route
        Route::controller(SettingDirectorateController::class)->group(function () {
            Route::get('/hr/admin/setting/directorates', 'index')->name('hr.admin.setting.directorates');
            Route::get('/hr/admin/setting/directorates/list', 'list')->name('hr.admin.setting.directorates.list');
            Route::get('/hr/admin/setting/directorates/get/{id}', 'get')->name('hr.admin.setting.directorates.get');
            Route::post('/hr/admin/setting/directorates/update', 'update')->name('hr.admin.setting.directorates.update');
            Route::delete('/hr/admin/setting/directorates/delete/{id}', 'delete')->name('hr.admin.setting.directorates.delete');
            Route::post('/hr/admin/setting/directorates/store', 'store')->name('hr.admin.setting.directorates.store');
        });

        ////Relationship route
        Route::controller(SettingEmployeeRelationshipController::class)->group(function () {
            Route::get('/hr/admin/setting/relationships', 'index')->name('hr.admin.setting.relationships');
            Route::get('/hr/admin/setting/relationships/list', 'list')->name('hr.admin.setting.relationships.list');
            Route::get('/hr/admin/setting/relationships/get/{id}', 'get')->name('hr.admin.setting.relationships.get');
            Route::post('/hr/admin/setting/relationships/update', 'update')->name('hr.admin.setting.relationships.update');
            Route::delete('/hr/admin/setting/relationships/delete/{id}', 'delete')->name('hr.admin.setting.relationships.delete');
            Route::post('/hr/admin/setting/relationships/store', 'store')->name('hr.admin.setting.relationships.store');
        });

        // Leave Types routes
        Route::controller(SettingLeaveTypeController::class)->group(function () {
            Route::get('/hr/admin/setting/leavetypes', 'index')->name('hr.admin.setting.leavetypes');
            Route::get('/hr/admin/setting/leavetypes/list', 'list')->name('hr.admin.setting.leavetypes.list');
            Route::get('/hr/admin/setting/leavetypes/get/{id}', 'get')->name('hr.admin.setting.leavetypes.get');
            Route::post('/hr/admin/setting/leavetypes/update', 'update')->name('hr.admin.setting.leavetypes.update');
            Route::delete('/hr/admin/setting/leavetypes/delete/{id}', 'delete')->name('hr.admin.setting.leavetypes.delete');
            Route::post('/hr/admin/setting/leavetypes/store', 'store')->name('hr.admin.setting.leavetypes.store');
        });

        // Leave Types routes
        Route::controller(SettingLeaveTypeController::class)->group(function () {
            Route::get('/hr/admin/setting/leavetypes', 'index')->name('hr.admin.setting.leavetypes');
            Route::get('/hr/admin/setting/leavetypes/list', 'list')->name('hr.admin.setting.leavetypes.list');
            Route::get('/hr/admin/setting/leavetypes/get/{id}', 'get')->name('hr.admin.setting.leavetypes.get');
            Route::post('/hr/admin/setting/leavetypes/update', 'update')->name('hr.admin.setting.leavetypes.update');
            Route::delete('/hr/admin/setting/leavetypes/delete/{id}', 'delete')->name('hr.admin.setting.leavetypes.delete');
            Route::post('/hr/admin/setting/leavetypes/store', 'store')->name('hr.admin.setting.leavetypes.store');
        });

        // Element routes
        Route::controller(SettingElementController::class)->group(function () {
            Route::get('/hr/admin/setting/element/', 'index')->name('hr.admin.setting.element');
            Route::get('/hr/admin/setting/element/list', 'list')->name('hr.admin.setting.element.list');
            Route::get('/hr/admin/setting/element/get/{id}', 'get')->name('hr.admin.setting.element.get');
            Route::post('/hr/admin/setting/element/update', 'update')->name('hr.admin.setting.element.update');
            Route::delete('/hr/admin/setting/element/delete/{id}', 'delete')->name('hr.admin.setting.element.delete');
            Route::post('/hr/admin/setting/element/store', 'store')->name('hr.admin.setting.element.store');
        });

        // Element Classification routes
        Route::controller(SettingElementClassificationController::class)->group(function () {
            Route::get('/hr/admin/setting/element/classifications', 'index')->name('hr.admin.setting.element.classifications');
            Route::get('/hr/admin/setting/element/classifications/list', 'list')->name('hr.admin.setting.element.classifications.list');
            Route::get('/hr/admin/setting/element/classifications/get/{id}', 'get')->name('hr.admin.setting.element.classifications.get');
            Route::post('/hr/admin/setting/element/classifications/update', 'update')->name('hr.admin.setting.element.classifications.update');
            Route::delete('/hr/admin/setting/element/classifications/delete/{id}', 'delete')->name('hr.admin.setting.element.classifications.delete');
            Route::post('/hr/admin/setting/element/classifications/store', 'store')->name('hr.admin.setting.element.classifications.store');
        });

        // Element set routes
        Route::controller(SettingElementSetController::class)->group(function () {
            Route::get('/hr/admin/setting/elementset/', 'index')->name('hr.admin.setting.elementset');
            Route::get('/hr/admin/setting/elementset/list', 'list')->name('hr.admin.setting.elementset.list');
            Route::get('/hr/admin/setting/elementset/get/{id}', 'get')->name('hr.admin.setting.elementset.get');
            Route::post('/hr/admin/setting/elementset/update', 'update')->name('hr.admin.setting.elementset.update');
            Route::delete('/hr/admin/setting/elementset/delete/{id}', 'delete')->name('hr.admin.setting.elementset.delete');
            Route::post('/hr/admin/setting/elementset/store', 'store')->name('hr.admin.setting.elementset.store');
            Route::get('/hr/admin/setting/elementset/assignment', 'AssignElements')->name('hr.admin.setting.elementset.assignment');
        });

        // Element set assignments routes
        // Route::controller(SettingElementSetAssignmentController::class)->group(function () {
        //     Route::get('/hr/admin/setting/elementset/assignment', 'index')->name('hr.admin.setting.elementset.assignment');
        //     Route::get('/hr/admin/setting/elementset/assignment/list/{id?}', 'list')->name('hr.admin.setting.elementset.assignment.list');
        //     Route::get('/hr/admin/setting/elementset/assignment/get/{id}', 'get')->name('hr.admin.setting.elementset.assignment.get');
        //     Route::post('/hr/admin/setting/elementset/assignment/update', 'update')->name('hr.admin.setting.elementset.assignment.update');
        //     Route::delete('/hr/admin/setting/elementset/assignment/delete/{id}', 'delete')->name('hr.admin.setting.elementset.assignment.delete');
        //     Route::post('/hr/admin/setting/elementset/assignment/store', 'store')->name('hr.admin.setting.elementset.assignment.store');
        // });

        //Pay Cyle routes
        Route::controller(SettingPayCycleController::class)->group(function () {
            Route::get('/hr/admin/setting/paycycle', 'index')->name('hr.admin.setting.paycycle');
            Route::get('/hr/admin/setting/paycycle/list', 'list')->name('hr.admin.setting.paycycle.list');
            Route::get('/hr/admin/setting/paycycle/get/{id}', 'get')->name('hr.admin.setting.paycycle.get');
            Route::post('/hr/admin/setting/paycycle/update', 'update')->name('hr.admin.setting.paycycle.update');
            Route::delete('/hr/admin/setting/paycycle/delete/{id}', 'delete')->name('hr.admin.setting.paycycle.delete');
            Route::post('/hr/admin/setting/paycycle/store', 'store')->name('hr.admin.setting.paycycle.store');
        });

        //Invoice Notes routes
        Route::controller(SettingEmployeeTimeSheetInvoice::class)->group(function () {
            Route::get('/hr/admin/setting/invoice/notes', 'index')->name('hr.admin.setting.invoice.notes');
            Route::get('/hr/admin/setting/invoice/notes/list', 'list')->name('hr.admin.setting.invoice.notes.list');
            Route::get('/hr/admin/setting/invoice/notes/get/{id}', 'get')->name('hr.admin.setting.invoice.notes.get');
            Route::post('/hr/admin/setting/invoice/notes/update', 'update')->name('hr.admin.setting.invoice.notes.update');
            Route::delete('/hr/admin/setting/invoice/notes/delete/{id}', 'delete')->name('hr.admin.setting.invoice.notes.delete');
            Route::post('/hr/admin/setting/invoice/notes/store', 'store')->name('hr.admin.setting.invoice.notes.store');
        });

        Route::controller(SettingActivityAuditController::class)->group(function () {
            Route::get('/hr/admin/setting/audit', 'index')->name('hr.admin.setting.audit')->middleware('permission:audit.show');
            Route::get('/hr/admin/setting/audit/list', 'list')->name('hr.admin.setting.audit.list')->middleware('permission:audit.show');
        });
    });

    // HRMS *********************************************************************** EMP All Route *****************************************************
    Route::middleware(['auth', 'otp', 'XssSanitizer', 'role:HRMS', 'roles:user', 'prevent-back-history', 'auth.session'])->group(function () {

        // Employee All Route 
        Route::controller(EmployeeController::class)->group(function () {
            Route::get('/hr/emp/dashboard/', 'index')->name('hr.emp.dashboard')->middleware('permission:employee.show');
        });

        Route::get('hr/emp/timesheet/invoice/{id}', [EmployeeTimeSheetInvoice::class, 'invoice'])->name('hr.emp.timesheet.invoice.pdf')->middleware('permission:employee.show');

        Route::controller(EmployeeTimeSheetController::class)->group(function () {
            Route::get('/hr/emp/timesheet',  'index')->name('hr.emp.timesheet')->middleware('permission:employee.show');
            Route::get('/hr/emp/timesheet/add',  'add')->name('hr.emp.timesheet.add')->middleware('permission:employee.create');
            Route::get('/hr/emp/timesheet/list/{id?}',  'list')->name('hr.emp.timesheet.list')->middleware('permission:employee.show');
            Route::post('/hr/emp/timesheet/store',  'store')->name('hr.emp.timesheet.store');
            Route::get('/hr/emp/timesheet/delete/{id}',  'delete')->name('hr.emp.timesheet.delete');
            Route::post('/hr/emp/timesheet/update',  'update')->name('hr.emp.timesheet.update');
            Route::get('/hr/emp/timesheet/mv/edit/{id}',  'getEmpTimeSheetEditView')->name('hr.emp.timesheet.rv.edit');
            Route::post('/hr/emp/timesheet/status/update',  'updateStatus')->name('hr.emp.timesheet.status.update');
            Route::get('/hr/emp/timesheet/status/edit/{id}',  'editStatus')->name('hr.emp.timesheet.status.edit');
        });

        // Time Sheet entries
        Route::controller(EmployeeTimeSheetEntryController::class)->group(function () {
            Route::get('hr/emp/timesheet/entries/{id}', 'index')->name('hr.emp.timesheet.entries')->middleware('permission:employee.show');
            Route::get('hr/emp/timesheet/entries/add/{id}', 'add')->name('hr.emp.timesheet.entries.add')->middleware(['permission:employee.show']);
            Route::get('hr/emp/timesheet/entries/list/{id}', 'list')->name('hr.emp.timesheet.entries.list')->middleware('permission:employee.show');
            Route::post('hr/emp/timesheet/entries/store', 'store')->name('hr.emp.timesheet.entries.store');
            Route::post('hr/emp/timesheet/entries/update', 'update')->name('hr.emp.timesheet.entries.update');
            Route::get('hr/emp/timesheet/entries/get/{id}', 'get')->name('hr.emp.timesheet.entries.rv.edit');
            Route::post('hr/emp/timesheet/entries/status/update', 'updateStatus')->name('hr.emp.timesheet.entries.status.update');
            Route::get('hr/emp/timesheet/entries/status/edit/{id}', 'editStatus')->name('hr.emp.timesheet.entries.status.edit');
        });

        // Emergency Contacts routes
        Route::controller(EmployeeEmergencyContactController::class)->group(function () {
            Route::get('/hr/emp/emergency', 'index')->name('hr.emp.emergency')->middleware('permission:employee.show');
            Route::get('/hr/emp/emergency/add', 'add')->name('hr.emp.emergency.add')->middleware('permission:employee.create');
            Route::get('/hr/emp/emergency/list/{id?}', 'list')->name('hr.emp.emergency.list')->middleware('permission:employee.show');
            Route::post('/hr/emp/emergency/store', 'store')->name('hr.emp.emergency.store');
            Route::get('/hr/emp/emergency/delete/{id}', 'delete')->name('hr.emp.emergency.delete');
            Route::get('/hr/emp/emergency/get/{id}', 'get')->name('hr.emp.emergency.get');
            Route::post('/hr/emp/emergency/update', 'update')->name('hr.emp.emergency.update');
            Route::get('/hr/emp/emergency/mv/edit/{id}', 'getEditView')->name('hr.emp.emergency.rv.edit');
        });
    });


    // HRMS *********************************************************************** Manager All Route
    // Route::middleware(['auth',  'role:HRMS|Manager', 'roles:user', 'prevent-back-history', 'auth.session'])->group(function () {
    Route::middleware(['auth', 'otp', 'XssSanitizer', 'role:HRMS|Manager', 'roles:user', 'prevent-back-history', 'auth.session'])->group(function () {

        // Employee All Route 
        Route::controller(ManagerManagerController::class)->group(function () {
            Route::get('/hr/manager', 'index')->name('hr.manager');
            Route::get('/hr/manager/list', 'list')->name('hr.manager.list');
            // Route::get('/hr/manager/get/{id}', 'get')->name('hr.manager.get');
        });

        Route::get('hr/emp/timesheet/invoice/{id}', [EmployeeTimeSheetInvoice::class, 'invoice'])->name('hr.emp.timesheet.invoice.pdf')->middleware('permission:employee.show');

        Route::controller(ManagerManagerTimesheetController::class)->group(function () {
            Route::get('/hr/manager/timesheet', 'index')->name('hr.manager.timesheet')->middleware('permission:employee.show');
            Route::get('/hr/manager/timesheet/list/{id?}', 'list')->name('hr.manager.timesheet.list')->middleware('permission:employee.show');
            Route::post('/hr/manager/timesheet/status/update', 'updateStatus')->name('hr.manager.timesheet.status.update');
            Route::get('/hr/manager/timesheet/status/edit/{id}', 'editStatus')->name('hr.manager.timesheet.status.edit');
            Route::get('/hr/manager/timesheet/entries/list/{id?}', 'list_entries')->name('hr.manager.timesheet.entries.list')->middleware('permission:employee.show');
            Route::get('/hr/manager/timesheet/entries/mv/get/{id}', 'getEntries')->name('tracki.employee.timesheet.manager.entries.mv.get');
        });
    });

    // HRMS *********************************************************************** Payroll All Route
    // Route::middleware(['auth',  'role:HRMS|Payroll', 'roles:user', 'prevent-back-history', 'auth.session'])->group(function () {
    Route::middleware(['auth', 'otp', 'XssSanitizer', 'role:HRMS|Payroll', 'roles:user', 'prevent-back-history', 'auth.session'])->group(function () {


        // Employee All Route 
        Route::controller(PayPayrollTimesheetController::class)->group(function () {
            Route::get('/hr/payroll/timesheet', 'index')->name('hr.payroll.timesheet')->middleware('permission:employee.show');
            Route::get('/hr/payroll/timesheet/review/{id}', 'reviewed')->name('hr.payroll.timesheet.review')->middleware('permission:employee.show');
            Route::get('/hr/payroll/timesheet/list/{id?}', 'list')->name('hr.payroll.timesheet.list');
            Route::get('/hr/payroll/timesheet/missing', 'missingTimesheet')->name('hr.payroll.timesheet.missing');
            Route::get('/hr/payroll/timesheet/missing/list', 'listMissingTimesheet')->name('hr.payroll.timesheet.missing.list');
        });

        Route::controller(PayPayrollBankController::class)->group(function () {
            Route::get('/hr/payroll/bank', 'index')->name('hr.payroll.bank')->middleware('permission:employee.show');
            Route::get('/hr/payroll/bank/list', 'list')->name('hr.payroll.bank.list')->middleware('permission:employee.show');
            Route::get('/hr/payroll/payment', 'payment_index')->name('hr.payroll.payment')->middleware('permission:employee.show');
            Route::get('/hr/payroll/payment/list', 'payment_list')->name('hr.payroll.payment.list')->middleware('permission:employee.show');
        });
    });


    Route::middleware(['auth', 'otp', 'XssSanitizer', 'auth.session'])->group(function () {

        Route::get('/', [EmployeeController::class, 'index'])->name('employee');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        // Route::get('/tracki/dashboard', [AdminController::class, 'trackiDashboard'])->name('tracki.dashboard');
        Route::get('/tracki/logout', [AdminController::class, 'logout'])->name('tracki.logout');
        Route::get('/tracki/profile', [AdminController::class, 'userProfile'])->name('tracki.profile');
        // Route::get('/tracki/orderform', [AdminController::class, 'orderForm'])->name('tracki.orderform');
        Route::post('/tracki/profile/store', [AdminController::class, 'trackiProfileStore'])->name('tracki.profile.store');

        //Audit
        // Route::get('/tracki/audit/hrms', [ActivityAuditController::class, 'index'])->name('tracki.audit.hrms')->middleware('permission:audit.show');
        // Route::get('/tracki/audit/hrms/list', [ActivityAuditController::class, 'list'])->name('tracki.audit.hrms.list')->middleware('permission:audit.show');

        Route::get('/tracki/employee/dashboard', [EmployeeDashboardController::class, 'dashboard'])->name('tracki.employee.dashboard')->middleware('permission:employee.dashboard');
        Route::get('tracki/employee/leave/mv/balance/{id}', [EmployeeController::class, 'balance'])->name('tracki.employee.leave.mv.balance')->middleware('permission:leave.show');

        //Employee files
        Route::get('/tracki/employee/files', [EmployeeAttachmentController::class, 'index'])->name('tracki.employee.files')->middleware('permission:employee.file.list');
        Route::get('/tracki/employee/files/list/{id?}', [EmployeeAttachmentController::class, 'list'])->name('tracki.employee.files.list')->middleware('permission:employee.file.list');
        Route::get('/tracki/employee/files/get/{id}', [EmployeeAttachmentController::class, 'get'])->name('tracki.employee.files.get');
        Route::post('tracki/employee/files/update', [EmployeeAttachmentController::class, 'update'])->name('tracki.employee.files.update');
        Route::delete('/tracki/employee/files/delete/{id}', [EmployeeAttachmentController::class, 'delete'])->name('tracki.employee.files.delete');
        Route::post('/tracki/employee/files/store', [EmployeeAttachmentController::class, 'store'])->name('tracki.employee.files.store');


        // Manager Leave
        Route::get('/tracki/employee/managers/leave', [ManagerLeaveController::class, 'index'])->name('tracki.employee.managers.leave')->middleware('permission:leave.show');;
        Route::get('/tracki/employee/managers/leave/list/{id?}', [ManagerLeaveController::class, 'list'])->name('tracki.employee.managers.leave.list')->middleware('permission:leave.show');;
        Route::post('tracki/employee/managers/leave/status/update', [ManagerLeaveController::class, 'updateStatus'])->name('tracki.employee.managers.leave.status.update')->middleware('permission:leave.show');
        Route::get('tracki/employee/managers/leave/status/edit/{id}', [ManagerLeaveController::class, 'editStatus'])->name('tracki.employee.managers.leave.status.edit')->middleware('permission:leave.show');


        //************************************ Setup Methods *************************************************** */
        // Event Category
        // Route::get('/tracki/setup/category-list', [SetupController::class, 'catEvent'])->name('tracki.setup.category');
        // Route::post('updatecat', [SetupController::class, 'updateEventCategory'])->name('tracki.setup.category.update');
        // Route::post('createcat', [SetupController::class, 'createEventCategory'])->name('tracki.setup.category.create');
        // Route::get('/tracki/setup/category/{id}/edit', [SetupController::class, 'editCategory'])->name('tracki.setup.category.show.edit');
        // Route::get('/tracki/setup/category/{id}/delete', [SetupController::class, 'deleteCategory'])->name('tracki.setup.category.delete');

        // // Event Audience
        // Route::get('/tracki/setup/audience-list', [SetupController::class, 'eventAudience'])->name('tracki.setup.audience');
        // Route::post('updateaudience', [SetupController::class, 'updateAudience'])->name('tracki.setup.audience.update');
        // Route::post('createaudience', [SetupController::class, 'createAudience'])->name('tracki.setup.audience.create');
        // Route::get('/tracki/setup/audience/{id}/edit', [SetupController::class, 'editAudience'])->name('tracki.setup.audience.show.edit');
        // Route::get('/tracki/setup/audience/{id}/delete', [SetupController::class, 'deleteAudience'])->name('tracki.setup.audience.delete');

        // Event Planner
        Route::get('/tracki/setup/planner-list', [SetupController::class, 'eventPlanner'])->name('tracki.setup.planner');
        Route::post('updateplanner', [SetupController::class, 'updatePlanner'])->name('tracki.setup.planner.update');
        Route::post('createplanner', [SetupController::class, 'createPlanner'])->name('tracki.setup.planner.create');
        Route::get('/tracki/setup/planner/{id}/edit', [SetupController::class, 'editPlanner'])->name('tracki.setup.planner.show.edit');
        Route::get('/tracki/setup/planner/{id}/delete', [SetupController::class, 'deletePlanner'])->name('tracki.setup.planner.delete');


        // Project Type
        Route::get('/tracki/setup/projecttype-list', [SetupController::class, 'projectType'])->name('tracki.setup.projecttype');
        Route::post('updateprojecttype', [SetupController::class, 'updateProjectType'])->name('tracki.setup.projecttype.update');
        Route::post('createprojecttype', [SetupController::class, 'createProjectType'])->name('tracki.setup.projecttype.create');
        Route::get('/tracki/setup/projecttype/{id}/edit', [SetupController::class, 'editProjectType'])->name('tracki.setup.projecttype.show.edit');
        Route::get('/tracki/setup/projecttype/{id}/delete', [SetupController::class, 'deleteProjectType'])->name('tracki.setup.projecttype.delete');

        // Event Status
        Route::get('/tracki/setup/eventstatus-list', [SetupController::class, 'eventStatus'])->name('tracki.setup.eventstatus');
        Route::post('updateeventstatus', [SetupController::class, 'updateEventStatus'])->name('tracki.setup.eventstatus.update');
        Route::post('createeventstatus', [SetupController::class, 'createEventStatus'])->name('tracki.setup.eventstatus.create');
        Route::get('/tracki/setup/eventstatus/{id}/edit', [SetupController::class, 'editEventStatus'])->name('tracki.setup.eventstatus.show.edit');
        Route::get('/tracki/setup/eventstatus/{id}/delete', [SetupController::class, 'deleteEventStatus'])->name('tracki.setup.eventstatus.delete');

        //Status
        Route::get('/tracki/setup/status/manage', [StatusController::class, 'index'])->name('tracki.setup.status.manage');
        Route::get('/tracki/setup/status/list', [StatusController::class, 'list'])->name('tracki.setup.status.list');
        Route::get('/tracki/setup/status/{id}/get', [StatusController::class, 'get'])->name('tracki.setup.status.get');
        Route::post('tracki/setup/status/update', [StatusController::class, 'update'])->name('tracki.setup.status.update');
        Route::delete('/tracki/setup/status/{id}/delete', [StatusController::class, 'delete'])->name('tracki.setup.status.delete');
        Route::post('/tracki/setup/status/store', [StatusController::class, 'store'])->name('tracki.setup.status.store');

        // Priority
        Route::get('/tracki/setup/priority/manage', [PriorityController::class, 'index'])->name('tracki.setup.priority.manage');
        Route::get('/tracki/setup/priority/list', [PriorityController::class, 'list'])->name('tracki.setup.priority.list');
        Route::get('/tracki/setup/priority/{id}/get', [PriorityController::class, 'get'])->name('tracki.setup.priority.get');
        Route::post('tracki/setup/priority/update', [PriorityController::class, 'update'])->name('tracki.setup.priority.update');
        Route::delete('/tracki/setup/priority/{id}/delete', [PriorityController::class, 'delete'])->name('tracki.setup.priority.delete');
        Route::post('/tracki/setup/priority/store', [PriorityController::class, 'store'])->name('tracki.setup.priority.store');

        // Tags
        Route::get('/tracki/setup/tags', [TagsController::class, 'index'])->name('tracki.setup.tags');
        Route::get('/tracki/setup/tags/list', [TagsController::class, 'list'])->name('tracki.setup.tags.list');
        Route::get('/tracki/setup/tags/{id}/get', [TagsController::class, 'get'])->name('tracki.setup.tags.get');
        Route::post('tracki/setup/tags/update', [TagsController::class, 'update'])->name('tracki.setup.tags.update');
        Route::delete('/tracki/setup/tags/{id}/delete', [TagsController::class, 'delete'])->name('tracki.setup.tags.delete');
        Route::post('/tracki/setup/tags/store', [TagsController::class, 'store'])->name('tracki.setup.tags.store');

        // Users
        Route::get('/tracki/users/{id}/details', [UserController::class, 'details'])->name('tracki.users.details');

        //clients
        Route::get('/tracki/clients/manage', [ClientController::class, 'index'])->name('tracki.client.manage');
        Route::get('/tracki/clients/create', [ClientController::class, 'create'])->name('tracki.client.create');
        Route::post('/tracki/clients/store', [ClientController::class, 'store'])->name('tracki.client.store');
        Route::get('tracki/clients/all', [ClientController::class, 'get'])->name('tracki.client.all');


        // Workspace
        Route::get('/tracki/setup/workspace', [WorkspaceController::class, 'index'])->name('tracki.setup.workspace');
        Route::get('/tracki/setup/workspace/list', [WorkspaceController::class, 'list'])->name('tracki.setup.workspace.list');
        Route::get('/tracki/setup/workspace/{id}/get', [WorkspaceController::class, 'get'])->name('tracki.setup.workspace.get');
        Route::post('tracki/setup/workspace/update', [WorkspaceController::class, 'update'])->name('tracki.setup.workspace.update');
        Route::get('/tracki/setup/workspace/{id}/delete', [WorkspaceController::class, 'delete'])->name('tracki.setup.workspace.delete');
        Route::post('/tracki/setup/workspace/store', [WorkspaceController::class, 'store'])->name('tracki.setup.workspace.store');
        Route::get('/tracki/setup/workspace/{id}/switch', [WorkspaceController::class, 'switch'])->name('tracki.setup.workspace.switch');

        Route::get('/tracki/setup/usertype-list', [SetupController::class, 'UserType'])->name('tracki.setup.usertype');
        Route::post('updateusertype', [SetupController::class, 'updateUserType'])->name('tracki.setup.usertype.update');
        Route::post('createusertype', [SetupController::class, 'createUserType'])->name('tracki.setup.usertype.create');
        Route::get('/tracki/setup/usertype/{id}/edit', [SetupController::class, 'editUserType'])->name('tracki.setup.usertype.show.edit');
        Route::get('/tracki/setup/usertype/{id}/delete', [SetupController::class, 'deleteUserType'])->name('tracki.setup.usertype.delete');
        // Route::get('/tracki/setup/fa-add', [SetupController::class, 'addFA'])->name('tracki.setup.fa.add');

        // Operations Type
        Route::get('/tracki/setup/operation-list', [SetupController::class, 'operation'])->name('tracki.setup.operation');
        Route::post('updateoperation', [SetupController::class, 'updateOperation'])->name('tracki.setup.operation.update');
        Route::post('createoperation', [SetupController::class, 'createOperation'])->name('tracki.setup.operation.create');
        Route::get('/tracki/setup/operation/{id}/edit', [SetupController::class, 'editOperation'])->name('tracki.setup.operation.show.edit');
        Route::get('/tracki/setup/operation/{id}/delete', [SetupController::class, 'deleteOperation'])->name('tracki.setup.operation.delete');

        // Budget Names
        Route::get('/tracki/setup/budget-list', [SetupController::class, 'budget'])->name('tracki.setup.budget');
        Route::post('updatebudget', [SetupController::class, 'updateBudget'])->name('tracki.setup.budget.update');
        Route::post('createbudget', [SetupController::class, 'createBudget'])->name('tracki.setup.budget.create');
        Route::get('/tracki/setup/budget/{id}/edit', [SetupController::class, 'editBudget'])->name('tracki.setup.budget.show.edit');
        Route::get('/tracki/setup/budget/{id}/delete', [SetupController::class, 'deleteBudget'])->name('tracki.setup.budget.delete');

        // Segments Type
        Route::get('/tracki/setup/segment-list', [SetupController::class, 'segment'])->name('tracki.setup.segment');
        Route::post('updatesegment', [SetupController::class, 'updateSegment'])->name('tracki.setup.segment.update');
        Route::post('createsegment', [SetupController::class, 'createSegment'])->name('tracki.setup.segment.create');
        Route::get('/tracki/setup/segment/{id}/edit', [SetupController::class, 'editSegment'])->name('tracki.setup.segment.show.edit');
        Route::get('/tracki/setup/segment/{id}/delete', [SetupController::class, 'deleteSegment'])->name('tracki.setup.segment.delete');

        // Location
        Route::get('/tracki/setup/locations', [LocationController::class, 'index'])->name('tracki.setup.locations');
        Route::get('/tracki/setup/locations/list', [LocationController::class, 'list'])->name('tracki.setup.locations.list');
        Route::get('/tracki/setup/locations/{id}/get', [LocationController::class, 'get'])->name('tracki.setup.locations.get');
        Route::post('tracki/setup/locations/update', [LocationController::class, 'update'])->name('tracki.setup.locations.update');
        Route::delete('/tracki/setup/locations/{id}/delete', [LocationController::class, 'delete'])->name('tracki.setup.locations.delete');
        Route::post('/tracki/setup/locations/store', [LocationController::class, 'store'])->name('tracki.setup.locations.store');

        // Venue
        Route::get('/tracki/setup/venue', [VenueController::class, 'index'])->name('tracki.setup.venue');
        Route::get('/tracki/setup/venue/list', [VenueController::class, 'list'])->name('tracki.setup.venue.list');
        Route::get('/tracki/setup/venue/{id}/get', [VenueController::class, 'get'])->name('tracki.setup.venue.get');
        Route::post('tracki/setup/venue/update', [VenueController::class, 'update'])->name('tracki.setup.venue.update');
        Route::delete('/tracki/setup/venue/{id}/delete', [VenueController::class, 'delete'])->name('tracki.setup.venue.delete');
        Route::post('/tracki/setup/venue/store', [VenueController::class, 'store'])->name('tracki.setup.venue.store');

        // Fund Category
        Route::get('/tracki/setup/fundcategory-list', [SetupController::class, 'fundCategory'])->name('tracki.setup.fundcategory');
        Route::post('updateFundCategory', [SetupController::class, 'updateFundCategory'])->name('tracki.setup.fundcategory.update');
        Route::post('createFundCategory', [SetupController::class, 'createFundCategory'])->name('tracki.setup.fundcategory.create');
        Route::get('/tracki/setup/fundcategory/{id}/edit', [SetupController::class, 'editFundCategory'])->name('tracki.setup.fundcategory.show.edit');
        Route::get('/tracki/setup/fundcategory/{id}/delete', [SetupController::class, 'deleteFundCategory'])->name('tracki.setup.fundcategory.delete');

        // Person
        Route::get('/tracki/setup/person-list', [SetupController::class, 'person'])->name('tracki.setup.person');
        Route::post('updateperson', [SetupController::class, 'updatePerson'])->name('tracki.setup.person.update');
        Route::post('createperson', [SetupController::class, 'createPerson'])->name('tracki.setup.person.create');
        Route::get('/tracki/setup/person/{id}/edit', [SetupController::class, 'editPerson'])->name('tracki.setup.person.show.edit');
        Route::get('/tracki/setup/person/{id}/delete', [SetupController::class, 'deletePerson'])->name('tracki.setup.person.delete');

        // color
        Route::get('/tracki/setup/color-list', [SetupController::class, 'color'])->name('tracki.setup.color');
        Route::post('updatecolor', [SetupController::class, 'updateColor'])->name('tracki.setup.color.update');
        Route::post('createcolor', [SetupController::class, 'createColor'])->name('tracki.setup.color.create');
        Route::get('/tracki/setup/color/{id}/edit', [SetupController::class, 'editColor'])->name('tracki.setup.color.show.edit');
        Route::get('/tracki/setup/color/{id}/delete', [SetupController::class, 'deleteColor'])->name('tracki.setup.color.delete');
    });

    require __DIR__ . '/auth.php';


    Route::middleware(['auth'])->group(function () {
        Route::get('tracki/auth/otp', [AdminController::class, 'showOtp'])->name('otp.get');
        Route::post('verify-otp', [AdminController::class, 'verifyOtpAndLogin'])->name('auth.otp.post');
        Route::get('tracki/auth/resend', [AdminController::class, 'resendOTP'])->name('otp.resend.get');
    });

    Route::middleware(['prevent-back-history'])->group(function () {

        Route::get('/tracki/auth/signin', [AdminController::class, 'signIn'])->name('tracki.auth.signin')->middleware('prevent-back-history');
        Route::post('/login', [AdminController::class, 'login'])->name('tracki.auth.login');

        Route::get('/tracki/auth/forgot', [AdminController::class, 'forgotPassword'])->name('tracki.auth.forgot');
        Route::post('forget-password', [AdminController::class, 'submitForgetPasswordForm'])->name('forgot.password.post');
        Route::get('tracki/auth/reset/{token}', [AdminController::class, 'showResetPasswordForm'])->name('reset.password.get');

        Route::post('reset-password', [AdminController::class, 'submitResetPasswordForm'])->name('reset.password.post');

        Route::get('/send-mail', [SendMailController::class, 'index']);
        Route::get('/send-mail2', [SendMailController::class, 'sendTaskAssignmentEmail']);

        Route::get('/send', [SendMailController::class, 'sendTaskAssignmentNotifcation']);
        Route::get('/whatsapp', [CommunicationChannels::class, 'sendWhatsapp'])->name('whatsapp.send');
    });

    // Route::get('/run-migration', function () {
    //     Artisan::call('optimize:clear');

    //     Artisan::call('migrate:refresh --seed');
    //     return "Migration executed successfully";
    // });

});
