<?php

namespace App\Http\Controllers\projectMgt\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\FunctionalArea;
use App\Models\Venue;
use Illuminate\Http\Request;

class FunctionalAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $funcareas = FunctionalArea::all();
        $venues = Venue::all();
        return view('hr.admin.setting.funcareas.list', compact('venues', 'funcareas'));
    }

}
