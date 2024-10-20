<?php

use App\Http\Controllers\AddressTypeController;
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
use App\Http\Controllers\EmployeeAddressController;
use App\Http\Controllers\EmployeeAttachmentController;
use App\Http\Controllers\EmployeeBankController;
use App\Http\Controllers\EmployeeContractTypeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeDashboardController;
use App\Http\Controllers\EmployeeEmergencyContactController;
use App\Http\Controllers\EmployeeLeaveController;
use App\Http\Controllers\EmployeeRelationshipController;
use App\Http\Controllers\EmployeeSalaryController;
use App\Http\Controllers\EmployeeSponsorshipController;
use App\Http\Controllers\EmployeeTimeSheetController;
use App\Http\Controllers\EmployeeTimeSheetEntryController;
use App\Http\Controllers\EmployeeTimeSheetInvoice;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\FunctionalAreaController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\JobLevelController;
use App\Http\Controllers\KanbanController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ManagerLeaveController;
use App\Http\Controllers\ManagerTimesheetController;
use App\Http\Controllers\MaritalStatusController;
use App\Http\Controllers\NationalityController;
use App\Http\Controllers\PayrollBankController;
use App\Http\Controllers\PayrollTimesheetController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\RandomController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\SubtaskController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VenueController;
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
Route::group(['middleware' => 'prevent-back-history'], function () {
    Route::middleware(['auth', 'roles:admin', 'role:SuperAdmin', 'prevent-back-history'])->group(function () {

        // Role
        Route::get('/tracki/sec/roles/add', function () {
            return view('/tracki/sec/roles/add');
        })->name('tracki.sec.roles.add');
        Route::get('/tracki/sec/roles/roles/list', [RoleController::class, 'listRole'])->name('tracki.sec.roles.list');
        Route::post('updaterole', [RoleController::class, 'updateRole'])->name('tracki.sec.roles.update');
        Route::post('createrole', [RoleController::class, 'createRole'])->name('tracki.sec.roles.create');
        Route::get('/tracki/sec/roles/{id}/edit', [RoleController::class, 'editRole'])->name('tracki.sec.roles.edit');
        Route::get('/tracki/sec/roles/{id}/delete', [RoleController::class, 'deleteRole'])->name('tracki.sec.roles.delete');

        // group
        Route::get('/tracki/sec/groups/add', function () {
            return view('/tracki/sec/groups/add');
        })->name('tracki.sec.groups.add');
        Route::get('/tracki/sec/groups/groups/list', [RoleController::class, 'listGroup'])->name('tracki.sec.groups.list');
        Route::post('updategroup', [RoleController::class, 'updateGroup'])->name('tracki.sec.groups.update');
        Route::post('creategroup', [RoleController::class, 'createGroup'])->name('tracki.sec.groups.create');
        Route::get('/tracki/sec/groups/{id}/edit', [RoleController::class, 'editGroup'])->name('tracki.sec.groups.edit');
        Route::get('/tracki/sec/groups/{id}/delete', [RoleController::class, 'deleteGroup'])->name('tracki.sec.groups.delete');

        // Permission
        Route::get('/tracki/sec/permissions/list', [RoleController::class, 'listPermission'])->name('tracki.sec.perm.list');
        Route::post('updatepermission', [RoleController::class, 'updatePermission'])->name('tracki.sec.perm.update');
        Route::post('createpermission', [RoleController::class, 'createPermission'])->name('tracki.sec.perm.create');
        Route::get('/tracki/sec/perm/{id}/edit', [RoleController::class, 'editPermission'])->name('tracki.sec.perm.edit');
        Route::get('/tracki/sec/perm/{id}/delete', [RoleController::class, 'deletePermission'])->name('tracki.sec.perm.delete');
        Route::get('/tracki/sec/permissions/add', [RoleController::class, 'addPermission'])->name('tracki.sec.perm.add');

        Route::get('/tracki/sec/perm/import', [RoleController::class, 'ImportPermission'])->name('tracki.sec.perm.import');
        Route::post('importnow', [RoleController::class, 'ImportNowPermission'])->name('tracki.sec.perm.import.now');


        // Roles in Permission
        Route::get('/tracki/sec/rolesetup/list', [RoleController::class, 'listRolePermission'])->name('tracki.sec.rolesetup.list');
        Route::post('updaterolesetup', [RoleController::class, 'updateRolePermission'])->name('tracki.sec.rolesetup.update');
        Route::post('createrolesetup', [RoleController::class, 'createRolePermission'])->name('tracki.sec.rolesetup.create');
        Route::get('/tracki/sec/rolesetup/{id}/edit', [RoleController::class, 'editRolePermission'])->name('tracki.sec.rolesetup.edit');
        Route::get('/tracki/sec/rolesetup/{id}/delete', [RoleController::class, 'deleteRolePermission'])->name('tracki.sec.rolesetup.delete');
        Route::get('/tracki/sec/rolesetup/add', [RoleController::class, 'addRolePermission'])->name('tracki.sec.rolesetup.add');

        // Add User
        Route::get('/tracki/auth/signup', [AdminController::class, 'signUp'])->name('tracki.auth.signup');
        Route::post('/admin/signup/create', [AdminController::class, 'createUser'])->name('admin.signup.create');
    });  // End group Admin middleware

    Route::middleware(['auth',  'role:Admin|SuperAdmin|Functional Admin', 'roles:admin', 'prevent-back-history'])->group(function () {
        // Admin User
        Route::get('/tracki/sec/adminuser/list', [RoleController::class, 'listAdminUser'])->name('tracki.sec.adminuser.list');
        Route::post('updateadminuser', [RoleController::class, 'updateAdminUser'])->name('tracki.sec.adminuser.update');

        Route::post('createadminuser', [RoleController::class, 'createAdminUser'])->name('tracki.sec.adminuser.create');
        Route::get('/tracki/sec/adminuser/{id}/edit', [RoleController::class, 'editAdminUser'])->name('tracki.sec.adminuser.edit');
        Route::get('/tracki/sec/adminuser/{id}/delete', [RoleController::class, 'deleteAdminUser'])->name('tracki.sec.adminuser.delete');
        Route::get('/tracki/sec/adminuser/add', [RoleController::class, 'addAdminUser'])->name('tracki.sec.adminuser.add');
    });  //

    Route::middleware(['auth', 'prevent-back-history'])->group(function () {


        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        // Route::get('/tracki/dashboard', [AdminController::class, 'trackiDashboard'])->name('tracki.dashboard');
        Route::get('/', [EmployeeDashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('/tracki/logout', [AdminController::class, 'logout'])->name('tracki.logout');
        Route::get('/tracki/profile', [AdminController::class, 'userProfile'])->name('tracki.profile');
        Route::get('/tracki/orderform', [AdminController::class, 'orderForm'])->name('tracki.orderform');
        Route::post('/tracki/profile/store', [AdminController::class, 'trackiProfileStore'])->name('tracki.profile.store');


        // Employees
        Route::get('/tracki/employee/', [EmployeeController::class, 'index'])->name('tracki.employee')->middleware('permission:employee.show');
        Route::get('/tracki/employee/add', [EmployeeController::class, 'add'])->name('tracki.employee.add')->middleware('permission:employee.create');
        Route::get('/tracki/employee/list', [EmployeeController::class, 'list'])->name('tracki.employee.show')->middleware('permission:employee.show');
        Route::post('/tracki/employee/store', [EmployeeController::class, 'store'])->name('tracki.employee.store')->middleware('permission:employee.create');
        Route::get('/tracki/employee/profile/{id}', [EmployeeController::class, 'profile'])->name('tracki.employee.profile')->middleware('permission:employee.show');
        Route::get('tracki/employee/{id}/delete', [EmployeeController::class, 'delete'])->name('tracki.employee.delete')->middleware('permission:employee.delete');
        Route::post('/tracki/employee/update', [EmployeeController::class, 'update'])->name('tracki.employee.update')->middleware('permission:employee.edit');
        Route::get('/tracki/employee/mv/edit/{id}', [EmployeeController::class, 'getEmpEditView'])->name('tracki.employee.rv.edit')->middleware('permission:employee.edit');
        Route::get('/tracki/employee/mv/duplicate/{id}', [EmployeeController::class, 'duplicate_employee_view'])->name('tracki.employee.mv.duplicate')->middleware('permission:employee.edit');
        Route::get('/tracki/employee/create', [EmployeeController::class, 'create'])->name('tracki.employee.create')->middleware('permission:employee.create');
        Route::get('/tracki/employee/project/{id?}', [EmployeeController::class, 'getProjectData'])->name('tracki.employee.project')->middleware('permission:employee.project');
        Route::get('/tracki/employee/task/{id?}', [EmployeeController::class, 'getTaskData'])->name('tracki.employee.task')->middleware('permission:employee.task');

        Route::get('/tracki/employee/dashboard', [EmployeeDashboardController::class, 'dashboard'])->name('tracki.employee.dashboard')->middleware('permission:employee.dashboard');
        Route::get('tracki/employee/leave/mv/balance/{id}', [EmployeeController::class, 'balance'])->name('tracki.employee.leave.mv.balance');

        //Employee files
        Route::get('/tracki/employee/files', [EmployeeAttachmentController::class, 'index'])->name('tracki.employee.files');
        Route::get('/tracki/employee/files/list/{id?}', [EmployeeAttachmentController::class, 'list'])->name('tracki.employee.files.list');
        Route::get('/tracki/employee/files/get/{id}', [EmployeeAttachmentController::class, 'get'])->name('tracki.employee.files.get');
        Route::post('tracki/employee/files/update', [EmployeeAttachmentController::class, 'update'])->name('tracki.employee.files.update');
        Route::delete('/tracki/employee/files/delete/{id}', [EmployeeAttachmentController::class, 'delete'])->name('tracki.employee.files.delete');
        Route::post('/tracki/employee/files/store', [EmployeeAttachmentController::class, 'store'])->name('tracki.employee.files.store');

        //Manager
        Route::get('/tracki/employee/managers', [ManagerController::class, 'index'])->name('tracki.employee.managers');
        Route::get('/tracki/employee/managers/list/{id?}', [ManagerController::class, 'list'])->name('tracki.employee.managers.list');
        Route::get('/tracki/employee/managers/get/{id}', [ManagerController::class, 'get'])->name('tracki.employee.managers.get');


        // Manager Leave
        Route::get('/tracki/employee/managers/leave', [ManagerLeaveController::class, 'index'])->name('tracki.employee.managers.leave')->middleware('permission:employee.show');
        Route::get('/tracki/employee/managers/leave/list/{id?}', [ManagerLeaveController::class, 'list'])->name('tracki.employee.managers.leave.list')->middleware('permission:employee.show');
        Route::post('tracki/employee/managers/leave/status/update', [ManagerLeaveController::class, 'updateStatus'])->name('tracki.employee.managers.leave.status.update');
        Route::get('tracki/employee/managers/leave/status/edit/{id}', [ManagerLeaveController::class, 'editStatus'])->name('tracki.employee.managers.leave.status.edit');

        // Manager Timesheet
        Route::get('/tracki/employee/managers/timesheet', [ManagerTimesheetController::class, 'index'])->name('tracki.employee.managers.timesheet')->middleware('permission:employee.show');
        Route::get('/tracki/employee/managers/timesheet/list/{id?}', [ManagerTimesheetController::class, 'list'])->name('tracki.employee.managers.timesheet.list')->middleware('permission:employee.show');
        Route::post('tracki/employee/managers/timesheet/status/update', [ManagerTimesheetController::class, 'updateStatus'])->name('tracki.employee.managers.timesheet.status.update');
        Route::get('tracki/employee/managers/timesheet/status/edit/{id}', [ManagerTimesheetController::class, 'editStatus'])->name('tracki.employee.managers.timesheet.status.edit');
        Route::get('/tracki/employee/managers/timesheet/entries/list/{id?}', [ManagerTimesheetController::class, 'list_entries'])->name('tracki.employee.managers.timesheet.entries.list')->middleware('permission:employee.show');
        Route::get('/tracki/employee/managers/timesheet/entries/mv/get/{id}', [ManagerTimesheetController::class, 'getEntries'])->name('tracki.employee.timesheet.manager.entries.mv.get');

        // Payroll
        //*********timesheet */
        Route::get('/tracki/payroll/timesheet', [PayrollTimesheetController::class, 'index'])->name('tracki.payroll.timesheet')->middleware('permission:employee.show');
        Route::get('/tracki/payroll/timesheet/review/{id}', [PayrollTimesheetController::class, 'reviewed'])->name('tracki.payroll.timesheet.review')->middleware('permission:employee.show');
        Route::get('/tracki/payroll/timesheet/list/{id?}', [PayrollTimesheetController::class, 'list'])->name('tracki.payroll.timesheet.list');
        Route::get('/tracki/payroll/timesheet/missing', [PayrollTimesheetController::class, 'missingTimesheet'])->name('tracki.payroll.timesheet.missing');
        Route::get('/tracki/payroll/timesheet/missing/list', [PayrollTimesheetController::class, 'listMissingTimesheet'])->name('tracki.payroll.timesheet.missing.list');

        // **************bank
        Route::get('/tracki/payroll/bank', [PayrollBankController::class, 'index'])->name('tracki.payroll.bank')->middleware('permission:employee.show');
        Route::get('/tracki/payroll/bank/list', [PayrollBankController::class, 'list'])->name('tracki.payroll.bank.list')->middleware('permission:employee.show');


        // Employee Address
        // Route::get('/tracki/employee/address/{id}', [EmployeeAddressController::class, 'index'])->name('tracki.employee.address')->middleware('permission:employee.show');
        Route::get('/tracki/employee/address/add', [EmployeeAddressController::class, 'add'])->name('tracki.employee.address.add')->middleware('permission:employee.create');
        Route::get('/tracki/employee/address/list/{id?}', [EmployeeAddressController::class, 'list'])->name('tracki.employee.address.show')->middleware('permission:employee.show');
        // Route::get('/tracki/employee/address/show', [EmployeeAddressController::class, 'list'])->name('tracki.employee.address.show')->middleware('permission:employee.show');
        Route::post('/tracki/employee/address/store', [EmployeeAddressController::class, 'store'])->name('tracki.employee.address.store');
        Route::get('tracki/employee/address/delete/{id}', [EmployeeAddressController::class, 'delete'])->name('tracki.employee.address.delete');
        Route::post('/tracki/employee/address/address/update', [EmployeeAddressController::class, 'update'])->name('tracki.employee.address.update');
        Route::get('/tracki/employee/address/mv/edit/{id}', [EmployeeAddressController::class, 'getAddressEditView'])->name('tracki.employee.address.mv.edit');
        // Route::get('/tracki/employee/address/create', [EmployeeAddressController::class, 'create'])->name('tracki.employee.address.create');

        // Employee Emergency Contacts
        Route::get('/tracki/employee/emergency', [EmployeeEmergencyContactController::class, 'index'])->name('tracki.employee.emergency')->middleware('permission:employee.show');
        Route::get('/tracki/employee/emergency/add', [EmployeeEmergencyContactController::class, 'add'])->name('tracki.employee.emergency.add')->middleware('permission:employee.create');
        Route::get('/tracki/employee/emergency/list/{id?}', [EmployeeEmergencyContactController::class, 'list'])->name('tracki.employee.emergency.list')->middleware('permission:employee.show');
        Route::post('/tracki/employee/emergency/store', [EmployeeEmergencyContactController::class, 'store'])->name('tracki.employee.emergency.store');
        Route::get('tracki/employee/emergency/delete/{id}', [EmployeeEmergencyContactController::class, 'delete'])->name('tracki.employee.emergency.delete');
        Route::get('tracki/employee/emergency/get/{id}', [EmployeeEmergencyContactController::class, 'get'])->name('tracki.employee.emergency.get');
        Route::post('/tracki/employee/emergency/update', [EmployeeEmergencyContactController::class, 'update'])->name('tracki.employee.emergency.update');
        Route::get('/tracki/employee/emergency/mv/edit/{id}', [EmployeeEmergencyContactController::class, 'getEmpEditView'])->name('tracki.employee.emergency.rv.edit');

        // Employee Salary
        Route::get('/tracki/employee/salary', [EmployeeSalaryController::class, 'index'])->name('tracki.employee.salary')->middleware('permission:employee.show');
        Route::get('/tracki/employee/salary/add', [EmployeeSalaryController::class, 'add'])->name('tracki.employee.salary.add')->middleware('permission:employee.create');
        Route::get('/tracki/employee/salary/list/{id?}', [EmployeeSalaryController::class, 'list'])->name('tracki.employee.salary.list')->middleware('permission:employee.show');
        // Route::get('/tracki/employee/salary/show', [EmployeeSalaryController::class, 'list'])->name('tracki.employee.salary.show')->middleware('permission:employee.show');
        Route::post('/tracki/employee/salary/store', [EmployeeSalaryController::class, 'store'])->name('tracki.employee.salary.store');
        Route::get('tracki/employee/salary/delete/{id}', [EmployeeSalaryController::class, 'delete'])->name('tracki.employee.salary.delete');
        Route::post('/tracki/employee/salary/salary/update', [EmployeeSalaryController::class, 'update'])->name('tracki.employee.salary.update');
        Route::get('/tracki/employee/salary/mv/edit/{id}', [EmployeeSalaryController::class, 'getEmpSalaryEditView'])->name('tracki.employee.salary.rv.edit');
        // Route::get('/tracki/employee/salary/create', [EmployeeSalaryController::class, 'create'])->name('tracki.employee.salary.create');

        // Employee Leave
        Route::get('/tracki/employee/leave', [EmployeeLeaveController::class, 'index'])->name('tracki.employee.leave')->middleware('permission:employee.show');
        Route::get('/tracki/employee/leave/add', [EmployeeLeaveController::class, 'add'])->name('tracki.employee.leave.add')->middleware('permission:employee.create');
        Route::get('/tracki/employee/leave/list/{id?}', [EmployeeLeaveController::class, 'list'])->name('tracki.employee.leave.list')->middleware('permission:employee.show');
        // Route::get('/tracki/employee/leave/show', [EmployeeLeaveController::class, 'list'])->name('tracki.employee.leave.show')->middleware('permission:employee.show');
        Route::post('/tracki/employee/leave/store', [EmployeeLeaveController::class, 'store'])->name('tracki.employee.leave.store');
        Route::get('tracki/employee/leave/delete/{id}', [EmployeeLeaveController::class, 'delete'])->name('tracki.employee.leave.delete');
        Route::post('/tracki/employee/leave/leave/update', [EmployeeLeaveController::class, 'update'])->name('tracki.employee.leave.update');
        Route::get('/tracki/employee/leave/mv/edit/{id}', [EmployeeLeaveController::class, 'getEmpLeaveEditView'])->name('tracki.employee.leave.rv.edit');
        Route::post('tracki/employee/leave/status/update', [EmployeeLeaveController::class, 'updateStatus'])->name('tracki.employee.leave.status.update');
        Route::get('tracki/employee/leave/status/edit/{id}', [EmployeeLeaveController::class, 'editStatus'])->name('tracki.employee.leave.status.edit');

        // Employee Bank
        Route::get('/tracki/employee/bank', [EmployeeBankController::class, 'index'])->name('tracki.employee.bank')->middleware('permission:employee.show');
        Route::get('/tracki/employee/bank/add', [EmployeeBankController::class, 'add'])->name('tracki.employee.bank.add')->middleware('permission:employee.create');
        Route::get('/tracki/employee/bank/list/{id?}', [EmployeeBankController::class, 'list'])->name('tracki.employee.bank.list')->middleware('permission:employee.show');
        Route::post('/tracki/employee/bank/store', [EmployeeBankController::class, 'store'])->name('tracki.employee.bank.store');
        Route::get('tracki/employee/bank/delete/{id}', [EmployeeBankController::class, 'delete'])->name('tracki.employee.bank.delete');
        Route::post('/tracki/employee/bank/bank/update', [EmployeeBankController::class, 'update'])->name('tracki.employee.bank.update');
        Route::get('/tracki/employee/bank/mv/edit/{id}', [EmployeeBankController::class, 'getEmpEditView'])->name('tracki.employee.bank.rv.edit');

        // Time Sheet
        Route::get('/tracki/employee/timesheet', [EmployeeTimeSheetController::class, 'index'])->name('tracki.employee.timesheet')->middleware('permission:employee.show');
        Route::get('/tracki/employee/timesheet/invoice/{id}', [EmployeeTimeSheetInvoice::class, 'invoice'])->name('tracki.employee.timesheet.invoice.pdf')->middleware('permission:employee.show');
        Route::get('/tracki/employee/timesheet/add', [EmployeeTimeSheetController::class, 'add'])->name('tracki.employee.timesheet.add')->middleware('permission:employee.create');
        Route::get('/tracki/employee/timesheet/list/{id?}', [EmployeeTimeSheetController::class, 'list'])->name('tracki.employee.timesheet.list')->middleware('permission:employee.show');
        // Route::get('/tracki/employee/timesheet/show', [EmployeeTimeSheetController::class, 'list'])->name('tracki.employee.timesheet.show')->middleware('permission:employee.show');
        Route::post('/tracki/employee/timesheet/store', [EmployeeTimeSheetController::class, 'store'])->name('tracki.employee.timesheet.store');
        Route::get('tracki/employee/timesheet/delete/{id}', [EmployeeTimeSheetController::class, 'delete'])->name('tracki.employee.timesheet.delete');
        Route::post('/tracki/employee/timesheet/update', [EmployeeTimeSheetController::class, 'update'])->name('tracki.employee.timesheet.update');
        Route::get('/tracki/employee/timesheet/mv/edit/{id}', [EmployeeTimeSheetController::class, 'getEmpTimeSheetEditView'])->name('tracki.employee.timesheet.rv.edit');
        // Route::get('/tracki/employee/timesheet/entries/{id}', [EmployeeTimeSheetController::class, 'entries'])->name('tracki.employee.timesheet.entries');
        Route::post('tracki/employee/timesheet/status/update', [EmployeeTimeSheetController::class, 'updateStatus'])->name('tracki.employee.timesheet.status.update');
        Route::get('tracki/employee/timesheet/status/edit/{id}', [EmployeeTimeSheetController::class, 'editStatus'])->name('tracki.employee.timesheet.status.edit');

        // Time Sheet entries
        Route::get('/tracki/employee/timesheet/entries/{id}', [EmployeeTimeSheetEntryController::class, 'index'])->name('tracki.employee.timesheet.entries')->middleware('permission:employee.show');
        Route::get('/tracki/employee/timesheet/entries/add/{id}', [EmployeeTimeSheetEntryController::class, 'add'])->name('tracki.employee.timesheet.entries.add')->middleware('permission:employee.show');
        Route::get('/tracki/employee/timesheet/entries/list/{id}', [EmployeeTimeSheetEntryController::class, 'list'])->name('tracki.employee.timesheet.entries.list')->middleware('permission:employee.show');
        // Route::get('/tracki/employee/timesheet/entries/show', [EmployeeTimeSheetEntryController::class, 'list'])->name('tracki.employee.timesheet.entries.show')->middleware('permission:employee.show');
        Route::post('/tracki/employee/timesheet/entries/store', [EmployeeTimeSheetEntryController::class, 'store'])->name('tracki.employee.timesheet.entries.store');
        // Route::get('tracki/employee/timesheet/entries/delete/{id}', [EmployeeTimeSheetEntryController::class, 'delete'])->name('tracki.employee.timesheet.entries.delete');
        Route::post('/tracki/employee/timesheet/entries/update', [EmployeeTimeSheetEntryController::class, 'update'])->name('tracki.employee.timesheet.entries.update');
        Route::get('/tracki/employee/timesheet/entries/get/{id}', [EmployeeTimeSheetEntryController::class, 'get'])->name('tracki.employee.timesheet.entries.rv.edit');
        // Route::get('/tracki/employee/timesheet/entries/{id}', [EmployeeTimeSheetEntryController::class, 'entries'])->name('tracki.employee.timesheet.entries');
        Route::post('tracki/employee/timesheet/entries/status/update', [EmployeeTimeSheetEntryController::class, 'updateStatus'])->name('tracki.employee.timesheet.entries.status.update');
        Route::get('tracki/employee/timesheet/entries/status/edit/{id}', [EmployeeTimeSheetEntryController::class, 'editStatus'])->name('tracki.employee.timesheet.entries.status.edit');
        // Route::get('/tracki/employee/leave/create', [EmployeeLeaveController::class, 'create'])->name('tracki.employee.leave.create');

        //************************************ Setup Methods *************************************************** */
        // Event Category
        Route::get('/tracki/setup/category-list', [SetupController::class, 'catEvent'])->name('tracki.setup.category');
        Route::post('updatecat', [SetupController::class, 'updateEventCategory'])->name('tracki.setup.category.update');
        Route::post('createcat', [SetupController::class, 'createEventCategory'])->name('tracki.setup.category.create');
        Route::get('/tracki/setup/category/{id}/edit', [SetupController::class, 'editCategory'])->name('tracki.setup.category.show.edit');
        Route::get('/tracki/setup/category/{id}/delete', [SetupController::class, 'deleteCategory'])->name('tracki.setup.category.delete');

        // Event Audience
        Route::get('/tracki/setup/audience-list', [SetupController::class, 'eventAudience'])->name('tracki.setup.audience');
        Route::post('updateaudience', [SetupController::class, 'updateAudience'])->name('tracki.setup.audience.update');
        Route::post('createaudience', [SetupController::class, 'createAudience'])->name('tracki.setup.audience.create');
        Route::get('/tracki/setup/audience/{id}/edit', [SetupController::class, 'editAudience'])->name('tracki.setup.audience.show.edit');
        Route::get('/tracki/setup/audience/{id}/delete', [SetupController::class, 'deleteAudience'])->name('tracki.setup.audience.delete');

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

        //Address Type
        Route::get('/tracki/setting/address_type', [AddressTypeController::class, 'index'])->name('tracki.setting.address_type');
        Route::get('/tracki/setting/address_type/list', [AddressTypeController::class, 'list'])->name('tracki.setting.address_type.list');
        Route::get('/tracki/setting/address_type/get/{id}', [AddressTypeController::class, 'get'])->name('tracki.setting.address_type.get');
        Route::post('tracki/setting/address_type/update', [AddressTypeController::class, 'update'])->name('tracki.setting.address_type.update');
        Route::delete('/tracki/setting/address_type/delete/{id}', [AddressTypeController::class, 'delete'])->name('tracki.setting.address_type.delete');
        Route::post('/tracki/setting/address_type/store', [AddressTypeController::class, 'store'])->name('tracki.setting.address_type.store');

        //Job Level
        Route::get('/tracki/setting/job_level', [JobLevelController::class, 'index'])->name('tracki.setting.job_level');
        Route::get('/tracki/setting/job_level/list', [JobLevelController::class, 'list'])->name('tracki.setting.job_level.list');
        Route::get('/tracki/setting/job_level/get/{id}', [JobLevelController::class, 'get'])->name('tracki.setting.job_level.get');
        Route::post('tracki/setting/job_level/update', [JobLevelController::class, 'update'])->name('tracki.setting.job_level.update');
        Route::delete('/tracki/setting/job_level/delete/{id}', [JobLevelController::class, 'delete'])->name('tracki.setting.job_level.delete');
        Route::post('/tracki/setting/job_level/store', [JobLevelController::class, 'store'])->name('tracki.setting.job_level.store');

        //Job Level
        Route::get('/tracki/setting/sponsorship', [EmployeeSponsorshipController::class, 'index'])->name('tracki.setting.sponsorship');
        Route::get('/tracki/setting/sponsorship/list', [EmployeeSponsorshipController::class, 'list'])->name('tracki.setting.sponsorship.list');
        Route::get('/tracki/setting/sponsorship/get/{id}', [EmployeeSponsorshipController::class, 'get'])->name('tracki.setting.sponsorship.get');
        Route::post('tracki/setting/sponsorship/update', [EmployeeSponsorshipController::class, 'update'])->name('tracki.setting.sponsorship.update');
        Route::delete('/tracki/setting/sponsorship/delete/{id}', [EmployeeSponsorshipController::class, 'delete'])->name('tracki.setting.sponsorship.delete');
        Route::post('/tracki/setting/sponsorship/store', [EmployeeSponsorshipController::class, 'store'])->name('tracki.setting.sponsorship.store');

        //Job Level
        Route::get('/tracki/setting/contract_type', [EmployeeContractTypeController::class, 'index'])->name('tracki.setting.contract_type');
        Route::get('/tracki/setting/contract_type/list', [EmployeeContractTypeController::class, 'list'])->name('tracki.setting.contract_type.list');
        Route::get('/tracki/setting/contract_type/get/{id}', [EmployeeContractTypeController::class, 'get'])->name('tracki.setting.contract_type.get');
        Route::post('tracki/setting/contract_type/update', [EmployeeContractTypeController::class, 'update'])->name('tracki.setting.contract_type.update');
        Route::delete('/tracki/setting/contract_type/delete/{id}', [EmployeeContractTypeController::class, 'delete'])->name('tracki.setting.contract_type.delete');
        Route::post('/tracki/setting/contract_type/store', [EmployeeContractTypeController::class, 'store'])->name('tracki.setting.contract_type.store');


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

        // Route::get('/tracki/users/create', [ClientController::class, 'create'])->name('tracki.users.create');
        // Route::post('/tracki/users/store', [UserController::class, 'store'])->name('tracki.users.store');
        // Route::post('/tracki/users/manage', [ClientController::class, 'index'])->name('tracki.users.manage');


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

        // Department
        Route::get('/tracki/setting/departments', [DepartmentController::class, 'index'])->name('tracki.setting.departments');
        Route::get('/tracki/setting/departments/list', [DepartmentController::class, 'list'])->name('tracki.setting.departments.list');
        Route::get('/tracki/setting/departments/get/{id}', [DepartmentController::class, 'get'])->name('tracki.setting.departments.get');
        Route::post('tracki/setting/departments/update', [DepartmentController::class, 'update'])->name('tracki.setting.departments.update');
        Route::delete('/tracki/setting/departments/delete/{id}', [DepartmentController::class, 'delete'])->name('tracki.setting.departments.delete');
        Route::post('/tracki/setting/departments/store', [DepartmentController::class, 'store'])->name('tracki.setting.departments.store');

        // Designation
        Route::get('/tracki/setting/designations', [DesignationController::class, 'index'])->name('tracki.setting.designations');
        Route::get('/tracki/setting/designations/list', [DesignationController::class, 'list'])->name('tracki.setting.designations.list');
        Route::get('/tracki/setting/designations/get/{id}', [DesignationController::class, 'get'])->name('tracki.setting.designations.get');
        Route::post('tracki/setting/designations/update', [DesignationController::class, 'update'])->name('tracki.setting.designations.update');
        Route::delete('/tracki/setting/designations/delete/{id}', [DesignationController::class, 'delete'])->name('tracki.setting.designations.delete');
        Route::post('/tracki/setting/designations/store', [DesignationController::class, 'store'])->name('tracki.setting.designations.store');

        // entities
        Route::get('/tracki/setting/entities', [EntityController::class, 'index'])->name('tracki.setting.entities');
        Route::get('/tracki/setting/entities/list', [EntityController::class, 'list'])->name('tracki.setting.entities.list');
        Route::get('/tracki/setting/entities/get/{id}', [EntityController::class, 'get'])->name('tracki.setting.entities.get');
        Route::post('tracki/setting/entities/update', [EntityController::class, 'update'])->name('tracki.setting.entities.update');
        Route::delete('/tracki/setting/entities/delete/{id}', [EntityController::class, 'delete'])->name('tracki.setting.entities.delete');
        Route::post('/tracki/setting/entities/store', [EntityController::class, 'store'])->name('tracki.setting.entities.store');

        // element classification
        Route::get('/tracki/setting/element/', [ElementController::class, 'index'])->name('tracki.setting.element');
        Route::get('/tracki/setting/element/list', [ElementController::class, 'list'])->name('tracki.setting.element.list');
        Route::get('/tracki/setting/element/get/{id}', [ElementController::class, 'get'])->name('tracki.setting.element.get');
        Route::post('tracki/setting/element/update', [ElementController::class, 'update'])->name('tracki.setting.element.update');
        Route::delete('/tracki/setting/element/delete/{id}', [ElementController::class, 'delete'])->name('tracki.setting.element.delete');
        Route::post('/tracki/setting/element/store', [ElementController::class, 'store'])->name('tracki.setting.element.store');


        // element classification
        Route::get('/tracki/setting/element/classifications', [ElementClassificationController::class, 'index'])->name('tracki.setting.element.classifications');
        Route::get('/tracki/setting/element/classifications/list', [ElementClassificationController::class, 'list'])->name('tracki.setting.element.classifications.list');
        Route::get('/tracki/setting/element/classifications/get/{id}', [ElementClassificationController::class, 'get'])->name('tracki.setting.element.classifications.get');
        Route::post('tracki/setting/element/classifications/update', [ElementClassificationController::class, 'update'])->name('tracki.setting.element.classifications.update');
        Route::delete('/tracki/setting/element/classifications/delete/{id}', [ElementClassificationController::class, 'delete'])->name('tracki.setting.element.classifications.delete');
        Route::post('/tracki/setting/element/classifications/store', [ElementClassificationController::class, 'store'])->name('tracki.setting.element.classifications.store');

        // directorate
        Route::get('/tracki/setting/directorates', [DirectorateController::class, 'index'])->name('tracki.setting.directorates');
        Route::get('/tracki/setting/directorates/list', [DirectorateController::class, 'list'])->name('tracki.setting.directorates.list');
        Route::get('/tracki/setting/directorates/get/{id}', [DirectorateController::class, 'get'])->name('tracki.setting.directorates.get');
        Route::post('tracki/setting/directorates/update', [DirectorateController::class, 'update'])->name('tracki.setting.directorates.update');
        Route::delete('/tracki/setting/directorates/delete/{id}', [DirectorateController::class, 'delete'])->name('tracki.setting.directorates.delete');
        Route::post('/tracki/setting/directorates/store', [DirectorateController::class, 'store'])->name('tracki.setting.directorates.store');

        // relationship
        Route::get('/tracki/setting/relationships', [EmployeeRelationshipController::class, 'index'])->name('tracki.setting.relationships');
        Route::get('/tracki/setting/relationships/list', [EmployeeRelationshipController::class, 'list'])->name('tracki.setting.relationships.list');
        Route::get('/tracki/setting/relationships/get/{id}', [EmployeeRelationshipController::class, 'get'])->name('tracki.setting.relationships.get');
        Route::post('tracki/setting/relationships/update', [EmployeeRelationshipController::class, 'update'])->name('tracki.setting.relationships.update');
        Route::delete('/tracki/setting/relationships/delete/{id}', [EmployeeRelationshipController::class, 'delete'])->name('tracki.setting.relationships.delete');
        Route::post('/tracki/setting/relationships/store', [EmployeeRelationshipController::class, 'store'])->name('tracki.setting.relationships.store');

        // leave_type
        Route::get('/tracki/setting/leave_types', [LeaveTypeController::class, 'index'])->name('tracki.setting.leave_types');
        Route::get('/tracki/setting/leave_types/list', [LeaveTypeController::class, 'list'])->name('tracki.setting.leave_types.list');
        Route::get('/tracki/setting/leave_types/get/{id}', [LeaveTypeController::class, 'get'])->name('tracki.setting.leave_types.get');
        Route::post('tracki/setting/leave_types/update', [LeaveTypeController::class, 'update'])->name('tracki.setting.leave_types.update');
        Route::delete('/tracki/setting/leave_types/delete/{id}', [LeaveTypeController::class, 'delete'])->name('tracki.setting.leave_types.delete');
        Route::post('/tracki/setting/leave_types/store', [LeaveTypeController::class, 'store'])->name('tracki.setting.leave_types.store');


        // Functional Area
        Route::get('/tracki/setting/funcareas', [FunctionalAreaController::class, 'index'])->name('tracki.setting.funcareas');
        Route::get('/tracki/setting/funcareas/list', [FunctionalAreaController::class, 'list'])->name('tracki.setting.funcareas.list');
        Route::get('/tracki/setting/funcareas/get/{id}', [FunctionalAreaController::class, 'get'])->name('tracki.setting.funcareas.get');
        Route::post('tracki/setting/funcareas/update', [FunctionalAreaController::class, 'update'])->name('tracki.setting.funcareas.update');
        Route::delete('/tracki/setting/funcareas/delete/{id}', [FunctionalAreaController::class, 'delete'])->name('tracki.setting.funcareas.delete');
        Route::post('/tracki/setting/funcareas/store', [FunctionalAreaController::class, 'store'])->name('tracki.setting.funcareas.store');

        // Gender
        Route::get('/tracki/setting/gender', [GenderController::class, 'index'])->name('tracki.setting.gender');
        Route::get('/tracki/setting/gender/list', [GenderController::class, 'list'])->name('tracki.setting.gender.list');
        Route::get('/tracki/setting/gender/get/{id}', [GenderController::class, 'get'])->name('tracki.setting.gender.get');
        Route::post('tracki/setting/gender/update', [GenderController::class, 'update'])->name('tracki.setting.gender.update');
        Route::delete('/tracki/setting/gender/delete/{id}', [GenderController::class, 'delete'])->name('tracki.setting.gender.delete');
        Route::post('/tracki/setting/gender/store', [GenderController::class, 'store'])->name('tracki.setting.gender.store');

        // Inovice Notes
        Route::get('/tracki/setting/invoice/notes', [EmployeeTimeSheetInvoice::class, 'index'])->name('tracki.setting.invoice.notes');
        Route::get('/tracki/setting/invoice/notes/list', [EmployeeTimeSheetInvoice::class, 'list'])->name('tracki.setting.invoice.notes.list');
        Route::get('/tracki/setting/invoice/notes/get/{id}', [EmployeeTimeSheetInvoice::class, 'get'])->name('tracki.setting.invoice.notes.get');
        Route::post('tracki/setting/invoice/notes/update', [EmployeeTimeSheetInvoice::class, 'update'])->name('tracki.setting.invoice.notes.update');
        Route::delete('/tracki/setting/invoice/notes/delete/{id}', [EmployeeTimeSheetInvoice::class, 'delete'])->name('tracki.setting.invoice.notes.delete');
        Route::post('/tracki/setting/invoice/notes/store', [EmployeeTimeSheetInvoice::class, 'store'])->name('tracki.setting.invoice.notes.store');

        // marital status
        Route::get('/tracki/setting/marital', [MaritalStatusController::class, 'index'])->name('tracki.setting.marital');
        Route::get('/tracki/setting/marital/list', [MaritalStatusController::class, 'list'])->name('tracki.setting.marital.list');
        Route::get('/tracki/setting/marital/get/{id}', [MaritalStatusController::class, 'get'])->name('tracki.setting.marital.get');
        Route::post('tracki/setting/marital/update', [MaritalStatusController::class, 'update'])->name('tracki.setting.marital.update');
        Route::delete('/tracki/setting/marital/delete/{id}', [MaritalStatusController::class, 'delete'])->name('tracki.setting.marital.delete');
        Route::post('/tracki/setting/marital/store', [MaritalStatusController::class, 'store'])->name('tracki.setting.marital.store');

        // countries
        Route::get('/tracki/setting/countries', [CountryController::class, 'index'])->name('tracki.setting.countries');
        Route::get('/tracki/setting/countries/list', [CountryController::class, 'list'])->name('tracki.setting.countries.list');
        Route::get('/tracki/setting/countries/get/{id}', [CountryController::class, 'get'])->name('tracki.setting.countries.get');
        Route::post('tracki/setting/countries/update', [CountryController::class, 'update'])->name('tracki.setting.countries.update');
        Route::delete('/tracki/setting/countries/delete/{id}', [CountryController::class, 'delete'])->name('tracki.setting.countries.delete');
        Route::post('/tracki/setting/countries/store', [CountryController::class, 'store'])->name('tracki.setting.countries.store');

        // nationalities
        Route::get('/tracki/setting/nationalities', [NationalityController::class, 'index'])->name('tracki.setting.nationalities');
        Route::get('/tracki/setting/nationalities/list', [NationalityController::class, 'list'])->name('tracki.setting.nationalities.list');
        Route::get('/tracki/setting/nationalities/get/{id}', [NationalityController::class, 'get'])->name('tracki.setting.nationalities.get');
        Route::post('tracki/setting/nationalities/update', [NationalityController::class, 'update'])->name('tracki.setting.nationalities.update');
        Route::delete('/tracki/setting/nationalities/delete/{id}', [NationalityController::class, 'delete'])->name('tracki.setting.nationalities.delete');
        Route::post('/tracki/setting/nationalities/store', [NationalityController::class, 'store'])->name('tracki.setting.nationalities.store');

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

        // // attendance
        // Route::get('/tracki/attendance/list', [AttendanceController::class, 'attendance'])->name('tracki.attendance.list')->middleware('permission:attendance.show');
        // // Route::get('/tracki/attendance/listinf', [AttendanceController::class, 'attendanceInf'])->name('tracki.attendance.listinf');
        // // Route::get('/tracki/attendance/listvip', [AttendanceController::class, 'attendanceVIP'])->name('tracki.attendance.listvip');
        // // Route::get('/tracki/attendance/listvic', [AttendanceController::class, 'attendanceVIC'])->name('tracki.attendance.listvic');
        // Route::post('updateattendance', [AttendanceController::class, 'updateAttendance'])->name('tracki.attendance.list.update')->middleware('permission:attendance.edit');
        // Route::post('createattendance', [AttendanceController::class, 'createAttendance'])->name('tracki.attendance.list.create')->middleware('permission:attendance.create');
        // Route::get('/tracki/attendance/list/{id}/edit', [AttendanceController::class, 'editAttendance'])->name('tracki.attendance.list.edit')->middleware('permission:attendance.edit');
        // Route::get('/tracki/attendance/list/{id}/delete', [AttendanceController::class, 'deleteAttendance'])->name('tracki.attendance.list.delete')->middleware('permission:attendance.delete');

        // Route::get('/tracki/attendance/import', [AttendanceController::class, 'ImportAttendance'])->name('tracki.attendance.import')->middleware('permission:attendance.import');
        // Route::post('importattendancenow', [AttendanceController::class, 'ImportNowAttendance'])->name('tracki.attendance.import.now')->middleware('permission:attendance.import');

        // // attendance assgignment
        // Route::get('/tracki/attendance/assignment', [AttendanceController::class, 'attendanceAssignment'])->name('tracki.attendance.assignment')->middleware('permission:project.attendance.assign');
        // Route::get('/tracki/attendance/{id}/eventassignment', [AttendanceController::class, 'eventAttendanceAssignment'])->name('tracki.event.attendance.assignment')->middleware('permission:project.attendance.assign');
        // Route::post('attendanceassignment', [AttendanceController::class, 'assignAttendanceEvents'])->name('tracki.attendance.assignevents')->middleware('permission:project.attendance.assign');
        // Route::get('/tracki/attendance/assignment/{id}/delete', [AttendanceController::class, 'deleteEventAssignment'])->name('tracki.attendance.assignment.delete')->middleware('permission:project.attendance.delete');

        // // scanning
        // Route::get('/tracki/attendance/scanme', function () {
        //     return view('/tracki/attendance/scanme');
        // })->name('tracki.attendance.scanme');

        // // scanning
        // Route::get('/tracki/attendance/checkin', function () {
        //     return view('/tracki/attendance/checkin');
        // })->name('tracki.attendance.checkin');

        // Route::post('showattendanceresults', [AttendanceController::class, 'markAttendance'])->name('tracki.attendance.mark');
        // Route::post('/tracki/attendance/info', [AttendanceController::class, 'attendanceInfo'])->name('tracki.attendance.info');


        // // Charts
        // Route::get('/charts/piechart', [ChartsController::class, 'pieChart'])->name('charts.pie');
        // Route::get('/charts/piechart2', [ChartsController::class, 'pieChart'])->name('charts.pie2');
        // Route::get('/charts/charts', [ChartsController::class, 'eventDash'])->name('charts.dashboard');
    });

    require __DIR__ . '/auth.php';

    // Admin Group Middleware
    // Route::middleware(['auth', 'role:admin', 'prevent-back-history'])->group(function () {
    //     Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    //     Route::get('/admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
    //     Route::get('/admin/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
    //     Route::post('/admin/profile/store', [AdminController::class, 'adminProfileStore'])->name('admin.profile.store');
    // });  // End groupd admin middleware

    // Route::middleware(['auth', 'role:agent'])->group(function () {
    //     Route::get('/agent/dashboard', [AgentController::class, 'agentDashboard'])->name('agent.dashboard');
    // });  // End groupd agent middleware

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
