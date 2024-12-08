<?php

namespace App\Http\Controllers\hr\Admin;

use App\Http\Controllers\Controller;

use App\Models\EmployeeLetter;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class EmployeeLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */

    public function index()
    {

        //
        // dd($id);
        $letters = EmployeeLetter::all();
        return view('hr.admin.letter.list');
    }

    public function create()
    {
        //
        return view('hr.admin.letter.create');
    }

    /**
     * add a new resource.
     */
    public function add()
    {
        //
    }

    public function list()
    {
        $user = User::findOrFail(auth()->user()->id);

        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";

        // $employees = Employee::whereHas('timesheets', function ($q) {
        //     $q->where('status_id', 11);
        // })
        //     ->with('salaries')
        //     ->orderBy($sort, $order);

        // $employees = (new Employee)->newQuery()
        //     ->whereHas('timesheets', function ($query)  {
        //         $query->where('status_id', 11);
        //     })
        //     ->with('salaries')
        //     ->orderBy($sort, $order);

        $op = EmployeeLetter::orderBy($sort, $order);;

        $period = (request()->period) ? request()->period : "";

        if ($search) {
            $op = $op->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
            });
        }

        $total = $op->count();

        $op = $op->paginate(request("limit"))->through(function ($op) use ($user) {

            $div_action = '<div class="font-sans-serif btn-reveal-trigger position-static">';
            $profile_action =
                '<a href="' . route("hr.admin.letter.show", encrypt($op->id)) . '" target="_blank" class="btn-table btn-sm" title="View Template">' .
                '<i class="fa-solid far fa-lightbulb text-warning"></i></a>';
            $update_action =
                '<a href="' . route("hr.admin.letter.edit", encrypt($op->id)) . '" target="_blank" class="btn btn-sm" title="Edit template">' .
                '<i class="fa-solid fa-pen-to-square text-primary"></i></a>';
            $duplicate_action =
                '<a href="javascript:void(0)" class="btn btn-sm" id="duplicate_template" data-id=' .
                $op->id .
                ' data-table="employee_letter_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Duplicate">' .
                '<i class="fa-solid fa-copy text-success"></i></a>';
            $delete_action =
                '<a href="javascript:void(0)" class="btn btn-sm" data-table="employee_letter_table" data-id="' .
                $op->id .
                '" id="delete_template" data-bs-toggle="tooltip" data-bs-placement="right" title="Delete">' .
                '<i class="fa-solid fa-trash text-danger"></i></a></div></div>';
            $restore_action =
                '<a href="javascript:void(0)" class="btn btn-sm" data-table="employee_letter_table" data-id="' .
                $op->id .
                '" id="restoreEmployee" data-bs-toggle="tooltip" data-bs-placement="right" title="Restore">' .
                '<i class="fa-solid fa-rotate-left test-warning"></i></a></div></div>';

            $actions = $div_action . $profile_action . $update_action . $delete_action;

            return [
                'id1' => '<div class="ms-3">' . $op->id . '</div>',
                'id' => $op->id,
                'title' => '<div class="align-middle white-space-wrap fw-bold fs-9 ms-3">' . $op->title . '</div>',
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
        $letter = EmployeeLetter::find(decrypt($id));
        // $view = view(
        //     'hr.admin.letter.mv.show',
        //     compact('letter')
        // )->render();

        // return response()->json(['view' => $view]);
        return view(
                'hr.admin.letter.show',
                compact('letter')
            );
    }

    public function pdf($id)
    {


        $letter = EmployeeLetter::find($id);

        // dd($letter);
        $pdf = Pdf::loadView('showpdf', compact('letter'));
        // return $pdf->download('test.pdf');
        return $pdf->stream();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $letter = EmployeeLetter::find(decrypt($id));
        return view('hr.admin.letter.edit', compact('letter'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $id = Auth::user()->id;
        $op = new EmployeeLetter();


        // $emp = new Employee();
        // $data = new employeeAddress();

        $rules = [
            'title' => 'required',
            'content' => 'required',
            // 'leave_type_id' => 'required',
            // 'leave_file_name' => 'mimes:pdf|max:1024',
        ];

        $validator = Validator::make($request->all(), $rules);

        // dd($validator);

        // Log::info($request->all());

        if ($validator->fails()) {
            // Log::info($validator->errors());
            $error = true;
            $message = implode($validator->errors()->all('<div>:message</div>'));
        } else {
            $error = false;
            $message = 'Letter created successfuly.' . $op->id;

            // $op->user_id = $id;
            // $op->employee_id = $request->employee_id;
            $op->title = $request->title;
            $op->content = $request->content;

            $op->save();

            // dd($op->number);
        }

        return response()->json(['error' => $error, 'message' => $message]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        // Log::alert('EmployeeController::update');
        $id = Auth::user()->id;
        $op = EmployeeLetter::find(decrypt($request->id));

        $rules = [
            // 'employee_id' => 'required',
            'title' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // Log::info($validator->errors());
            $alerttype = 'error';
            $message = 'Template could not be created.' . $op->id;
        } else {
            $alerttype = 'success';
            $message = 'Template created successfuly.' . $op->id;

            $op->title = $request->title;
            $op->content = $request->content;

            $op->save();
        }

        $notification = array(
            'message' => $message,
            'alert-type' => $alerttype
        );
        // Log::info($request->all());

        return redirect()->route('hr.admin.letter')->with($notification);
        // return response()->json(['error' => $error, 'message' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        //
        EmployeeLetter::where('id', '=', $id)->delete();

        $notification = array(
            'message'       => 'Template deleted successfully',
            'alert-type'    => 'success'
        );

        // dd($taskId);

        return response()->json([
            'error' => false,
            'message' => 'Template deleted successfully',
        ]);
    }

}
