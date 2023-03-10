<?php

namespace App\Http\Controllers\View;

use App\Models\Academic;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AcademicController extends Controller
{
    public function index()
    {
        $academics = Academic::all();
        return view('admin.academic.index2', compact('academics'));
    }
}
