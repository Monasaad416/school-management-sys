<?php
namespace App\Repository;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Level;
use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Attendance;

use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class AttendanceRepository implements AttendanceRepositoryInterface {
    public function index()
    {
        $data['gradesWithSections'] = Grade::with(['sections'])->get();
        $data['grades'] = Grade::all();
        $data['levels'] = Level::all();
        $data['sections'] = Section::all();
        $data['teachers'] = Teacher::all();
        return view('pages.attendance.index')->with($data);
    }
    public function show($id)
    {
        $data['studentsOfSection'] = Student::with('attendance')->where('section_id',$id)->get();
        return view('pages.attendance.show')->with($data);
    }

    public function create()
    {
        // $grades = Grade::all();
        // return view('pages.fees.add',['grades'=>$grades]);
    }

    public function store($request)
    {
        try {
            foreach ($request->attendances as $stud_id => $attendance) {
                if($attendance == 'present') {
                    $status = true ;
                } else {
                    $status = false ;
                }

                Attendance::create([
                    'student_id' => $stud_id ,
                    'grade_id' => $request->grade_id,
                    'level_id' => $request->level_id,
                    'section_id' => $request->section_id,
                    'teacher_id' => 1 ,
                    'attendance_date' => Carbon::now()->toDateTimeString(),
                    'attendance_status' => $status ,

                ]);
            }
                toastr()->success(trans('messages.success'));
                return redirect()->route('attendance.show');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }



    public function edit()
    {

    }
    public function update($request)
    {

    }

    public function destroy($id)
    {

    }
}
?>
