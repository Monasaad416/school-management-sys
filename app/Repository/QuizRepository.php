<?php
namespace App\Repository;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Grade;
use App\Models\Level;
use App\Models\Section;

use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class QuizRepository implements QuizRepositoryInterface {
    public function index()
    {
        $data['quizzes'] = Quiz::paginate(20);
        return view('pages.quizzes.index')->with($data);
    }

    public function show($id)
    {

    }

    public function create()
    {
        $data['subjects'] = Subject::all();
        $data['teachers'] = Teacher::all(); 
        $data['grades'] = Grade::all();
        $data['levels'] = Level::all();
        $data['sections'] = Section::all();
        return view('pages.quizzes.create')->with($data);
    }

    public function store($request)
    {
        try {
            Quiz::create([
                'name' => [
                    'en' => $request->name_en,
                    'ar' => $request->name_ar
                ],
                'subject_id' => $request->subject_id ,
                'teacher_id' => $request->teacher_id ,
                'grade_id' => $request->grade_id, 
                'level_id' => $request->level_id ,
                'section_id' => $request->section_id ,

            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->route('quizzes.index');
        }
        catch (Exception $e) {
            // DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function edit($id)
    {
        $quiz = Quiz::findOrFail($id);
        
        $data['subjects'] = Subject::all();
        $data['teachers'] = Teacher::all(); 
        $data['grades'] = Grade::all();
        $data['levels'] = Level::all();
        $data['sections'] = Section::all();
        return view('pages.quizzes.edit',['quiz'=>$quiz])->with($data);
    }
    public function update($request)
    {
        try {
            $Quiz = Quiz::findOrFail($request->id);
            $Quiz->update([
                'name' => [
                    'en' => $request->name_en,
                    'ar' => $request->name_ar
                ],
                'subject_id' => $request->subject_id ,
                'teacher_id' => $request->teacher_id ,
                'grade_id' => $request->grade_id, 
                'level_id' => $request->level_id ,
                'section_id' => $request->section_id ,

            ]);
            toastr()->success(trans('messages.update'));
            return redirect()->route('quizzes.index');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        $Quiz = Quiz::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.delete'));
        return back();
    }
}
?>
