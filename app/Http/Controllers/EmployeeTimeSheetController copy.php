<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeLeave;
use App\Models\EmployeeLeaveStatus;
use App\Models\EmployeeLeaveType;
use App\Models\EmployeeSalary;
use App\Models\EmployeeTimeSheet;
use App\Models\EmployeeTimeSheetEntry;
use App\Models\MonthsNames;
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
        $employees = Employee::all();
        $employee_leave_statuses = EmployeeLeaveStatus::all();
        $months_name = MonthsNames::orderBy('month_order', 'ASC')->get();
        // dd($emps);



        // dd(FacadesRoute::currentRouteName());
        // dd(FacadesRequest::url());
        return view('tracki.employee.timesheet.list', compact('employee_timesheets', 'employees', 'employee_leave_statuses', 'months_name'));
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

    public function list()
    {

        // dd('test');
        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";
        $op = EmployeeTimeSheet::orderBy($sort, $order);

        // dd($op);


        if ($search) {
            $op = $op->where(function ($query) use ($search) {
                $query->where('address1', 'like', '%' . $search . '%')
                    ->orWhere('city', 'like', '%' . $search . '%');
            });
        }
        $total = $op->count();

        $op = $op->paginate(request("limit"))->through(function ($op) {

            $salary = EmployeeSalary::where('employee_id', $op->id)->first();

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

            $href_disabled = null;

            if ($op->leave_statuses->title == 'Approved'){
                $href_disabled = "isDisabled";
                $status = '<span class="badge badge-phoenix fs--2 badge-phoenix-' . $op->leave_statuses->color .
                ' " style="cursor: not-allowed;" ><span class="badge-label">' . $op->leave_statuses->title .
                '</span><span class="ms-1 uil-edit-alt" style="height:12.8px;width:12.8px;cursor: not-allowed;"></span></span>';
            } else {
            $status = '<span class="badge badge-phoenix fs--2 badge-phoenix-' . $op->leave_statuses->color .
                ' " style="cursor: pointer;" id="editLeaveStatus" data-id="' . $op->id .
                '" data-table="employee_timesheet_table"><span class="badge-label">' . $op->leave_statuses->title .
                '</span><span class="ms-1 uil-edit-alt" style="height:12.8px;width:12.8px;cursor: pointer;"></span></span>';
            }

            $actions =

                '<div class="font-sans-serif btn-reveal-trigger position-static">' .
                '<a href="javascript:void(0)" class="btn btn-sm" id="bookingDetails" data-id="' .
                $op->id .
                '" data-table="employee_timesheet_table" data-bs-toggle="tooltip" data-bs-placement="right" title="View Booking Details">' .
                '<i class="fas fa-lightbulb text-warning"></i></a>' .
                '<a href="' . route("tracki.employee.timesheet.entries", $op->id) . '" class="btn btn-sm" id="editBooking" data-id="' .
                $op->id .
                '" data-table="employee_timesheet_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Update">' .
                '<i class="fa-solid fa-pen-to-square text-primary"></i></a>' .
                '<a href="javascript:void(0)" class="btn btn-sm" data-table="employee_timesheet_table" data-id="' .
                $op->id .
                '" id="deleteBooking" data-bs-toggle="tooltip" data-bs-placement="right" title="Delete">' .
                '<i class="bx bx-trash text-danger"></i></a></div></div>';

            return [
                'id1' => '<div class="ms-3">' . $op->id . '</div>',
                'id' => $op->id,
                'image' => $image,
                'full_name' => '<div class="ms-1">' . $op->employees?->full_name . '</div>',
                'employee_number' => '<div class="ms-1">' . $op->employees->employee_number . '</div>',
                'email_address' => '<div class="ms-1">' . $op->employees->work_email_address . '</div>',
                'timesheet_period' => '<div class="ms-1">' . $op->timesheet_period . '</div>',
                'designation' => '<div class="ms-1">' . $op->employees->designations->name . '</div>',
                'net_salary' => $salary?->net_salary,
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

        // Log::info($request->all());
        // dd(count($request->calendar_day));

        // foreach ($request->calendar_day as $key=>$value){
        //     dd ($value);
        // }

        for ($i = 0; $i < count($request->calendar_day); $i++) {

            // log::info('day_action' . $i . ' = ' . $request->day_action_ . $i);

            $op = new EmployeeTimeSheetEntry();
            $op->employee_id = $request->employee_id;
            $op->employee_timesheet_id = $request->employee_timesheet_id;
            $op->calendar_day = $request->calendar_day[$i];
            $op->day_action = $request->day_action[$i];
            $op->user_id = $user_id;
            $op->save();
        }



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
        $data_arr = [];

        $data_arr[] = [
            "id"        => $data->id,
            "status_id"  => $data->status_id,
        ];

        $response = ["retData"  => $data_arr];
        return response()->json($response);
    } // editTaskStatus

    public function updateStatus(Request $request)
    {

        $employee_leaves = EmployeeTimeSheet::findOrFail($request->id);
        $status_title = EmployeeLeaveStatus::findOrFail($request->status_id);

        $employee_leaves->update([
            'status_id' => $request->status_id,
        ]);


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
