<?php

namespace App\Http\Controllers\projectMgt\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $departments = Department::all();
        return view('hr.admin.setting.department.list', compact('departments'));
    }

}
