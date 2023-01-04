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

class StudentController extends Controller
{
    public function index()
    {
        $sections_teacher =Teacher::findOrFail( Auth::guard('teacher')->user()->id)->sections()->pluck('section_id');
        $data['students_teacher'] = Student::whereIn('section_id',$sections_teacher)->get();
        $data['teacher_id'] = Auth::guard('teacher')->user()->id;
        return view('pages.teachers.dashboard.students')->with($data);
    }



    public function store(Request $request)
    {
        // return $request;
        try {

            foreach ($request->attendances as $stud_id => $attendance) {
                if($attendance == 'present') {
                    $status = true ;
                } elseif ($attendance == 'absent'){
                    $status = false ;
                }

                Attendance::create([
                    'student_id' => $stud_id ,
                    'grade_id' => $request->grade_id,
                    'level_id' => $request->level_id,
                    'section_id' => $request->section_id,
                    'teacher_id' => $request->teacher_id,
                    'attendance_date' => Carbon::now()->toDateTimeString(),
                    'attendance_status' => $status ,

                ]);
            }
                toastr()->success(trans('messages.success'));
                return redirect()->route('t_students');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function edit($id)
    {
        $stud = Student::findOrFail($id);
        return view('pages.teachers.dashboard.edit_attendance',['stud' => $stud]);
    }



    public function update(Request $request)
    {

        $date_of_today = date('Y-m-d');
        $stud_attendance = Attendance::where('attendance_date', $date_of_today)->where('student_id',$request->student_id)->first();
        try {

            if($request->attendance == 'present') {

                $stud_attendance->attendance_status = 1;
                $stud_attendance->save();
            } else if($request->attendance == 'absent'){
                $stud_attendance->attendance_status = 0;
                $stud_attendance->save();
            }

            toastr()->success(trans('messages.update'));
            return redirect()->route('t_students');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
