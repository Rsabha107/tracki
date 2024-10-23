<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeApproval;
use App\Models\EmployeeLeave;
use App\Models\EmployeeLeaveStatus;
use App\Models\EmployeeLeaveType;
use App\Models\EmployeeSalary;
use App\Models\EmployeeTimeSheet;
use App\Models\EmployeeTimeSheetEntry;
use App\Models\MonthsNames;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class EmployeeTimeSheetController extends Controller
{
    /**
     * Display a listing of the resource.
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
        })->get(); // this is for the modal
        $employee_leave_statuses = EmployeeLeaveStatus::all();
        $months_name = MonthsNames::orderBy('month_order', 'ASC')->get();
        // $emp = Employee::findOrFail(auth()->user()->employee_id);

        // dd(FacadesRoute::currentRouteName());
        // dd(FacadesRequest::url());
        return view('tracki.employee.timesheet.list', compact('employees', 'employee_leave_statuses', 'months_name', 'employee_timesheets','timesheet_periods'));
    }

    public function entries($id)
    {
        //
        // dd($id);
        $employee_timesheet = EmployeeTimeSheet::findOrFail($id);

        // dd(FacadesRoute::currentRouteName());
        // dd(FacadesRequest::url());
        return view('tracki.employee.timesheet.entries', compact('employee_timesheet'));
    }

    // public function showtimes($for_the_month_of){

    //     for ($i = 1; $i < getDaysInMonthOfYear($for_the_month_of) + 1; ++$i) {
    //         $dates[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('d');
    //     }
    // }


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
        // Log::alert(request()->all());


        if ($id) {
            $op = EmployeeTimeSheet::where('employee_id', $id)->orderBy($sort, $order);
        } else {
            $op = EmployeeTimeSheet::orderBy($sort, $order);
        }

        $user_id = ($user->hasRole('SuperAdmin') || $user->hasRole('HRMSADMIN')) ? 0 : $user->employee_id;

        $op = $op->when($user_id, function ($query, $user_id) {
            return $query->where('employee_timesheets.employee_id', $user_id);
        });

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
            $entries_count = $op->entries->count();

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

            $href_disabled = null;

            if ($entries_count) {
                if ($user->hasRole('User')) {
                    // if ($op->leave_statuses->title == 'Approved' || !$count_time_sheet_entry) {
                    $status = '<span class="badge badge-phoenix fs--2 badge-phoenix-' . $op->leave_statuses->color .
                        ' " style="cursor: not-allowed;" ><span class="badge-label">' . $op->leave_statuses->title .
                        '</span><span class="ms-1 uil-edit-alt" style="height:12.8px;width:12.8px;cursor: not-allowed;"></span></span>';
                } else {
                    $status = '<span class="badge badge-phoenix fs--2 badge-phoenix-' . $op->leave_statuses->color .
                        ' " style="cursor: pointer;" id="editTimesheetStatus" data-id="' . $op->id .
                        '" data-table="employee_timesheet_table"><span class="badge-label">' . $op->leave_statuses->title .
                        '</span><span class="ms-1 uil-edit-alt" style="height:12.8px;width:12.8px;cursor: pointer;"></span></span>';
                }
            } else {
                $status = '<span class="badge badge-phoenix fs--2 badge-phoenix-secondary" style="cursor: not-allowed;" ><span class="badge-label">' .
                        'Incomplete</span><span class="ms-1 fa-regular fa-circle-xmark text-danger" style="height:12.8px;width:12.8px;cursor: not-allowed;"></span></span>';
            }

            $disabled_link = 'btn btn-sm';
            // if ($time_sheet_entry) {
            //     $disabled_link = 'btn btn-sm disabled-link';
            // }

            $entries_count = $op->entries->count();

            $go_to_route = route("tracki.employee.timesheet.entries.add", encrypt($op->id));
            $pdf_route = route("tracki.employee.timesheet.invoice.pdf", encrypt($op->id));

            $entries_icon_color = "success";

            if ($entries_count) {
                $go_to_route = route("tracki.employee.timesheet.entries", encrypt($op->id));
                $entries_icon_color = "seconday";
            }


            $actions_div = '<div class="font-sans-serif btn-reveal-trigger position-static">';

            $actions_pdf =
                '<a href="' . $pdf_route . '" class="btn btn-sm" id="bookingDetails" target="_blank" data-id="' . $op->id .
                '" data-table="employee_timesheet_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Invoice">' .
                '<i class="fa-solid fa-file-invoice text-' . $entries_icon_color . '"></i></a>';


            $actions_edit =
                '<a href="' . $go_to_route . '" class="btn btn-sm" id="bookingDetails" data-id="' . $op->id .
                '" data-table="employee_timesheet_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Create Timesheet Entries">' .
                '<i class="fas fa-network-wired text-' . $entries_icon_color . '"></i></a>';

            $actions_delete =
                '<a href="javascript:void(0)" class="btn btn-sm" data-table="employee_timesheet_table" data-id="' . $op->id .
                '" id="deleteTimesheet" data-bs-toggle="tooltip" data-bs-placement="right" title="Delete">' .
                '<i class="bx bx-trash text-danger"></i></a></div></div>';

            // if ($op->leave_statuses->title == 'Approved') {
            //     $actions = $actions_div . $actions_edit . $actions_pdf;
            // } elseif (($op->leave_statuses->title == 'Pending')) {
            //     $actions = $actions_div . $actions_edit . $actions_delete;
            // } elseif ($op->leave_statuses->title == 'Declined') {
            //     $actions = $actions_div . $actions_edit . $actions_delete;
            // }

            if ($op->leave_statuses?->title == 'Approved') {
                $actions = $actions_div . $actions_edit . $actions_pdf;
            } else {
                $actions = $actions_div . $actions_edit . $actions_delete;
            }

            $profile_url = route('tracki.employee.profile', encrypt($op->employees->id));

            return [
                'id1' => '<div class="ms-3">' . $op->id . '</div>',
                'id' => $op->id,
                'image' => $image,
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $user_id = Auth::user()->id;
        $op = new EmployeeTimeSheet();
        $employee = Employee::findOrFail($request->employee_id);
        $month_selected = MonthsNames::findOrFail($request->month_selected_id);

        $period = $request->month_selected_id . '-' . $request->year_selected;
        $contract_start_date_MY = Carbon::parse($employee->contract_start_date)->format('F-Y');
        $contract_end_date_MY = Carbon::parse($employee->contract_end_date)->format('F-Y');

        $start_date = Carbon::createFromFormat('M-Y', $contract_start_date_MY);
        $end_date = Carbon::createFromFormat('M-Y', $contract_end_date_MY);
        $requested_date = Carbon::createFromFormat('m-Y', $period);

        $error = false;
        $message = 'timesheet created successfully';

        // Log::info('EmployeeTimeSheetController:start_date ' . $start_date);
        // Log::info('EmployeeTimeSheetController:requested_date ' . $requested_date);

        if ($requested_date->lessThan($start_date) || $requested_date->greaterThan($end_date)) {
            $error = true;
            $message = 'Your timesheet must be between your contract start date and end date';
            return response()->json(['error' => $error, 'message' => $message,]);
        }

        $month_name = Carbon::parse($request->year_selected . '-' . $month_selected->month_number . '-01')->format('F');

        $op->employee_id = $request->employee_id;
        $op->month_selected_id = $request->month_selected_id;
        $op->year_selected = $request->year_selected;
        $op->timesheet_period = $month_name . '-' . $request->year_selected;
        $op->days_in_month = getDaysInMonthOfYear($month_name . '-' . $request->year_selected);
        $op->user_id = $user_id;
        $op->status_id = 99;
        $op->entries_exists = 'N';
        $op->save();

        // Toastr::success('Has been add successfully :)','Success');
        // return redirect()->back()->with($notification);
        return response()->json([
            'error' => $error,
            'message' => $message,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // dd($request->all());
        //
        // Log::alert('EmployeeController::update');
        $id = Auth::user()->id;
        $op = EmployeeTimeSheet::findOrFail($request->id);

        for ($i = 1; $i < $request->number_of_days + 1; $i++) {

            $op->employee_id = $request->employee_id;
            $op->employee_timesheet_id = $request->employee_timesheet_id;
            $op->calendar_day = $request->calendar_day_ . $i;
            $op->day_action = $request->day_action_ . $i;
        }

        $op->save();

        // Log::info($request->all());

        $notification = array(
            'message'       => 'User created successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        // return redirect()->back()->with($notification);
        return Redirect::route('tracki.employee.timesheet')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        //
        EmployeeTimeSheet::where('id', '=', $id)->delete();
        EmployeeTimeSheetEntry::where('employee_timesheet_id', $id)->delete();

        $notification = array(
            'message'       => 'Time Sheet deleted successfully',
            'alert-type'    => 'success'
        );

        // dd($taskId);

        return response()->json([
            'error' => false,
            'message' => 'Time Sheet deleted successfully',
        ]);
    }

    // return the edit employee view
    public function getEmpTimeSheetEditView($id)
    {
        $employee_timesheet = EmployeeTimeSheet::findOrFail($id);
        $employees = Employee::findOrFail($employee_timesheet->employee_id);
        // $employee_leaves = EmployeeLeave::findOrFail($employee_timesheet->employee_id);


        // Log::alert('EmployeeController::getEmpEditView file_name: ' . $emp->emp_files?->file_name);

        $view = view('/tracki/employee/timesheet/mv/edit', [
            'employee_timesheet' => $employee_timesheet,
            'employees' => $employees,
        ])->render();

        return response()->json(['view' => $view]);
    }

    public function editStatus($id)
    {
        //  dd('editTaskProgress');
        $data = EmployeeTimeSheet::find($id);
        //dd($data);
        // $data_arr = [];

        // $data_arr[] = [
        //     "id"        => $data->id,
        //     "status_id"  => $data->status_id,
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

        $employee_timesheet = EmployeeTimeSheet::findOrFail($request->id);
        $count_of_actions = EmployeeApproval::where('object_id', $request->id)
            ->where('object_name', 'LEAVE')->count();
        $approvals = new EmployeeApproval();
        $status_title = EmployeeLeaveStatus::findOrFail($request->status_id);

        $employee_timesheet->update([
            'status_id' => $request->status_id,
            'performer_id' => $performer_id,
            'additional_information' => $request->additional_information,
        ]);

        // insert into approvals table
        $approvals->object_name = 'TIMESHEET';
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

        return response()->json(['error' => false, 'message' => 'Timesheet updated successfully.']);

        // Toastr::success('Has been add successfully :)','Success');
        // return redirect()->back()->with($notification);
        // deleteEvent
    } //updateTaskStatus
}
