<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Support\Facades\Redirect;

class VenueController extends Controller
{
    //
    public function index()
    {
        $venues = Venue::all();
        $locations = Location::all();
        return view('tracki.setup.venue.list', compact('locations', 'venues'));
    }

    public function get($id)
    {
        $venue = Venue::findOrFail($id);
        return response()->json(['venue' => $venue]);
    }

    public function update(Request $request)
    {
        $formFields = $request->validate([
            'id' => ['required'],
            'name' => ['required'],
            'location_id' => 'nullable',
        ]);

        $venue = Venue::findOrFail($request->id);

        // dd($venue);

        if ($venue->update($formFields)) {
            return response()->json(['error' => false, 'message' => 'Venue updated successfully.', 'id' => $venue->id]);
        } else {
            return response()->json(['error' => true, 'message' => 'Venue couldn\'t updated.']);
        }
    }

    public function list()
    {
        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";
        $venue = Venue::orderBy($sort, $order);

        if ($search) {
            $venue = $venue->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('id', 'like', '%' . $search . '%');
            });
        }
        $total = $venue->count();
        $venue = $venue->paginate(request("limit"))->through(function ($venue) {

        // $location = Location::find($venue->location_id);

            return  [
                'id' => $venue->id,
                'name' => '<div class="align-middle white-space-wrap fw-bold fs-8">' . $venue->name . '</div>',
                'location_id' => '<div class="align-middle white-space-wrap fw-bold fs-8">' . $venue->locations?->name . '</div>',
                'created_at' => format_date($venue->created_at,  'H:i:s'),
                'updated_at' => format_date($venue->updated_at, 'H:i:s'),
            ];
        });

        return response()->json([
            "rows" => $venue->items(),
            "total" => $total,
        ]);
    }

    public function store(Request $request)
    {
        //
        // dd($request);
        $user_id = Auth::user()->id;
        $venue = new Venue();

        $rules = [
            'name' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Log::info($validator->errors());
            $error = true;
            $message = 'Venue could not be created';
        } else {

            $error = false;
            $message = 'Venue created succesfully.' . $venue->id;

            $venue->name = $request->name;
            $venue->location_id = $request->location_id;
            $venue->creator_id = $user_id;
            $venue->active_flag = 1;

            $venue->save();


        }

        $notification = array(
            'message'       => 'Venue created successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);

    }

    public function delete($id)
    {
        $ws = Venue::findOrFail($id);
        $ws->delete();

        $error = false;
        $message = 'Venue deleted succesfully.';

        $notification = array(
            'message'       => 'Venue deleted successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);
        // return redirect()->route('tracki.setup.workspace')->with($notification);
    } // delete

}
