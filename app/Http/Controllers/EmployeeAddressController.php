<?php

namespace App\Http\Controllers;

use App\Models\AddressType;
use App\Models\Country;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\employeeAddress;
use App\Models\EmployeeFile;
use App\Models\EmployeeRelationship;
use App\Models\EmployeeType;
use App\Models\Gender;
use App\Models\Language;
use App\Models\MaritalStatus;
use App\Models\Nationality;
use App\Models\Relationship;
use App\Models\Salutation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EmployeeAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        //
        // dd($id);
        $emps = Employee::findOrFail($id);
        // dd($emps);
        $countries = Country::all();
        $nationalities = Nationality::all();
        $employee_types = EmployeeType::all();
        $salutations = Salutation::all();
        $genders = Gender::all();
        $marital_statuses = MaritalStatus::all();
        $departments = Department::all();
        $designations = Designation::all();
        $relationships = EmployeeRelationship::all();
        $addresses = EmployeeAddress::all();
        $address_types = AddressType::all();

        // dd(FacadesRoute::currentRouteName());
        // dd(FacadesRequest::url());
        return view('tracki.employee.address.list', compact(
            'emps',
            'countries',
            'nationalities',
            'employee_types',
            'salutations',
            'genders',
            'marital_statuses',
            'departments',
            'designations',
            'relationships',
            'addresses',
            'address_types',
        ));
    }


    public function create()
    {
        //
        $emps = Employee::all();
        $countries = Country::all();
        $nationalities = Nationality::all();
        $employee_types = EmployeeType::all();
        $salutations = Salutation::all();
        $genders = Gender::all();
        $marital_statuses = MaritalStatus::all();
        $departments = Department::all();
        $designations = Designation::all();
        $relationships = EmployeeRelationship::all();
        $address_types = AddressType::all();

        // dd(FacadesRoute::currentRouteName());
        // dd(FacadesRequest::url());
        return view('tracki.employee.address.create', compact(
            'emps',
            'countries',
            'nationalities',
            'employee_types',
            'salutations',
            'genders',
            'marital_statuses',
            'departments',
            'designations',
            'relationships',
            'address_types',
        ));
    }

    /**
     * add a new resource.
     */
    public function add()
    {
        //
        return view('tracki.employee.address.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $id = Auth::user()->id;
        $op = new employeeAddress();

        $rules = [
            'employee_address1' => 'required',
            'employee_address_country' => 'required',
            'primary_address' => Rule::unique('employee_addresses')->where('employee_id', $request->id),
        ];

        $customMessages = [
            'primary_address.unique' => 'Only one primary address is allowed.'
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        // dd($validator);

        // Log::info($request->all());

        if ($validator->fails()) {
            // Log::info($validator->errors());
            $error = true;
            $message = implode($validator->errors()->all('<div>:message</div>'));
        } else {
            $error = false;
            $message = 'Employee Address created .';

            $op->address_type = $request->employee_address_type;
            $op->employee_id = $request->id;
            $op->address1 = $request->employee_address1;
            $op->address2 = $request->employee_address2;
            $op->city = $request->employee_city;
            $op->state = $request->employee_state;
            $op->zipcode = $request->employee_zipcode;
            $op->country_id = $request->employee_address_country;
            $op->primary_address = $request->primary_address;
            $op->creator_id = $id;

            $op->save();

            // dd($op->number);
        }

        return response()->json(['error' => $error, 'message' => $message]);
    }

    public function list($id)
    {

        // dd('test');
        $user = User::findOrFail(Auth::user()->id);
        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";
        $op = employeeAddress::where('employee_id', $id)->orderBy($sort, $order);

        // dd($op);


        if ($search) {
            $op = $op->where(function ($query) use ($search) {
                $query->where('address1', 'like', '%' . $search . '%')
                    ->orWhere('city', 'like', '%' . $search . '%');
            });
        }
        $total = $op->count();

        $user_id = ($user->hasRole('SuperAdmin') || $user->hasRole('HRMSADMIN')) ? 0 : $user->employee_id;


        $op = $op->when($user_id, function ($query, $user_id) {
            return $query->where('employee_id', $user_id);
        });

        $op = $op->paginate(request("limit"))->through(function ($op) {


            // $profile_url = route('tracki.employee.profile', $op->id);
            $actions =
                '<div class="font-sans-serif btn-reveal-trigger position-static">' .
                '<a href="javascript:void(0)" class="btn btn-sm" id="edit_employee_address" data-action="update" " data-type="edit" data-id=' .
                $op->id .
                ' data-table="employee_address_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Update">' .
                '<i class="fa-solid fa-pen-to-square text-primary"></i></a>' .
                '<a href="javascript:void(0)" class="btn btn-sm" data-table="employee_address_table" data-id="' .
                $op->id .
                '" id="deleteEmployeeAddress" data-bs-toggle="tooltip" data-bs-placement="right" title="Delete">' .
                '<i class="bx bx-trash text-danger"></i></a></div></div>';

            return [
                'id1' => '<div class="ms-3">' . $op->id . '</div>',
                'id' => $op->id,
                'address_type' => '<div class="ms-3">' . $op->address_types->title . '</div>',
                'address1' => '<div class="ms-3">' . $op->address1 . '</div>',
                'address2' => $op->address2,
                'city' => $op->city,
                'state' => $op->state,
                'zipcode' => $op->zipcode,
                'actions' => $actions,
                'country' => $op->country?->country_name,
                'primary_address' => $op->primary_address,
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
        $op = EmployeeAddress::findOrFail($request->id);

        $rules = [
            'employee_address1' => 'required',
            'employee_address_country' => 'required',
            'primary_address' => Rule::unique('employee_addresses')->where('employee_id', $op->employee_id),
        ];

        $customMessages = [
            'primary_address.unique' => 'Only one primary address is allowed.'
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            // Log::info($validator->errors());
            $error = true;
            $message = implode($validator->errors()->all('<div>:message</div>'));
        } else {
            $error = false;
            $message = 'Employee Address created .';
            $op->address_type = $request->employee_address_type;
            $op->address1 = $request->employee_address1;
            $op->address2 = $request->employee_address2;
            $op->city = $request->employee_city;
            $op->state = $request->employee_state;
            $op->zipcode = $request->employee_zipcode;
            $op->country_id = $request->employee_address_country;
            $op->primary_address = $request->primary_address;
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
        employeeAddress::where('id', '=', $id)->delete();

        $notification = array(
            'message'       => 'Employee address deleted successfully',
            'alert-type'    => 'success'
        );

        // dd($taskId);

        return response()->json([
            'error' => false,
            'message' => 'Employee address deleted successfully',
        ]);
    }

    // return the edit employee view
    public function getAddressEditView($id)
    {
        $employee_address = EmployeeAddress::findOrFail($id);
        $countries = Country::all();
        $address_types = AddressType::all();

        $view = view('/tracki/employee/address/mv/edit', [
            'employee_address' => $employee_address,
            'countries' => $countries,
            'address_types' => $address_types,
        ])->render();

        return response()->json(['view' => $view]);
    }
}
