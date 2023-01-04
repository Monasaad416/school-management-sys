<?php

namespace App\Http\Controllers\Teachers\Dashboard;

use Exception;
use Carbon\Carbon;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        $sections_teacher = Teacher::findOrFail( Auth::guard('teacher')->user()->id)->sections()->pluck('section_id');
        $data['students_teacher'] = Student::whereIn('section_id',$sections_teacher)->get();
        return view('pages.teachers.dashboard.attendance')->with($data);
    }




    public function attendance_report()
    {
        $sections_teacher = Teacher::findOrFail( Auth::guard('teacher')->user()->id)->sections()->pluck('section_id');
        $students_teacher = Student::whereIn('section_id',$sections_teacher)->get();
        return view('pages.teachers.dashboard.attendance_report',['students_teacher'=> $students_teacher]);
    }

    public function attendance_search(Request $request)
    {
        $sections_teacher = Teacher::findOrFail( Auth::guard('teacher')->user()->id)->sections()->pluck('section_id');
        $students_teacher = Student::whereIn('section_id',$sections_teacher)->get();

        if($request->student_id == 0){
            $students_teacher = Attendance::whereBetween('attendance_date',[$request->from,$request->to])->get();
            return view('pages.teachers.dashboard.attendance_search',['students_teacher'=>$students_teacher]);
        }
        else{
            $students_teacher = Attendance::whereBetween('attendance_date',[$request->from,$request->to])->where('student_id',$request->student_id)->get();
            return view('pages.teachers.dashboard.attendance_search',['students_teacher'=>$students_teacher]);
        }
    }

}
