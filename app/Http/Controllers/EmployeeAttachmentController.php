<?php

namespace App\Http\Controllers;

use App\Models\EmployeeAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class EmployeeAttachmentController extends Controller
{
    //
    public function index()
    {
        return view('tracki.employee.files.list');
    }

    public function get($id)
    {
        $op = EmployeeAttachment::findOrFail($id);
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
            // $message = 'Relationship not create.';
            $message = implode($validator->errors()->all());
        } else {
            $user_id = Auth::user()->id;
            $op = EmployeeAttachment::findOrFail($request->id);

            $error = false;
            $message = 'Relationship updated.';

            $op->title = $request->title;
            $op->created_by = $user_id;
            $op->updated_by = $user_id;
            $op->save();
        }

        return response()->json(['error' => $error, 'message' => $message]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file_name' => 'required',
        ]);

        if ($validator->fails()) {
            $error = true;
            // $message = 'EmployeeEntity not create.';
            $message = implode($validator->errors()->all());

            return response()->json([
                'error' => true,
                'message' => $message,
                'user_name' => null,
                'note_text' => null,
                'note_date' => null,
                'id' => null
            ]);
        } else {
            $id = Auth::user()->id;
            // $task = Task::findOrFail($request->task_id);
            $data = new EmployeeAttachment();

            // dd($request->task_id);

            if ($request->file('file_name')) {
                $file = $request->file('file_name');
                $filename = rand() . date('ymdHis') . $file->getClientOriginalName();
                $file->move(public_path('storage/upload/event_files'), $filename);
                $data->file_name = $filename;
                $data->original_file_name = $file->getClientOriginalName();
                $data->file_extension = $file->getClientOriginalExtension();
                $data->file_size = $_FILES['file_name']['size']; //$request->file('file_name')->getSize();
                $data->file_path = '/storage/upload/event_files/';
                $data->user_id = $id;
                $data->employee_id = $request->employee_id;
            }

            $data->save();

            $notification = array(
                'message'       => 'File added successfully',
                'alert-type'    => 'success'
            );

            // return response()->json(['success'=>'You have successfully upload file.']);
            return response()->json([
                'error' => false,
                'message' => 'file added successfully',
                'user_name' => auth()->user()->username, //$data->users->username,
                'original_file_name' => $data->original_file_name,
                'task_file_id' => $data->id,
                'file_size' => $data->file_size,
                'created_at' => format_date($data->created_at,  'H:i:s'),
                'file_extension' => $data->file_extension,
                'file_name' => $data->file_name,
                'file_path' => $data->file_path,
            ]);
        }
        // return redirect()->back();
    } //fileStore


    public function list($id=null)
    {
        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";
        // $op = EmployeeAttachment::orderBy($sort, $order);

        Log::alert('list id: '.$id);
        if ($id) {
            $op = EmployeeAttachment::where('employee_id', $id)->orderBy($sort, $order);
        } else {
            $op = EmployeeAttachment::orderBy($sort, $order);
        }

        // dd($op);
        if ($search) {
            $op = $op->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        }
        $total = $op->count();

        $op = $op->paginate(request("limit"))->through(function ($op) {

            if ($op->file_path) {
                $image = ' <div class="avatar avatar-m ">
                                <a  href="#" role="button">
                                    <img class="rounded-circle pull-up" src="' . $op->file_path . $op->file_name . '" alt="" />
                                </a>
                            </div>';
            } else {
                $image = '  <div class="avatar avatar-m  me-1" id="project_team_members_init">
                                <a class="dropdown-toggle dropdown-caret-none d-inline-block" href="#" role="button">
                                    <div class="avatar avatar-m  rounded-circle pull-up">
                                        <div class="avatar-name rounded-circle me-2"><i class="fa-solid fa-file"></i></div>
                                    </div>
                                </a>
                            </div>';
            }

            $actions =
            '<a href="javascript:void(0)" class="btn btn-sm" data-table="employee_file_table" data-id="' .
            $op->id .
            '" id="delete_employee_file" data-bs-toggle="tooltip" data-bs-placement="right" title="Delete">' .
            '<i class="bx bx-trash text-danger"></i></a></div></div>';

            return [
                'id' => $op->id,
                'id1' => '<div class="ms-3">' . $op->id . '</div>',
                'image' => $image,
                'original_file_name' => '<div class="align-middle white-space-wrap fw-bold fs-8 ms-3"><a href="'.asset('/storage/upload/event_files/').'/'.$op->file_name.'" target="_blank"> ' . $op->original_file_name . '</a></div>',
                'file_size' => '<div class="align-middle white-space-wrap fw-bold fs-8 ms-3">' . $op->file_size . '</div>',
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

    public function delete($id)
    {
        $fileDetails = EmployeeAttachment::find($id);

        // dd($fileDetails);
        // Log::info('file to delete: ' . 'upload/event_files/' . $fileDetails->file_name);

        // $url = \File::allFiles(public_path('upload/event_files/'.$fileDetails->file_name));
        // dd($url);

        if (File::exists(public_path('storage/upload/event_files/' . $fileDetails->file_name))) {
            File::delete(public_path('storage/upload/event_files/' . $fileDetails->file_name));
        }

        EmployeeAttachment::where('id', '=', $id)->delete();

        $notification = array(
            'message'       => 'File deleted successfully',
            'alert-type'    => 'success'
        );

        // dd($taskId);

        return response()->json([
            'error' => false,
            'message' => 'file ' . $fileDetails->original_file_name . ' deleted successfully',
        ]);
        // Toastr::success('Has been add successfully :)','Success');
        // return Redirect::route('tracki.task.list', $task->event_id)->with($notification);
        // return redirect()->back()->with($notification);
    } // fileDelete
}
