<?php
namespace App\Repository;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Level;
use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class StudentQuizRepository implements StudentQuizRepositoryInterface {
    public function index()
    {
        $data['quizzes'] = Quiz::where('grade_id',Auth::guard('student')->user()->grade_id)->
        where('level_id',Auth::guard('student')->user()->level_id)->
        where('section_id',Auth::guard('student')->user()->section_id)->
        orderBy('id','DESC')->
        get();
        $data['student'] = Auth::guard('student')->user();
        return view('pages.students.dashboard.quizzes')->with($data);
    }
    public function show($quiz_id)
    {
        try {
            $quiz_id = Quiz::findOrFail($quiz_id)->id;
            $student_id = Auth::guard('student')->user();
            $quiz_details = Question::where('quiz_id',$quiz_id)->get();
            return view('pages.students.dashboard.show_questions',['quiz_id'=>$quiz_id ,'quiz_details'=>$quiz_details]);
        }
        catch (Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function create()
    {
        // $grades = Grade::all();
        // return view('pages.fees.add',['grades'=>$grades]);
    }

    public function store($request)
    {
        try {
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
