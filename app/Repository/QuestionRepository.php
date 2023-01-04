<?php
namespace App\Repository;

use Exception;
use Carbon\Carbon;


use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Repository\QuestionRepositoryInterface;


class QuestionRepository implements QuestionRepositoryInterface {
    public function index()
    {
        $data['questions'] = Question::paginate(20);
        return view('pages.questions.index')->with($data);
    }

    public function show($id)
    {

    }

    public function create()
    {
        return view('pages.questions.create');
    }

    public function store($request)
    {
        try {
            Question::create([
                'title' => $request->title,
                'option_1' => $request->option_1 ,
                'option_2' => $request->option_2,
                'option_3' => $request->option_3 ,
                'option_4' => $request->option_4 ,
                'right_answer' => $request->right_answer ,
                'score' => $request->score,
                'quiz_id' => $request->quiz_id ,

            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->route('questions.index');
        }
        catch (Exception $e) {
            // DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function edit($id)
    {
        $question = Question::findOrFail($id);

        $data['subjects'] = Subject::all();
        $data['teachers'] = Teacher::all();
        $data['grades'] = Grade::all();
        $data['levels'] = Level::all();
        $data['sections'] = Section::all();
        return view('pages.questions.edit',['question'=>$question])->with($data);
    }
    public function update($request)
    {
        try {
            $question = Question::findOrFail($request->id);
            $question->update([

                'subject_id' => $request->subject_id ,
                'teacher_id' => $request->teacher_id ,
                'grade_id' => $request->grade_id,
                'level_id' => $request->level_id ,
                'section_id' => $request->section_id ,

            ]);
            toastr()->success(trans('messages.update'));
            return redirect()->route('questions.index');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        $question = Question::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.delete'));
        return back();
    }
}
?>
