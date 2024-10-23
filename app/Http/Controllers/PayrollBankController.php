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

class PayrollBankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */

    public function index()
    {
        //
        // dd($id);
        // $employee_timesheets = EmployeeTimeSheet::all();
        $timesheet_periods = EmployeeTimeSheet::select('timesheet_period')->distinct()->get();
        // $employees = Employee::join('employee_timesheets', 'employees_all.id', 'employee_timesheets.employee_id')->get();

        // $directorate = EmployeeDirectorate::all();
        // $entities = EmployeeEntity::all();
        // $departments = Department::all();
        // $functional = FunctionalArea::all();

        // $employee_leave_statuses = EmployeeLeaveStatus::all();
        // $months_name = MonthsNames::orderBy('month_order', 'ASC')->get();
        // $emp = Employee::findOrFail(auth()->user()->employee_id);

        // dd(FacadesRoute::currentRouteName());
        // dd(FacadesRequest::url());
        return view(
            'tracki.payroll.bank.list',
            compact(
                // 'employees',
                // 'employee_leave_statuses',
                // 'months_name',
                // 'employee_timesheets',
                'timesheet_periods',
                // 'directorate',
                // 'entities',
                // 'departments',
                // 'functional'
            )
        );
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


        return view('tracki.payroll.timesheet.missing.list', compact('directorate', 'entities', 'departments', 'functional'));
    }

    public function list()
    {
        $user = User::findOrFail(auth()->user()->id);

        $search = request('search');
        $sort = "employees_all.id";
        // $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";

        // $employees = Employee::whereHas('timesheets', function ($q) {
        //     $q->where('status_id', 11);
        // })
        //     ->with('salaries')
        //     ->orderBy($sort, $order);

        // $employees = (new Employee)->newQuery()
        //     ->whereHas('timesheets', function ($query)  {
        //         $query->where('status_id', 11);
        //     })
        //     ->with('salaries')
        //     ->orderBy($sort, $order);

         $employees = Employee::join('employee_timesheets', 'employees_all.id', 'employee_timesheets.employee_id')
                        ->join('employee_banks', 'employees_all.id', 'employee_banks.employee_id')
                        ->join('employee_salary', 'employees_all.id', 'employee_salary.employee_id')
                        ->where('employee_timesheets.status_id', 11)
                        ->where('employee_timesheets.payroll_reviewed', true)
                     ->orderBy($sort, $order);

        $period = (request()->period) ? request()->period : "";

        if ($search) {
            $employees = $employees->where(function ($query) use ($search) {
                $query->where('full_name', 'like', '%' . $search . '%')
                    ->orWhere('employee_number', 'like', '%' . $search . '%')
                    ->orWhere('swift_code', 'like', '%' . $search . '%')
                    ->orWhere('iban', 'like', '%' . $search . '%');
            });
        }

        if ($period) {
            $employees = $employees->where(function ($query) use ($period) {
                $query->where('timesheet_period', 'like', '%' . $period . '%');
            });
        }


        $total = $employees->count();

        $employees = $employees->paginate(request("limit"))->through(function ($employee) use ($user) {

            $full_name = $employee->first_name . ' ' . $employee->last_name;

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

            return [
                'id1' => '<div class="ms-3">' . $employee->id . '</div>',
                'id' => $employee->id,
                'image' => $image,
                'timesheet_period' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->timesheet_period . '</div>',
                'employee_number' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->employee_number . '</div>',
                'full_name' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->full_name . '</div>',
                'iban' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->iban . '</div>',
                'swift_code' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $employee->swift_code . '</div>',
                'total_payment' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . number_format($employee->total_payment, 2) . '</div>',
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
