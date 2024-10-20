<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeApproval;
use App\Models\EmployeeDirectorate;
use App\Models\EmployeeEntity;
use App\Models\EmployeeFile;
use App\Models\EmployeeLeave;
use App\Models\EmployeeLeaveAttachment;
use App\Models\EmployeeLeaveStatus;
use App\Models\EmployeeLeaveType;
use App\Models\EmployeeSalary;
use App\Models\EmployeeTimeSheet;
use App\Models\EmployeeTimeSheetEntry;
use App\Models\FunctionalArea;
use App\Models\MonthsNames;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PayrollTimesheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */

    public function index()
    {
        //
        // dd($id);
        $employee_timesheets = EmployeeTimeSheet::all();
        $timesheet_periods = EmployeeTimeSheet::select('timesheet_period')->distinct()->get();

        // $employees = Employee::all();
        $employees = Employee::when(auth()->user()->employee_id, function ($query, $id) {
            return $query->where('employees_all.id', $id);
        })->get();
        $employee_leave_statuses = EmployeeLeaveStatus::all();
        $months_name = MonthsNames::orderBy('month_order', 'ASC')->get();
        // $emp = Employee::findOrFail(auth()->user()->employee_id);

        // dd(FacadesRoute::currentRouteName());
        // dd(FacadesRequest::url());
        return view('tracki.payroll.timesheet.list', compact('employees', 'employee_leave_statuses', 'months_name', 'employee_timesheets','timesheet_periods'));
    }


    public function create()
    {
        //
    }

    /**
     * add a new resource.
     */
    public function add()
    {
        //
    }

    public function getEntries($id)
    {
        $employee_timesheet = EmployeeTimeSheet::findOrFail($id);
        $employee_timesheet_entries = EmployeeTimeSheetEntry::where('employee_timesheet_id', $id)->get();
        // dd($employee_timesheet_entries);

        $view = view('/tracki/employee/managers/timesheet/entries/mv/get', [
            'employee_timesheet_entries' => $employee_timesheet_entries,
            'employee_timesheet' => $employee_timesheet,
        ])->render();

        return response()->json(['view' => $view]);
    }

    public function reviewed($id)
    {
        $op = EmployeeTimeSheet::findOrFail($id);

        $op->payroll_reviewed = !$op->payroll_reviewed;
        $op->save();

        return response()->json(['error' => false, 'message' => 'Reviewed']);
    }

    public function missingTimesheet()
    {
        $directorate = EmployeeDirectorate::all();
        $entities = EmployeeEntity::all();
        $departments = Department::all();
        $functional = FunctionalArea::all();


        return view('tracki.payroll.timesheet.missing.list', compact('directorate','entities','departments','functional'));
    }

    public function listMissingTimesheet()
    {
        $user = User::findOrFail(auth()->user()->id);

        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";
        $employees = Employee::whereDoesntHave('timesheets')->orderBy($sort, $order);

        $functional_area = (request()->functional_area) ? request()->functional_area : "";
        $department = (request()->department) ? request()->department : "";
        $entity = (request()->entity) ? request()->entity : "";
        $directorate = (request()->directorate) ? request()->directorate : "";

        $user_id = ($user->hasRole('SuperAdmin') || $user->hasRole('HRMSADMIN')) ? 0 : $user->employee_id;


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

        $total = $employees->count();

        $employees = $employees->paginate(request("limit"))->through(function ($employee) use ($user) {

            $full_name = $employee->first_name . ' ' . $employee->last_name;

            /* returns null if it does not exist */
            // $salary = EmployeeSalary::when($employee->id, function ($query, $sal) {
            //     return $query->where('employee_salary.employee_id', $sal);
            // })->first();

            $salary = EmployeeSalary::where('employee_id', $employee->id)->first();
            // dd($salary);

            if ($employee->manager_flag == 'Y'){
                $avatar_status = 'status-away';
            } else {
                $avatar_status = '';
            }

            if ($employee->emp_files?->file_path) {
                $image = ' <div class="avatar avatar-m '.$avatar_status.'">
                                <a  href="#" role="button" title="' . $full_name . '">
                                    <img class="rounded-circle pull-up" src="' . $employee->emp_files->file_path . $employee->emp_files->file_name . '" alt="" />
                                </a>
                            </div>';
            } else {
                $image = '  <div class="avatar avatar-m '.$avatar_status.'  me-1" id="project_team_members_init">
                                <a class="dropdown-toggle dropdown-caret-none d-inline-block" href="#" role="button" title="' . $full_name . '">
                                    <div class="avatar avatar-m  rounded-circle pull-up">
                                        <div class="avatar-name rounded-circle me-2"><span>' . generateInitials($full_name) . '</span></div>
                                    </div>
                                </a>
                            </div>';
            }

            $div_action = '<div class="font-sans-serif btn-reveal-trigger position-static">';
            $profile_action =
                '<a href="' . route("tracki.employee.profile", encrypt($employee->id)) . '" class="btn-table btn-sm" id="employeeCardView" data-id="' .
                $employee->id .
                '" data-table="employee_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Employee Details">' .
                '<i class="fa-solid far fa-lightbulb text-warning"></i></a>';
            $update_action =
                '<a href="javascript:void(0)" class="btn btn-sm" id="edit_employee" data-action="update" " data-type="edit" data-id=' .
                $employee->id .
                ' data-table="employee_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Update">' .
                '<i class="fa-solid fa-pen-to-square text-primary"></i></a>';
            $duplicate_action =
                '<a href="javascript:void(0)" class="btn btn-sm" id="duplicate_employee" data-action="update" " data-type="duplicate" data-id=' .
                $employee->id .
                ' data-table="employee_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Duplicate">' .
                '<i class="fa-solid fa-copy text-success"></i></a>';
            $delete_action =
                '<a href="javascript:void(0)" class="btn btn-sm" data-table="employee_table" data-id="' .
                $employee->id .
                '" id="deleteEmployee" data-bs-toggle="tooltip" data-bs-placement="right" title="Delete">' .
                '<i class="bx bx-trash text-danger"></i></a></div></div>';

            $actions = $div_action . $profile_action;

            ($user->can('employee.edit')) ? $actions = $actions . $update_action . $duplicate_action : $actions = $actions;
            ($user->can('employee.delete')) ? $actions = $actions . $delete_action : $actions = $actions;


            $profile_url = route('tracki.employee.profile', encrypt($employee->id));

            return [
                'id1' => '<div class="ms-3">' . $employee->id . '</div>',
                'id' => $employee->id,
                'image' => $image,
                'employee_number' => '<div class="align-middle white-space-wrap fw-bold fs-9"><a href="' . $profile_url . '">' . $employee->employee_number . '</a></div>',
                // 'employee_type' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->employee_types->title . '</div>',
                'reporting_to' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->managers?->full_name . '</div>',
                'gender' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->genders->title . '</div>',
                'full_name' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->full_name . '</div>',
                'entity' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->entities?->title . '</div>',
                'contract_start_date' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . format_date($employee->contract_start_date) . '</div>',
                'contract_end_date' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . format_date($employee->contract_end_date) . '</div>',
                'email_address' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->work_email_address . '</div>',
                'salary' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->salaries?->net_salary . '</div>',
                'actions' => $actions,

                'first_name' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->first_name . '</div>',
                'middle_name' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->middle_name . '</div>',
                'last_name' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->last_name . '</div>',
                'personal_email_address' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->personal_email_address . '</div>',
                'salutation' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->salutations?->title . '</div>',
                'national_identifier_number' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->national_identifier_number . '</div>',
                'civil_id_expiry' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . format_date($employee->civil_id_expiry) . '</div>',
                'passport_number' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->passport_number . '</div>',
                'passport_expiry' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . format_date($employee->passport_expiry) . '</div>',
                'job' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->designation->name . '</div>',
                'job_level' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->job_levels?->title . '</div>',
                'phone_number' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->phone_number . '</div>',
                'alt_phone_number' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->alt_phone_number . '</div>',
                'phone_area_code' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->phone_area_code . '</div>',
                'alt_area_code' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->alt_area_code . '</div>',
                'directorate' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->directorate?->title . '</div>',
                'department' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->departments?->name . '</div>',
                'functional_area' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->functional_areas?->name . '</div>',
                'marital_status' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->marital_status?->title . '</div>',
                'date_of_birth' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . format_date($employee->date_of_birth) . '</div>',
                'country_of_birth' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->countries?->country_name . '</div>',
                'nationality' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->nationalities?->nationality . '</div>',
                'countract_type' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->contract_types?->title . '</div>',
                'manager_flag' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->manager_flag . '</div>',
                'created_at' => format_date($employee->created_at,  'H:i:s'),
                'updated_at' => format_date($employee->updated_at, 'H:i:s'),
            ];
        });

        return response()->json([
            "rows" => $employees->items(),
            "total" => $total,
        ]);
    }

    public function list($id = null)
    {
        $user = User::findOrFail(auth()->user()->id);

        // table options
        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";

        // search dropdown
        $period = (request()->period) ? request()->period : "";
        $status = (request()->status) ? request()->status : "";
        Log::alert(request()->all());


        $op = EmployeeTimeSheet::orderBy($sort, $order);

        $user_id = ($user->hasRole('SuperAdmin') || $user->hasRole('HRMSADMIN')) ? 0 : $user->employee_id;

        if ($search) {
            $op = $op->where(function ($query) use ($search) {
                $query->where('timesheet_period', 'like', '%' . $search . '%')
                    ->orWhere('year_selected', 'like', '%' . $search . '%')
                    ->orWhereHas('employees', function ($query) use ($search) {
                        $query->where('full_name', 'like', '%' . $search . '%')
                            ->orWhere('employee_number', 'like', '%' . $search . '%')
                            ->orWhere('work_email_address', 'like', '%' . $search . '%');
                    });
            });
        }

        if ($status) {
            $op = $op->where(function ($query) use ($status) {
                $query->where('status_id', 'like', '%' . $status . '%');
            });
        }

        if ($period) {
            $op = $op->where(function ($query) use ($period) {
                $query->where('timesheet_period', 'like', '%' . $period . '%');
            });
        }


        $total = $op->count();

        $op = $op->paginate(request("limit"))->through(function ($op) use ($user) {

            // $profile_url = route('tracki.employee.profile', $op->id);
            if ($op->employees?->emp_files?->file_path) {
                $image = ' <div class="avatar avatar-m ">
                                <a  href="#" role="button" title="' . $op->employees?->full_name . '">
                                    <img class="rounded-circle pull-up" src="' . $op->employees?->emp_files?->file_path . $op->employees?->emp_files?->file_name . '" alt="" />
                                </a>
                            </div>';
            } else {
                $image = '  <div class="avatar avatar-m  me-1" id="project_team_members_init">
                                <a class="dropdown-toggle dropdown-caret-none d-inline-block" href="#" role="button" title="' . $op->employees?->full_name . '">
                                    <div class="avatar avatar-m  rounded-circle pull-up">
                                        <div class="avatar-name rounded-circle me-2"><span>' . generateInitials($op->employees?->full_name) . '</span></div>
                                    </div>
                                </a>
                            </div>';
            }

            $entries_count = $op->entries->count();

            if ($entries_count) {
                $status = '<span class="badge badge-phoenix fs--2 badge-phoenix-' . $op->leave_statuses->color .
                    ' " style="cursor: not-allowed;" ><span class="badge-label">' . $op->leave_statuses->title .
                    '</span><span class="ms-1 uil-edit-alt" style="height:12.8px;width:12.8px;cursor: pointer;"></span></span>';
            } else {
                $status = '<span class="badge badge-phoenix fs--2 badge-phoenix-secondary" style="cursor: not-allowed;" ><span class="badge-label">' .
                    'Incomplete</span><span class="ms-1 fa-regular fa-circle-xmark text-danger" style="height:12.8px;width:12.8px;cursor: not-allowed;"></span></span>';
            }


            $go_to_route = route("tracki.employee.timesheet.entries.add", encrypt($op->id));
            $pdf_route = route("tracki.employee.timesheet.invoice.pdf", encrypt($op->id));

            $entries_icon_color = "success";

            if ($entries_count) {
                $go_to_route = route("tracki.employee.timesheet.entries", encrypt($op->id));
                $entries_icon_color = "seconday";
            }

            if ($op->payroll_reviewed) {
                $payroll_review_icon_color = 'fa-solid fa-circle-check text-success';
            } else {
                $payroll_review_icon_color = 'fa-solid fa-list-check text-danger';
            }

            $actions_div = '<div class="font-sans-serif btn-reveal-trigger position-static">';

            $actions_pdf =
                '<a href="' . $pdf_route . '" class="btn btn-sm" id="bookingDetails" target="_blank" data-id="' . $op->id .
                '" data-table="employee_timesheet_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Invoice">' .
                '<i class="fa-solid fa-file-invoice text-' . $entries_icon_color . '"></i></a>';


            $actions_entries =
                '<a href="javascript:void(0)" class="btn btn-sm" id="view_readonly_employee_timesheet_entry" data-id="' . $op->id .
                '" data-table="employee_timesheet_table" data-bs-toggle="tooltip" data-bs-placement="right" title="view timesheet entries">' .
                '<i class="fas fa-network-wired text-' . $entries_icon_color . '"></i></a>';

            if ($op->leave_statuses?->title == 'Approved') {
                $actions = $actions_div . $actions_entries . $actions_pdf;
                $action_payroll =
                '<a href="javascript:void(0)" class="btn btn-sm" id="payroll_timesheet_check" data-id="' . $op->id .
                '" data-table="payroll_timesheet_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Validate">' .
                '<i class="' . $payroll_review_icon_color . '"></i></a>';
            } else {
                $actions = $actions_div . $actions_entries;
                $action_payroll =
                '<a href="javascript:void(0)" class="btn btn-sm" style="cursor: not-allowed;" title="Validate">' .
                '<i class="' . $payroll_review_icon_color . '"></i></a>';
            }

            // $actions = $actions_div . $actions_entries;

            $profile_url = route('tracki.employee.profile', encrypt($op->employees->id));

            return [
                'id1' => '<div class="ms-3">' . $op->id . '</div>',
                'id' => $op->id,
                'image' => '<div class="ms-2">' . $image . '</div>',
                'full_name' => '<div class="ms-1">' . $op->employees?->full_name . '</div>',
                'employee_number' => '<div class="ms-1">' . $op->employees->employee_number . '</div>',
                'employee_number' => '<div class="align-middle white-space-wrap fw-bold fs-9"><a href="' . $profile_url . '">' . $op->employees->employee_number . '</a></div>',
                'email_address' => '<div class="ms-1">' . $op->employees->work_email_address . '</div>',
                'timesheet_period' => '<div class="ms-1">' . $op->timesheet_period . '</div>',
                'designation' => '<div class="ms-1">' . $op->employees->designation?->name . '</div>',
                'count_worked' => '<div class="ms-1">' . $op->days_worked . '</div>',
                'count_leaves' => '<div class="ms-1">' . $op->leave_taken . '</div>',
                'count_unpaid' => '<div class="ms-1">' . $op->unpaid_leave_taken . '</div>',
                'total_paid_days' => '<div class="ms-1">' . $op->total_days_eligible_for_payment . '</div>',
                'daily_rate' => '<div class="ms-1">' . number_format($op->daily_rate, 2) . '</div>',
                'actual_payment' => '<div class="ms-1">' . number_format($op->total_payment, 2) . '</div>',
                'net_salary' => number_format($op->salary, 2),
                'note_1' => $op->note_1,
                'note_2' => $op->note_2,
                'approved_by' => '<div class="ms-1">' . $op->performer?->full_name . '</div>',
                'status' => $status,
                'reviewed_by_payroll' => $action_payroll,
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
        // Log::alert('EmployeeController::update');
        $id = Auth::user()->id;
        $op = EmployeeLeave::findOrFail($request->id);

        $rules = [
            // 'employee_id' => 'required',
            'leave_type_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Log::info($validator->errors());
            $error = true;
            $message = 'Leave not create.' . $op->id;
        } else {
            $error = false;
            $message = 'Leave created successfuly.' . $op->id;

            $start_date_d = Carbon::createFromFormat('d/m/Y',  $request->date_from);
            $end_date_d = Carbon::createFromFormat('d/m/Y', $request->date_to);
            $duration =  $start_date_d->diffInDays($end_date_d, false) + 1;

            $month_start_date = $start_date_d->format('M');
            $month_end_date = $end_date_d->format('M');

            $start_of_month = Carbon::createFromFormat('d/m/Y',  $request->date_from)->startOfMonth();
            $end_of_month = Carbon::createFromFormat('d/m/Y',  $request->date_from)->endOfMonth();

            if ($month_start_date === $month_end_date) {
                // Log::info('EmployeeLeaveController: employee_number: ' . $request->employee_id);
                // Log::info('EmployeeLeaveController: start_date_month: ' . $start_of_month);
                // Log::info('EmployeeLeaveController: end_date_month: ' . $end_of_month);
                $total_month_leaves = DB::table('employee_leave_requests')
                    ->where('employee_id', '=', $request->employee_id)
                    ->where(function ($query) use ($start_of_month, $end_of_month) {
                        $query->whereBetween('date_from', [$start_of_month, $end_of_month]);
                    })->sum('number_of_days');

                // Log::info('EmployeeLeaveController: count of leaves per month: ' . $total_month_leaves);

                $x = $total_month_leaves + $duration;

                if ($x > 2) {
                    $error = true;
                    $message = 'Only two days of leave may be taken each month..';
                    return response()->json(['error' => $error, 'message' => $message]);
                }
            }

            // $op->employee_id = $request->employee_id;
            $op->leave_type_id = $request->leave_type_id;
            $op->date_from = Carbon::createFromFormat('d/m/Y', $request->date_from)->toDateString();
            $op->date_to = Carbon::createFromFormat('d/m/Y', $request->date_to)->toDateString();
            $op->reason = $request->reason;
            if ($request->status_id) {
                $op->status_id = $request->status_id;
            }
            $op->number_of_days = $duration;
            $op->reason = $request->reason;

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
        EmployeeLeave::where('id', '=', $id)->delete();

        $notification = array(
            'message'       => 'leave address deleted successfully',
            'alert-type'    => 'success'
        );

        // dd($taskId);

        return response()->json([
            'error' => false,
            'message' => 'leave address deleted successfully',
        ]);
    }

    // return the edit employee view
    public function getEmpLeaveEditView($id)
    {
        $employees = Employee::all();
        $employee_leave_types = EmployeeLeaveType::all();
        $employee_leave = EmployeeLeave::findOrFail($id);
        $employee_leave_statuses = EmployeeLeaveStatus::all();


        // Log::alert('EmployeeController::getEmpEditView file_name: ' . $emp->emp_files?->file_name);

        $view = view('/tracki/employee/leave/mv/edit', [
            'employee_leave' => $employee_leave,
            'employees' => $employees,
            'employee_leave_types' => $employee_leave_types,
            'employee_leave_statuses' => $employee_leave_statuses,
        ])->render();

        return response()->json(['view' => $view]);
    }

    public function editStatus($id)
    {
        //  dd('editTaskProgress');
        $data = EmployeeLeave::find($id);
        //dd($data);
        // $data_arr = [];

        // $data_arr[] = [
        //     "id"        => $data->id,
        //     "status_id"  => $data->status_id,
        //     "additional_information" => $data->additional_information,
        // ];

        // $response = ["retData"  => $data_arr];
        return response()->json($data);
    } // editTaskStatus

    public function updateStatus(Request $request)
    {

        $user_id = Auth::user()->id;
        $performer_id = Auth::user()->employee_id;

        if ($performer_id == 0) {
            $performer_id = 68;
        }

        Log::info('performer_id = ' . $performer_id);

        $employee_leaves = EmployeeLeave::findOrFail($request->id);

        $count_of_actions = EmployeeApproval::where('object_id', $request->id)
            ->where('object_name', 'LEAVE')->count();
        $approvals = new EmployeeApproval();
        $status_title = EmployeeLeaveStatus::findOrFail($request->status_id);

        $employee_leaves->update([
            'status_id' => $request->status_id,
            'performer_id' => $performer_id,
            'additional_information' => $request->additional_information,
        ]);

        // insert into approvals table
        $approvals->object_name = 'LEAVE';
        $approvals->object_id = $request->id;
        $approvals->sequence_number = $count_of_actions + 1;
        $approvals->performer_id =  $performer_id;
        $approvals->action_code_id = $request->status_id;
        $approvals->additional_information = $request->additional_information;
        $approvals->created_by = $user_id;
        $approvals->updated_by = $user_id;

        $approvals->save();

        $notification = array(
            'message'       => 'Leave status updated successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => false, 'message' => 'Leave Status updated successfully.']);

        // Toastr::success('Has been add successfully :)','Success');
        // return redirect()->back()->with($notification);
        // deleteEvent
    } //updateTaskStatus
}
