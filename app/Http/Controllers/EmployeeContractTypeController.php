<?php

namespace App\Http\Controllers;

use App\Models\EmployeeContractType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class EmployeeContractTypeController extends Controller
{
    //
    public function index()
    {
        return view('tracki.setting.contract_type.list');
    }

    public function get($id)
    {
        $op = EmployeeContractType::findOrFail($id);
        return response()->json(['op' => $op]);
    }

    public function update(Request $request)
    {

        $rules = [
            'id' => ['required'],
            'title' => ['required'],
            'active_flag' => ['required']
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Log::info($validator->errors());
            $error = true;
            $message = 'contract type not create.';
        } else {
            $user_id = Auth::user()->id;
            $op = EmployeeContractType::findOrFail($request->id);

            $error = false;
            $message = 'contract type created.';

            $op->title = $request->title;
            $op->active_flag = $request->active_flag;
            $op->created_by = $user_id;
            $op->updated_by = $user_id;
            $op->save();
        }

        return response()->json(['error' => $error, 'message' => $message]);
    }

    public function store(Request $request)
    {
        // dd('mainEvent');
        $user_id = Auth::user()->id;
        $op = new EmployeeContractType();

        $rules = [
            'title' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        // dd($validator);

        if ($validator->fails()) {
            // Log::info($validator->errors());
            $error = true;
            $message = 'contract type could not be created';
        } else {

            $error = false;
            $message = 'contract type created.';

            $op->title = $request->title;
            $op->active_flag = "1";
            $op->created_by = $user_id;
            $op->updated_by = $user_id;
            $op->save();
        }

        return response()->json(['error' => $error, 'message' => $message]);
    } // store


    public function list()
    {
        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";
        $op = EmployeeContractType::orderBy($sort, $order);

        // dd($op);
        if ($search) {
            $op = $op->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        }
        $total = $op->count();

        $op = $op->paginate(request("limit"))->through(function ($op) {

            $badge_color = 'success';
            $active_flag = 'Active';

            if ($op->active_flag === 1) {
                $badge_color = 'success';
                $active_flag = 'Active';
            } else {
                $badge_color = 'warning';
                $active_flag = 'InActive';
            }
            return [
                'id' => $op->id,
                'id1' => '<div class="ms-3">' . $op->id . '</div>',
                'title' => '<div class="align-middle white-space-wrap fw-bold fs-8 ms-3">' . $op->title . '</div>',
                'active_flag' => '<span class="badge badge-phoenix badge-phoenix-' . $badge_color . '">' . $active_flag . '</span>',
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

    public function delete($id)
    {
        EmployeeContractType::where('id', '=', $id)->delete();

        $notification = array(
            'message'       => 'contract type deleted successfully',
            'alert-type'    => 'success'
        );

        // dd($taskId);

        return response()->json([
            'error' => false,
            'message' => 'contract type deleted successfully',
        ]);

        // Toastr::success('Has been add successfully :)','Success');
        // return Redirect::route('tracki.task.list', $task->event_id)->with($notification);
        // return redirect()->back()->with($notification);
    } // taskFileDelete
}
