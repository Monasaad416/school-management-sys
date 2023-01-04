<?php

namespace App\Http\Livewire;
use Exception;
use Carbon\Carbon;
use App\Models\Quiz;
use Livewire\Component;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class ShowQuestion extends Component
{
    public $quiz_id,
           $student,
           $quiz_details,
           $answers = [];


    public function render()
    {

        //get all questions of exam using quiz_id
        $quiz_details = Question::where('quiz_id',$this->quiz_id)->get();
        $quiz = Quiz::findOrFail($this->quiz_id);
        $student = Auth::guard('student')->user();
        return view('livewire.show-question',['quiz_details'=>$quiz_details,'quiz_id'=>$quiz->id,'student'=> $student]);
    }


    // public function show($id)
    // {
    //     $data['quiz'] = Quiz::findOrFail($id);
    //     $user = Auth::guard('student')->user();
    //     $data['canViewStartBtn'] = true;


    //     //check if user already authenticated(logged in)
    //     if($user !== null){
    //         $pivotRow = $user->quizzes()->where('quiz_id', $id)->first();

    //         // dd($pivotRow->pivot->status);
    //         //if user already solve quiz or status = closed
    //         if ($pivotRow !== null and $pivotRow->pivot->status == 0) {
    //             $data['canViewStartBtn'] = false;
    //         }
    //     }

    //     return view ('pages.students.dashboard.show_start_quiz')->with($data);
    // }


    // public function start($quiz_id)
    // {
    //     $user = Auth::guard('student')->user();
    //     if(! $user->quizzes()->contains($quiz_id)){
    //         $user->quizzes()->attach($quiz_id);
    //     } else {
    //         $user->quizzes()->updateExistingPivot($quiz_id,[
    //             'status' => 0 ,
    //         ]);
    //     }

    //     //save page as prev page in session
    //     $request->session()->flash('prev',"start/$quiz_id");
    //     return redirect( route("/exams/questions/$qui") );
    // }


    public function submitQuiz($quiz_id){
        try{
            $quiz_id = Quiz::findOrFail($this->quiz_id)->id;
            $points = 0;
            $score = 0;
            foreach ($this->quiz_details as $ques) {
                // array_push($this->inputs , $this->answers);
                $score += (int)$ques->score;
                if (isset($this->answers)){
                    $userAns = $this->answers[$ques->id];
                    // return dd(strVal($ques->right_answer));
                    if(strVal($ques->right_answer) === $userAns){
                        $points += (int)$ques->score;
                    }
                }
            }
            $percentage = ($points / $score) * 100;

            $student = Auth::guard('student')->user();
            if(! $student->quizzes->contains($quiz_id)){
                $student->quizzes()->attach($quiz_id);
            } else {
                $student->quizzes()->updateExistingPivot($quiz_id,[
                    'status' => "0",
                ]);
            }

            $pivotRow = $student->quizzes()->where('quiz_id', $quiz_id)->first();
            $startTime = $pivotRow->pivot->created_at;
            $submitTime = Carbon::now();
            $timeMins = $submitTime->diffInMinutes($startTime);

            //update pivot row
            $student->quizzes()->updateExistingPivot($quiz_id, [
                'result'=>$score,
                'time_mins'=>$timeMins
            ]);
            toastr()->success("you finished exam successfully with score = $score%");
            return redirect()->route('s_quizzes.index');
        }
        catch(Exception $e){
            session()->flash("error", "IProblem occured while adding information");
        }
    }
}
