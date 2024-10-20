<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class GenderController extends Controller
{
    //
    public function index()
    {
        return view('tracki.setting.gender.list');
    }

    public function get($id)
    {
        $op = Gender::findOrFail($id);
        return response()->json(['op' => $op]);
    }

    public function update(Request $request)
    {

        $rules = [
            'id' => ['required'],
            'title' => ['required'],
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Log::info($validator->errors());
            $error = true;
            // $message = 'Gender not create.';
            $message = implode($validator->errors()->all());
        } else {
            $user_id = Auth::user()->id;
            $op = Gender::findOrFail($request->id);

            $error = false;
            $message = 'Gender created.';

            $op->title = $request->title;
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
        $op = new Gender();

        $rules = [
            'title' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        // dd($validator);

        if ($validator->fails()) {
            // Log::info($validator->errors());
            $error = true;
            // $message = 'Gender could not be created';
            $message = implode($validator->errors()->all());
        } else {

            $error = false;
            $message = 'Gender created.';

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
        $op = Gender::orderBy($sort, $order);

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
        Gender::where('id', '=', $id)->delete();

        $notification = array(
            'message'       => 'File deleted successfully',
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
