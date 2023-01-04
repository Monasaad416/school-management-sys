<?php

namespace App\Http\Controllers\Teachers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    public function index()
    {
        $sections_teacher = Teacher::findOrFail( Auth::guard('teacher')->user()->id)->sections()->get();
        return view('pages.teachers.dashboard.sections',['sections_teacher' => $sections_teacher]);
    }
}
