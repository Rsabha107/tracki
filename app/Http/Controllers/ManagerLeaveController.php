<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeApproval;
use App\Models\EmployeeFile;
use App\Models\EmployeeLeave;
use App\Models\EmployeeLeaveAttachment;
use App\Models\EmployeeLeaveStatus;
use App\Models\EmployeeLeaveType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ManagerLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */

    public function index()
    {
        //
        $employee_id = auth()->user()->employee_id;

        // $employees = Employee::findOrFail($employee_id);
        // $employee_leaves = $employees->leaves();

        $employee_leave_types = EmployeeLeaveType::all();
        $employee_leave_statuses = EmployeeLeaveStatus::all();

        return view('tracki.employee.managers.leave.list', compact('employee_leave_types', 'employee_leave_statuses'));
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $id = Auth::user()->id;
        $op = new EmployeeLeave();
        $data = new EmployeeLeaveAttachment();

        // $emp = new Employee();
        // $data = new employeeAddress();

        $rules = [
            'employee_id' => 'required',
            'leave_type_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        // dd($validator);

        // Log::info($request->all());

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

            // Log::info('EmployeeLeaveController: $request->date_from: ' . $request->date_from);
            // Log::info('EmployeeLeaveController: request->date_to: ' . $request->date_to);

            // Log::info('EmployeeLeaveController: start_date_d: ' . $start_date_d);
            // Log::info('EmployeeLeaveController: end_date_d: ' . $end_date_d);

            // Log::info('EmployeeLeaveController: duration: ' . $duration);

            // Log::info('EmployeeLeaveController: month_start_date: ' . $month_start_date);
            // Log::info('EmployeeLeaveController: month_end_date: ' . $month_end_date);

            // Log::info('EmployeeLeaveController: start_of_month: ' . $start_of_month);
            // Log::info('EmployeeLeaveController: end_of_month: ' . $end_of_month);

            // check if months are overlapping if same month then get the number of leaves taken
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


            $op->user_id = $id;
            $op->employee_id = $request->employee_id;
            $op->leave_type_id = $request->leave_type_id;
            $op->date_from = Carbon::createFromFormat('d/m/Y', $request->date_from)->toDateString();
            $op->date_to = Carbon::createFromFormat('d/m/Y', $request->date_to)->toDateString();
            $op->reason = $request->reason;
            $op->status_id = 10;
            $op->number_of_days = $duration;
            $op->reason = $request->reason;

            $op->save();

            if ($request->file('leave_file_name')) {
                $file = $request->file('leave_file_name');
                $filename = rand() . date('ymdHis') . $file->getClientOriginalName();
                $file->move(public_path('storage/upload/profile_images'), $filename);
                $data->file_name = $filename;
                $data->original_file_name = $file->getClientOriginalName();
                $data->file_extension = $file->getClientOriginalExtension();
                $data->file_size = $_FILES['leave_file_name']['size']; //$request->file('profile_image_name')->getSize();
                $data->file_path = '/storage/upload/profile_images/';
                $data->user_id = $id;
                $data->employee_id = $op->employee_id;
                $data->leave_id = $op->id;

                $data->save();
            }
            // dd($op->number);
        }

        return response()->json(['error' => $error, 'message' => $message]);
    }

    public function list($id = null)
    {
        // dd('test');
        // LOG::info('inside list:****************** '.$id);

        $user = User::findOrFail(Auth::user()->id);
        $user_type = Auth::user()->usertype;

        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";

        $leave_type = (request()->leave_type) ? request()->leave_type : "";
        $status = (request()->status) ? request()->status : "";

        $op = EmployeeLeave::whereHas('employees', function (Builder $query) {
            $query->where('reporting_to_id', '=', auth()->user()->employee_id);
        })->orderBy($sort, $order);

        $user_id = ($user->hasRole('SuperAdmin') || $user->hasRole('HRMSADMIN')) ? 0 : $user->employee_id;

        if ($search) {
            $op = $op->where(function ($query) use ($search) {
                $query->where('date_from', 'like', '%' . $search . '%')
                    ->orWhere('date_to', 'like', '%' . $search . '%')
                    ->orWhere('reason', 'like', '%' . $search . '%')
                    ->orWhereHas('employees', function ($query) use ($search) {
                        $query->where('full_name', 'like', '%' . $search . '%')
                            ->orWhere('employee_number', 'like', '%' . $search . '%');
                    })->orWhereHas('leave_types', function ($query) use ($search) {
                        $query->where('title', 'like', '%' . $search . '%');
                    });
            });
        }

        if ($status) {
            $op = $op->where(function ($query) use ($status) {
                $query->where('status_id', 'like', '%' . $status . '%');
            });
        }

        if ($leave_type) {
            $op = $op->where(function ($query) use ($leave_type) {
                $query->where('leave_type_id', 'like', '%' . $leave_type . '%');
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

            $href_disabled = null;

            $status = '<span class="badge badge-phoenix fs--2 badge-phoenix-' . $op->leave_statuses->color .
                ' " style="cursor: pointer;" id="editLeaveStatus" data-id="' . $op->id .
                '" data-table="employee_leave_table"><span class="badge-label">' . $op->leave_statuses->title .
                '</span><span class="ms-1 uil-edit-alt" style="height:12.8px;width:12.8px;cursor: pointer;"></span></span>';

            $attach = null;
            if ($op->attachements->count()) {
                $attach = '<a href="javascript:void(0)" class="btn btn-sm" id="show_employee_leave_attachment" data-type="edit" data-id=' .
                    $op->id .
                    ' data-table="employee_leave_table" data-bs-toggle="tooltip" data-bs-placement="right" title="attachments">' .
                    '<i class="fas fa-paperclip text-secondary"></i></a>';

                $attach = '<button class="btn p-0 text-body-tertiary fs-10 me-2"><span class="fas fa-paperclip me-1"></span>' . $op->attachements->count() . '</button>';
            }

            $icons = (($op->attachements->count()) ? '<button class="btn p-0 text-body-tertiary fs-10 me-2"><span class="fas fa-paperclip me-1"></span>' . $op->attachements->count() . '</button>' : "");

            $profile_url = route('tracki.employee.profile', encrypt($op->employees->id));

            return [
                'id1' => '<div class="ms-3">' . $op->id . '</div>',
                'id' => $op->id,
                'image' => $image,
                // 'employee_number' => '<a class="fw-bold mb-0 line-clamp-2 text-body-emphasis" href="' . $profile_url . '" data-table="employee_leave_table">' . $op->employees?->employee_number . '</a><div class="d-flex align-items-center">' .
                //     '<p class="mb-0 text-body-highlight fw-semibold fs-10 me-2">' . $icons . '</p></div></div></div>',
                'employee_number' => '<div class="align-middle white-space-wrap fw-bold fs-9">' . $op->employees->employee_number . '</div>',
                'full_name' => '<div class="ms-1">' . $op->employees?->full_name . '</div>',
                'leave_type' => '<div class="ms-1">' . $op->leave_types?->title . '</div>',
                'date_from' => '<div class="ms-1">' . format_date($op->date_from) . '</div>',
                'date_to' => '<div class="ms-1">' . format_date($op->date_to) . '</div>',
                'number_of_days' => '<div class="ms-1">' . $op->number_of_days . '</div>',
                'reason' => '<div class="ms-1">' . $op->reason . '</div>',
                'approved_by' => '<div class="ms-1">' . $op->performer?->full_name . '</div>',
                'status' => $status,
                'attach' => $attach,
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
            // Log::info($validator->errors());
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

        // Log::info('performer_id = ' . $performer_id);

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
