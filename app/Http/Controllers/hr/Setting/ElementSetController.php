<?php

namespace App\Http\Controllers\hr\Setting;

use App\Http\Controllers\Controller;

use App\Models\ElementSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ElementSetController extends Controller
{
    //
    public function index()
    {
        $elementsets = ElementSet::all();
        return view('hr.admin.setting.elementset.list', compact('elementsets'));
    }

    public function list()
    {
        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";
        $op = ElementSet::orderBy($sort, $order);

        // dd($op);
        if ($search) {
            $op = $op->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        }
        $total = $op->count();

        $op = $op->paginate(request("limit"))->through(function ($op) {

            $actions =
            '<div class="font-sans-serif btn-reveal-trigger position-static">' .
            '<a href="javascript:void(0)" class="btn btn-sm" id="edit_elementset" data-action="update" data-type="edit" data-id=' .
            $op->id .
            ' data-table="elementset_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Update">' .
            '<i class="fa-solid fa-pen-to-square text-primary"></i></a>' .
            '<a href="'.route('hr.admin.setting.elementset.assignment').'" class="btn btn-sm" data-action="assign" data-type="edit" data-id=' .
            $op->id .
            ' data-table="elementset_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Assign">' .
            '<i class="fa-solid far fa-lightbulb text-warning"></i></a>' .
            '<a href="javascript:void(0)" class="btn btn-sm" data-table="elementset_table" data-id="' .
            $op->id .
            '" id="delete_elementset" data-bs-toggle="tooltip" data-bs-placement="right" title="Delete">' .
            '<i class="bx bx-trash text-danger"></i></a></div></div>';


            return [
                'id' => $op->id,
                'id1' => '<div class="ms-3">' . $op->id . '</div>',
                'title' => '<div class="align-middle white-space-wrap fw-bold fs-8 ms-3">' . $op->title . '</div>',
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


    public function get($id)
    {
        $op = ElementSet::findOrFail($id);
        return response()->json(['op' => $op]);
    }


    public function store(Request $request)
    {
        // dd('mainEvent');
        $user_id = Auth::user()->id;
        $op = new ElementSet();

        $rules = [
            'title' => 'required',
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
            $message = 'Element Set created.';

            $op->title = $request->title;

            $op->created_by = $user_id;
            $op->updated_by = $user_id;
            $op->save();
        }

        return response()->json(['error' => $error, 'message' => $message]);
    } // store

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
            $message = implode($validator->errors()->all());
        } else {
            $user_id = Auth::user()->id;
            $op = ElementSet::findOrFail($request->id);

            $error = false;
            $message = 'Element Set updated.';
            $op->title = $request->title;
            $op->created_by = $user_id;
            $op->updated_by = $user_id;
            $op->save();
        }

        return response()->json(['error' => $error, 'message' => $message]);
    }

    public function delete($id)
    {
        ElementSet::where('id', '=', $id)->delete();

        $notification = array(
            'message'       => 'Element Set successfully',
            'alert-type'    => 'success'
        );

        // dd($taskId);

        return response()->json([
            'error' => false,
            'message' => 'Element Set deleted successfully',
        ]);

        // Toastr::success('Has been add successfully :)','Success');
        // return Redirect::route('hr.admin.task.list', $task->event_id)->with($notification);
        // return redirect()->back()->with($notification);
    } // taskFileDelete

    public function AssignElements(){
        return view('hr.admin.setting.elementset.assignment');
    }
}
