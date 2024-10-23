<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeBank;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class EmployeeBankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // dd($id);
        $employee_banks = EmployeeBank::all();
        $employees = Employee::all();
        // dd($emps);


        // dd(FacadesRoute::currentRouteName());
        // dd(FacadesRequest::url());
        return view('tracki.employee.bank.list', compact('employees'));
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
        $op = new EmployeeBank();
        // $emp = new Employee();
        // $data = new employeeAddress();

        $rules = [
            'employee_id' => 'required',
            'bank_branch_name' => 'required',
            'bank_account_name' => 'required',
            'iban' => 'required|unique:employee_banks|min:29|max:29',
            'swift_code' => 'required|min:8|max:8',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // Log::info($validator->errors());
            $error = true;
            $message = implode($validator->errors()->all('<div>:message</div>'));
        } else {
            $error = false;
            $message = 'Bank created successfully.' . $op->id;

            $op->user_id = $request->employee_id;
            $op->employee_id = $request->employee_id;
            $op->bank_account_name = $request->bank_account_name;
            $op->bank_branch_name = $request->bank_branch_name;
            $op->iban = $request->iban;
            $op->swift_code = $request->swift_code;

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
            $op = EmployeeBank::where('employee_id', $id)->orderBy($sort, $order);
        } else {
            $op = EmployeeBank::orderBy($sort, $order);
        }

        // dd($op);
        $user_id = ($user->hasRole('SuperAdmin')||$user->hasRole('HRMSADMIN')) ? 0 : $user->employee_id;

        $op = $op->when($user_id, function ($query, $user_id) {
            return $query->where('employee_id', $user_id);
        });

        if ($search) {
            $op = $op->where(function ($query) use ($search) {
                $query->where('bank_branch_name', 'like', '%' . $search . '%')
                    ->orWhere('bank_account_name', 'like', '%' . $search . '%')
                    ->orWhere('iban', 'like', '%' . $search . '%')
                    ->orWhere('swift_code', 'like', '%' . $search . '%')
                    ->orWhereHas('employees', function ($query) use ($search) {
                        $query->where('full_name', 'like', '%' . $search . '%')
                            ->orWhere('employee_number', 'like', '%' . $search . '%');
                    });
            });
        }

        $total = $op->count();

        $op = $op->paginate(request("limit"))->through(function ($op) {

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
                '<a href="javascript:void(0)" class="btn btn-sm" id="edit_employee_bank" data-action="update" " data-type="edit" data-id=' .
                $op->id .
                ' data-table="employee_bank_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Update">' .
                '<i class="fa-solid fa-pen-to-square text-primary"></i></a>' .
                '<a href="javascript:void(0)" class="btn btn-sm" data-table="employee_bank_table" data-id="' .
                $op->id .
                '" id="deleteEmployeeBank" data-bs-toggle="tooltip" data-bs-placement="right" title="Delete">' .
                '<i class="bx bx-trash text-danger"></i></a></div></div>';

            $profile_url = route('tracki.employee.profile', encrypt($op->employees->id));

            return [
                'id1' => '<div class="ms-3">' . $op->id . '</div>',
                'id' => $op->id,
                'image' => $image,
                'full_name' => '<div class="ms-1">' . $op->employees?->full_name . '</div>',
                'employee_number' => '<div class="align-middle white-space-wrap fw-bold fs-9"><a href="' . $profile_url . '">' . $op->employees->employee_number . '</a></div>',
                'bank_branch_name' => '<div class="ms-1">' . $op->bank_branch_name . '</div>',
                'bank_account_name' => '<div class="ms-1">' . $op->bank_account_name . '</div>',
                'iban' => '<div class="ms-1">' . $op->iban . '</div>',
                'swift_code' => '<div class="ms-1">' . $op->swift_code . '</div>',
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
        $id = Auth::user()->id;
        $op = EmployeeBank::findOrFail($request->id);

        $rules = [
            // 'employee_id' => 'required',
            'bank_branch_name' => 'required',
            'bank_account_name' => 'required',
            'iban' => 'required|min:29|max:29|unique:employee_banks,iban,' . $op->id,
            'swift_code' => 'required|min:8|max:8',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // Log::info($validator->errors());
            $error = true;
            $message = implode($validator->errors()->all('<div>:message</div>'));
        } else {
            $error = false;
            $message = 'Bank updated successfully.' . $op->id;

            $op->bank_account_name = $request->bank_account_name;
            $op->bank_branch_name = $request->bank_branch_name;
            $op->iban = $request->iban;
            $op->swift_code = $request->swift_code;

            $op->save();
        }

        return response()->json([
            'error' => $error,
            'message' => $message,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        //
        EmployeeBank::where('id', '=', $id)->delete();

        $notification = array(
            'message'       => 'bank address deleted successfully',
            'alert-type'    => 'success'
        );

        // dd($taskId);

        return response()->json([
            'error' => false,
            'message' => 'bank address deleted successfully',
        ]);
    }

    // return the edit employee view
    public function getEmpEditView($id)
    {
        $employees = Employee::all();
        $employee_bank = EmployeeBank::findOrFail($id);

        $view = view('/tracki/employee/bank/mv/edit', [
            'employee_bank' => $employee_bank,
            'employees' => $employees,
        ])->render();

        return response()->json(['view' => $view]);
    }
}
