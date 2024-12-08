<?php

namespace App\Http\Controllers\hr\Setting;

use App\Http\Controllers\Controller;

use App\Models\FunctionalArea;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class FunctionalAreaController extends Controller
{
    //
    public function index()
    {
        $funcareas = FunctionalArea::all();
        $venues = Venue::all();
        return view('hr.admin.setting.funcareas.list', compact('venues', 'funcareas'));
    }

    public function get($id)
    {
        $funcarea = FunctionalArea::findOrFail($id);
        return response()->json(['funcarea' => $funcarea]);
    }

    public function update(Request $request)
    {

        $rules = [
            'name' => 'required',
            'venue_id' => 'nullable',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Log::info($validator->errors());
            $error = true;
            $message = 'FunctionalArea could not be updated';
        } else {
        $funcarea = FunctionalArea::findOrFail($request->id);

            $error = false;
            $message = 'FunctionalArea updated succesfully.' . $funcarea->id;

            $funcarea->name = $request->name;
            $funcarea->venue_id = intval($request->venue_id);
            // $funcarea->active_flag = $request->active_flag;

            $funcarea->save();

        }
        // dd($funcarea);

        return response()->json(['error' => $error, 'message' => $message]);
    }

    public function list()
    {
        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";
        $op = FunctionalArea::orderBy($sort, $order);

        if ($search) {
            $op = $op->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('id', 'like', '%' . $search . '%');
            });
        }
        $total = $op->count();
        $op = $op->paginate(request("limit"))->through(function ($op) {

        // $location = Location::find($op->location_id);

            return  [
                'id' => $op->id,
                'name' => $op->name,
                'venue_id' => $op->venues?->name,
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
        $funcarea = new FunctionalArea();

        $rules = [
            'name' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Log::info($validator->errors());
            $error = true;
            $message = 'FunctionalArea could not be created';
        } else {

            $error = false;
            $message = 'FunctionalArea created succesfully.' . $funcarea->id;

            $funcarea->name = $request->name;
            $funcarea->venue_id = intval($request->venue_id);
            $funcarea->creator_id = $user_id;
            $funcarea->active_flag = 1;

            $funcarea->save();


        }

        $notification = array(
            'message'       => 'FunctionalArea created successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);

    }

    public function delete($id)
    {
        $ws = FunctionalArea::findOrFail($id);
        $ws->delete();

        $error = false;
        $message = 'FunctionalArea deleted succesfully.';

        $notification = array(
            'message'       => 'FunctionalArea deleted successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);
        // return redirect()->route('tracki.setup.workspace')->with($notification);
    } // delete

}
