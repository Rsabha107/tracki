<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeEmergencyContact;
use App\Models\EmployeeRelationship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class EmployeeEmergencyContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // dd($id);
        $employee_emergencies = EmployeeEmergencyContact::all();
        // $employees = Employee::all();
        $employees = Employee::when(auth()->user()->employee_id, function ($query, $id){
            return $query->where('employees_all.id', $id);
        })->get();
        $relationships = EmployeeRelationship::all();
        // dd($emps);


        // dd(FacadesRoute::currentRouteName());
        // dd(FacadesRequest::url());
        return view('tracki.employee.emergency.list', compact('employee_emergencies', 'employees', 'relationships'));
    }

    public function get($id)
    {
        $db_result = EmployeeEmergencyContact::findOrFail($id);
        // dd($db_result);
        return response()->json(['db_result' => $db_result]);
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
        $op = new EmployeeEmergencyContact();
        // $emp = new Employee();
        // $data = new employeeAddress();

        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        // dd($validator);

        // Log::info($request->all());

        if ($validator->fails()) {
            Log::info($validator->errors());
            $error = true;
            $message = 'Emergency Contact not create.' . $op->id;
        } else {
            $error = false;
            $message = 'Emergency Contact created .' . $op->id;

            $op->employee_id = $request->employee_id;
            $op->first_name = $request->first_name;
            $op->last_name = $request->last_name;
            $op->relationship_id = $request->relationship_id;
            $op->contact_number = $request->contact_number;
            $op->created_by = $id;
            $op->updated_by = $id;

            $op->save();

            // dd($op->number);
        }

        return response()->json(['error' => $error, 'message' => $message]);
    }

    public function list($id = null)
    {

        // dd('test');
        $user = User::findOrFail(Auth::user()->id);
        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";

        if ($id) {
            $op = EmployeeEmergencyContact::where('employee_id', $id)->orderBy($sort, $order);
        } else {
            $op = EmployeeEmergencyContact::orderBy($sort, $order);
        }


        $user_id = ($user->hasRole('SuperAdmin')||$user->hasRole('HRMSADMIN')) ? 0 : $user->employee_id;

        $op = $op->when($user_id, function ($query, $user_id) {
            return $query->where('employee_id', $user_id);
        });

        if ($search) {
            $op = $op->where(function ($query) use ($search) {
                $query->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
                    ->orWhere('contact_number', 'like', '%' . $search . '%')
                    ->orWhereHas('relationships', function ($query) use ($search) {
                        $query->where('title', 'like', '%' . $search . '%');
                    })->orWhereHas('employees', function ($query) use ($search) {
                        $query->where('full_name', 'like', '%' . $search . '%')
                            ->orWhere('employee_number', 'like', '%' . $search . '%')
                            ->orWhere('work_email_address', 'like', '%' . $search . '%');
                    });
            });
        }

        // if ($search) {
        //     $op = $op->where(function ($query) use ($search) {
        //         $query->where('first_name', 'like', '%' . $search . '%')
        //         ->orWhere('last_name', 'like', '%' . $search . '%')
        //         ->orWhere('contact_number', 'like', '%' . $search . '%');
        //     })->orWhereHas('relationships', function ($query) use ($search) {
        //         $query->where('title', 'like', '%' . $search . '%');
        //     })->orWhereHas('employees', function ($query) use ($search) {
        //         $query->where('full_name', 'like', '%' . $search . '%')
        //         ->orWhere('work_email_address', 'like', '%' . $search . '%');
        //     });
        // }

        $total = $op->count();

        $op = $op->paginate(request("limit"))->through(function ($op) {

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

            $actions =
                '<div class="font-sans-serif btn-reveal-trigger position-static">' .
                '<a href="javascript:void(0)" class="btn btn-sm" id="edit_employee_emergency_contact" data-action="update" " data-type="edit" data-id=' .
                $op->id .
                ' data-table="employee_emergency_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Update">' .
                '<i class="fa-solid fa-pen-to-square text-primary"></i></a>' .
                '<a href="javascript:void(0)" class="btn btn-sm" data-table="employee_emergency_table" data-id="' .
                $op->id .
                '" id="deleteEmployeeEmergencyContact" data-bs-toggle="tooltip" data-bs-placement="right" title="Delete">' .
                '<i class="bx bx-trash text-danger"></i></a></div></div>';

            $profile_url = route('tracki.employee.profile', encrypt($op->employees->id));

            return [
                'id1' => '<div class="ms-3">' . $op->id . '</div>',
                'id' => $op->id,
                'image' => $image,
                'employee_number' => '<div class="align-middle white-space-wrap fw-bold fs-9"><a href="' . $profile_url . '">' . $op->employees->employee_number . '</a></div>',
                'full_name' => '<div class="ms-1">' . $op->employees?->full_name . '</div>',
                'emergency_name' => '<div class="ms-1">' . $op->first_name . ' ' . $op->last_name . '</div>',
                'relationship' => '<div class="ms-1">' . $op->relationships->title . '</div>',
                'contact_number' => '<div class="ms-1">' . $op->contact_number . '</div>',
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
        $op = EmployeeEmergencyContact::findOrFail($request->id);


        // $op->employee_id = $request->employee_id;
        $op->first_name = $request->first_name;
        $op->last_name = $request->last_name;
        $op->relationship_id = $request->relationship_id;
        $op->contact_number = $request->contact_number;
        $op->updated_by = $id;

        $op->save();

        // Log::info($request->all());

        return response()->json([
            'error' => false,
            'message' => 'emergency contact updated successfully ',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        //
        EmployeeEmergencyContact::where('id', '=', $id)->delete();

        $notification = array(
            'message'       => 'emergency contact deleted successfully',
            'alert-type'    => 'success'
        );

        // dd($taskId);

        return response()->json([
            'error' => false,
            'message' => 'emergency contact deleted successfully',
        ]);
    }

    // return the edit employee view
    public function getEditView($id)
    {
        $employees = Employee::all();
        $employee_emergency = EmployeeEmergencyContact::findOrFail($id);

        // Log::alert('EmployeeController::getEmpEditView file_name: ' . $emp->emp_files?->file_name);

        $view = view('/tracki/employee/emergency/mv/edit', [
            'employee_emergency' => $employee_emergency,
            'employees' => $employees,
        ])->render();

        return response()->json(['view' => $view]);
    }
}
