<?php

namespace App\Http\Controllers;

use App\Models\Element;
use App\Models\ElementClassification;
use App\Models\InputType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ElementController extends Controller
{
    //
    public function index()
    {
        $element_classifications = ElementClassification::all();
        $input_types = InputType::all();
        return view('tracki.setting.element.list', compact('element_classifications', 'input_types'));
    }

    public function get($id)
    {
        $op = Element::findOrFail($id);
        return response()->json(['op' => $op]);
    }

    public function update(Request $request)
    {

        $rules = [
            'id' => ['required'],
            'title' => ['required'],
            'element_classification_id' => ['required'],
            'input_type_id' => ['required'],
        ];


        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Log::info($validator->errors());
            $error = true;
            // $message = 'Element not create.';
            $message = implode($validator->errors()->all());
        } else {
            $user_id = Auth::user()->id;
            $op = Element::findOrFail($request->id);

            $error = false;
            $message = 'Element updated.';

            $op->title = $request->title;
            $op->element_classification_id = $request->element_classification_id;
            $op->input_type_id = $request->input_type_id;
            $op->input_value = $request->input_value;
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
        $op = new Element();

        $rules = [
            'title' => 'required',
            'element_classification_id' => ['required'],
            'input_type_id' => ['required'],
        ];

        $validator = Validator::make($request->all(), $rules);

        // dd($validator);

        if ($validator->fails()) {
            // Log::info($validator->errors());
            $error = true;
            // $message = 'Element could not be created';
            $message = implode($validator->errors()->all());
        } else {

            $error = false;
            $message = 'Element created.';

            $op->title = $request->title;
            $op->element_classification_id = $request->element_classification_id;
            $op->input_type_id = $request->input_type_id;
            $op->input_value = $request->input_value;
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
        $op = Element::orderBy($sort, $order);

        // dd($op);
        if ($search) {
            $op = $op->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        }
        $total = $op->count();

        $op = $op->paginate(request("limit"))->through(function ($op) {

            return [
                'id' => $op->id,
                'id1' => '<div class="ms-3">' . $op->id . '</div>',
                'title' => '<div class="align-middle white-space-wrap fw-bold fs-8 ms-3">' . $op->title . '</div>',
                'classification' => '<div class="align-middle white-space-wrap fw-bold fs-8 ms-3">' . $op->element_classificaitons->title . '</div>',
                'input_type' => '<div class="align-middle white-space-wrap fw-bold fs-8 ms-3">' . $op->input_types->title . '</div>',
                'input_value' => '<div class="align-middle white-space-wrap fw-bold fs-8 ms-3">' . $op->input_value . '</div>',
                // 'total' => '<div class="align-middle white-space-wrap fw-bold fs-8">' . $op->employees->count() . '</div>',
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
        Element::where('id', '=', $id)->delete();

        $notification = array(
            'message'       => 'Element successfully',
            'alert-type'    => 'success'
        );

        // dd($taskId);

        return response()->json([
            'error' => false,
            'message' => 'Element deleted successfully',
        ]);

        // Toastr::success('Has been add successfully :)','Success');
        // return Redirect::route('tracki.task.list', $task->event_id)->with($notification);
        // return redirect()->back()->with($notification);
    } // taskFileDelete
}
