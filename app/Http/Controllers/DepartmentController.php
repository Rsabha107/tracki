<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Department;
use App\Models\Person;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Support\Facades\Redirect;

class DepartmentController extends Controller
{
    //
    public function index()
    {
        $departments = Department::all();

        return view('tracki.setting.department.list', compact('departments'));
    }

    public function get($id)
    {
        $op = Department::findOrFail($id);
        return response()->json(['op' => $op]);
    }

    public function update(Request $request)
    {

        $rules = [
            'id' => ['required'],
            'name' => ['required'],
            'parent_id' => 'nullable',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Log::info($validator->errors());
            $error = true;
            // $message = 'Nationality not create.';
            $message = implode($validator->errors()->all());
        } else {
            $user_id = Auth::user()->id;
            $op = Department::findOrFail($request->id);

            $error = false;
            $message = 'Department created.';

            $op->name = $request->name;
            $op->parent_id = $request->parent_id;
            $op->save();
        }

        return response()->json(['error' => $error, 'message' => $message]);
    }

    public function list()
    {
        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";
        $op = Department::orderBy($sort, $order);

        if ($search) {
            $op = $op->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('id', 'like', '%' . $search . '%');
            });
        }
        $total = $op->count();
        $op = $op->paginate(request("limit"))->through(function ($op) {

        $op_parent = Department::find($op->parent_id);

            return  [
                'id' => $op->id,
                'name' => $op->name,
                'parent_id' =>$op_parent?->name,
                'total' => '<div class="align-middle white-space-wrap fw-bold fs-8">' . $op->employees->count() . '</div>',
                'created_at' => format_date($op->created_at,  'H:i:s'),
                'updated_at' => format_date($op->updated_at, 'H:i:s'),
            ];
        });

        return response()->json([
            "rows" => $op->items(),
            "total" => $total,
        ]);
    }

    public function store(Request $request)
    {
        //
        // dd($request);
        $user_id = Auth::user()->id;
        $department = new Department();

        $rules = [
            'name' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // Log::info($validator->errors());
            $error = true;
            // $message = 'Department could not be created';
            $message = implode($validator->errors()->all());

        } else {

            $error = false;
            $message = 'Department created succesfully.' . $department->id;

            $department->name = $request->name;
            $department->parent_id = $request->parent_id;
            $department->creator_id = $user_id;
            $department->active_flag = 1;

            $department->save();


        }

        $notification = array(
            'message'       => 'Department created successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);

    }

    public function delete($id)
    {
        $ws = Department::findOrFail($id);
        $ws->delete();

        $error = false;
        $message = 'Department deleted succesfully.';

        $notification = array(
            'message'       => 'Department deleted successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);
        // return redirect()->route('tracki.setup.workspace')->with($notification);
    } // delete

}
