<?php

namespace App\Http\Controllers\Teachers\Dashboard;

use Exception;
use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TquestionController extends Controller
{
    public function index()
    {
        //
    }

    //create new question using shoq to pass $is for quiz
    public function show($id)
    {
        $quiz = Quiz::findOrFail($id);
        return view('pages.teachers.dashboard.questions.create_question',['quiz'=> $quiz]);
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'nullable|string',
                'option_1' => 'nullable|string',
                'option_2' => 'nullable|string',
                'option_3' => 'nullable|string',
                'option_4' => 'nullable|string',
                'right_answer' => 'nullable|numeric|in:1,2,3,4',
                'score' => 'nullable|numeric',
                'quiz_id' => 'nullable|exists:quizzes,id',
            ]);
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
            return redirect()->route('t_quizzes.index');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);
        $quiz = Quiz::where('id',$question->quiz_id)->first();
        return view('pages.teachers.dashboard.questions.edit_question',['question'=>$question,'quiz'=> $quiz]);
    }

    public function update(Request $request)
    {
        try{
            $request->validate([
                'title' => 'required|string',
                'option_1' => 'required|string',
                'option_2' => 'required|string',
                'option_3' => 'required|string',
                'option_4' => 'required|string',
                'right_answer' => 'required|numeric|in:1,2,3,4',
                'score' => 'required|numeric',
                'quiz_id' => 'required|exists:quizzes,id',
            ]);

            $question = Question::findOrFail($request->question_id);
            $quiz = Quiz::where('id', $question->quiz_id)->first();


            $question->update([
                'title' => $request->title,
                'option_1' => $request->option_1 ,
                'option_2' => $request->option_2,
                'option_3' => $request->option_3 ,
                'option_4' => $request->option_4 ,
                'right_answer' => $request->right_answer ,
                'score' => $request->score,
                'quiz_id' => $request->quiz_id,

            ]);
            toastr()->success(trans('messages.update'));
            return redirect()->route('t_questions.show');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        //
    }
}
