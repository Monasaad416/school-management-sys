<?php

namespace App\Http\Controllers\Teachers\Dashboard;

use Exception;
use App\Models\Quiz;
use App\Models\Grade;
use App\Models\Level;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class TquizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public $auth_teacher_id;

    public function __construct(){
        $this->middleware(function ($request, $next) {
                $this->auth_teacher_id = Auth::guard('teacher')->user()->id; // returns user id
            return $next($request);
            });
        }
    public function index()
    {
        $quizzes = Quiz::where('teacher_id',$this->auth_teacher_id)->get();
        return view('pages.teachers.dashboard.quizzes.index',['quizzes'=>$quizzes]);
    }

    public function create()
    {
        $data['subjects'] = Subject::where('teacher_id',$this->auth_teacher_id)->get();
        $data['grades'] = Grade::all();
        return view('pages.teachers.dashboard.quizzes.create')->with($data);
    }

    public function store(Request $request)
    {
        try {
            $subject = Subject::where('teacher_id',$this->auth_teacher_id)->first();
            Quiz::create([
                'name' => [
                    'en' => $request->name_en,
                    'ar' => $request->name_ar
                ],
                'subject_id' => $subject->id,
                'teacher_id' => $this->auth_teacher_id ,
                'grade_id' => $request->grade_id,
                'level_id' => $request->level_id ,
                'section_id' => $request->section_id ,

            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->route('t_quizzes.index');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function edit($id)
    {
        $quiz = Quiz::findOrFail($id);

        $data['subject'] = Subject::where('teacher_id',$this->auth_teacher_id)->first();
        $data['grades'] = Grade::all();
        return view('pages.teachers.dashboard.quizzes.edit',['quiz'=>$quiz])->with($data);
    }
    public function update(Request $request)
    {
        try {
            $quiz = Quiz::findOrFail($request->id);

            $subject = Subject::where('teacher_id',$this->auth_teacher_id)->first();
            $quiz->update([
                'name' => [
                    'en' => $request->name_en,
                    'ar' => $request->name_ar
                ],
                'subject_id' => $subject->id,
                'teacher_id' => $this->auth_teacher_id ,
                'grade_id' => $request->grade_id,
                'level_id' => $request->level_id ,
                'section_id' => $request->section_id ,

            ]);
            toastr()->success(trans('messages.update'));
            return redirect()->route('t_quizzes.show',$quiz->id);
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $questions = Question::where('quiz_id',$id)->paginate(20);
        $quiz = Quiz::findOrFail($id);
        return view('pages.teachers.dashboard.questions.show_questions',['questions'=>$questions,'quiz'=>$quiz]);
    }

    public function destroy(Request $request)
    {
        $Quiz = Quiz::findOrFail($request->quiz_id)->delete();
        toastr()->error(trans('messages.delete'));
        return redirect()->route('t_quizzes.index');
    }



    public function t_getLevelsByGrade($id)
    {
        $list_levels = Level::where('grade_id',$id)->pluck('name','id');
        return response()->json($list_levels);
    }

    public function t_getSectionsByLevel($id)
    {
        $list_sections = Section::where('level_id',$id)->pluck('name','id');
         return response()->json($list_sections);
    }

    public function students_submit($quiz_id)
    {
        $sections_teacher =Teacher::findOrFail( Auth::guard('teacher')->user()->id)->sections()->pluck('section_id');
        $data['students_teacher'] = Student::whereIn('section_id',$sections_teacher)->get();
        $data['quiz']= Quiz::findOrFail($quiz_id);
        return view('pages.teachers.dashboard.quizzes.students_submit_quiz')->with($data);
    }
}
