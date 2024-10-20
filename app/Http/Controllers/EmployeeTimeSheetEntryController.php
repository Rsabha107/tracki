<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeLeave;
use App\Models\EmployeeLeaveStatus;
use App\Models\EmployeeLeaveType;
use App\Models\EmployeeSalary;
use App\Models\EmployeeTimeSheet;
use App\Models\EmployeeTimeSheetEntry;
use App\Models\InvoiceNote;
use App\Models\MonthsNames;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class EmployeeTimeSheetEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        //
        // dd($id);
        $employee_timesheet_entries = EmployeeTimeSheetEntry::where('employee_timesheet_id', decrypt($id))->get();
        // dd($employee_timesheet_entries);
        $employee_timesheets = EmployeeTimeSheet::findOrFail(decrypt($id));
        $employees = Employee::all();
        $months_name = MonthsNames::orderBy('month_order', 'ASC')->get();
        // dd($emps);



        // dd(FacadesRoute::currentRouteName());
        // dd(FacadesRequest::url());
        return view('tracki.employee.timesheet.entries.list', [
            'employee_timesheet_entries' => $employee_timesheet_entries,
            'employee_timesheets' => $employee_timesheets,
            'employees' => $employees,
            'months_name' => $months_name,
            'id' => $id,
        ]);

        // compact('employee_timesheet_entries', 'employee_timesheets', 'employees', 'months_name', 'id'));
    }

    /**
     * add a new resource.
     */
    public function add($id)
    {
        //
        // dd($id);
        $employee_timesheet = EmployeeTimeSheet::findOrFail(decrypt($id));
        $months = MonthsNames::findOrFail($employee_timesheet->month_selected_id);

        // dd(Carbon::parse($employee_timesheet->year_selected.'-'.$months->month_number.'-01')->format('F'));
        // dd(getDaysInMonthOfYear('2023-02'));

        // dd(FacadesRoute::currentRouteName());
        // dd(FacadesRequest::url());
        return view('tracki.employee.timesheet.entries.add', compact('employee_timesheet', 'months'));
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

    public function get($id)
    {
        $db_result = EmployeeTimeSheetEntry::findOrFail($id);
        // dd($db_result);
        return response()->json(['db_result' => $db_result]);
    }

    public function list($id)
    {

        // dd('test');
        $user = User::findOrFail(auth()->user()->id);
        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";
        $employee_timesheet_entries = EmployeeTimeSheetEntry::orderBy($sort, $order);
        $employee_timesheet_entries = $employee_timesheet_entries->where('employee_timesheet_id', $id);

        // dd($id);
        // dd($employee_timesheet_entries);
        // dd($employee_timesheets);


        if ($search) {
            $employee_timesheet_entries = $employee_timesheet_entries->where(function ($query) use ($search) {
                $query->where('address1', 'like', '%' . $search . '%')
                    ->orWhere('city', 'like', '%' . $search . '%');
            });
        }
        $total = $employee_timesheet_entries->count();

        $employee_timesheet_entries = $employee_timesheet_entries->paginate(request("limit"))->through(function ($employee_timesheet_entries) use ($user) {

            $is_pending = ($employee_timesheet_entries->timesheet->leave_statuses->title == 'Pending') ? true : false;

            if ($user->hasRole('User')) {
                if ($is_pending) {
                    $actions =
                        '<div class="font-sans-serif btn-reveal-trigger position-static">' .
                        '<a href="javascript:void(0)" class="btn btn-sm" id="edit_employee_timesheet_entry" data-id="' .
                        $employee_timesheet_entries->id .
                        '" data-table="employee_timesheet_entry_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Update">' .
                        '<i class="fa-solid fa-pen-to-square text-primary"></i></a>';
                } else {
                    $actions = null;
                }
            } else {
                $actions =
                    '<div class="font-sans-serif btn-reveal-trigger position-static">' .
                    '<a href="javascript:void(0)" class="btn btn-sm" id="edit_employee_timesheet_entry" data-id="' .
                    $employee_timesheet_entries->id .
                    '" data-table="employee_timesheet_entry_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Update">' .
                    '<i class="fa-solid fa-pen-to-square text-primary"></i></a>';
            }

            $date_action_arr = [
                'W' => 'Worked',
                'L' => 'Paid Leave',
                'U' => 'Unpaid Leave',
            ];

            return [
                'id1' => '<div class="ms-3">' . $employee_timesheet_entries->id . '</div>',
                'id' => $employee_timesheet_entries->id,
                'calendar_day' => '<div class="ms-3">' . $employee_timesheet_entries->calendar_day . '</div>',
                'day_action' => '<div class="ms-1">' . $date_action_arr[$employee_timesheet_entries->day_action] . '</div>',
                'actions' => $actions,
                'created_at' => format_date($employee_timesheet_entries->created_at,  'H:i:s'),
                'updated_at' => format_date($employee_timesheet_entries->updated_at, 'H:i:s'),
            ];
        });

        return response()->json([
            "rows" => $employee_timesheet_entries->items(),
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
     * After updating single entries we need to update the timesheet to refelect the updated values.
     */
    public function updateTimeSheet($id)
    {

        $user_id = Auth::user()->id;

        $op = EmployeeTimeSheet::findOrFail($id);
        $notes = InvoiceNote::first();

        $salary = EmployeeSalary::where('employee_id', $op->employee_id)->first();

        // lets update the main timesheet with values
        $count_worked = EmployeeTimeSheetEntry::where('employee_timesheet_id', $id)
            ->where('day_action', 'W')
            ->count();
        $count_leaves = EmployeeTimeSheetEntry::where('employee_timesheet_id', $id)
            ->where('day_action', 'L')
            ->count();
        $count_unpaid = EmployeeTimeSheetEntry::where('employee_timesheet_id', $id)
            ->where('day_action', 'U')
            ->count();
        $daily_rate = $salary?->net_salary / $op->days_in_month;

        // if (($count_worked + $count_leaves) > 30) {
        //     $total_number_of_days = 30;
        // } else {
        //     $total_number_of_days = $count_worked + $count_leaves;
        // }

        $total_number_of_days = $count_worked + $count_leaves;
        $actual_monthly = $daily_rate * $total_number_of_days;

        $op->days_worked = $count_worked;
        $op->leave_taken = $count_leaves;
        $op->unpaid_leave_taken = $count_unpaid;
        $op->total_days_eligible_for_payment = $total_number_of_days;
        $op->daily_rate = $daily_rate;
        $op->salary = $salary->net_salary;
        $op->total_payment = $actual_monthly;
        $op->note_1 = $notes->note_1;
        $op->note_2 = $notes->note_2;
        $op->entries_exists = 'Y';
        $op->status_id = 10;

        $op->save();
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

        $this->updateTimeSheet($request->employee_timesheet_id);

        $notification = array(
            'message'       => 'Time sheet Entries created successfully',
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
        $op = EmployeeTimeSheetEntry::findOrFail($request->id);


        $op->day_action = $request->day_action;
        $op->save();

        $this->updateTimeSheet($op->employee_timesheet_id);

        // Log::info($request->all());

        $notification = array(
            'message'       => 'Timesheet Entry updated successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        // return redirect()->back()->with($notification);
        return response()->json([
            'error' => false,
            'message' => 'Timesheet Entry updated successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        //
        // EmployeeTimeSheet::where('id', '=', $id)->delete();
        // EmployeeTimeSheetEntry::where('employee_timesheet_id', $id)->delete();

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
}
