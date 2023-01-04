<?php
namespace App\Repository;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Level;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Subject;

use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class SubjectRepository implements SubjectRepositoryInterface {
    public function index()
    {
        $data['subjects'] = Subject::paginate(20);
        return view('pages.subjects.index')->with($data);
    }
    public function show($id)
    {
        $data['studentsOfSection'] = Student::with('attendance')->where('section_id',$id)->get();
        return view('pages.attendance.show')->with($data);
    }

    public function create()
    {
        $data['grades'] = Grade::all();
        $data['levels'] = Level::all();
        $data['teachers'] = Teacher::all();
        return view('pages.subjects.create')->with($data);
    }

    public function store($request)
    {
        try {
                Subject::create([
                    'name' => [
                        'en' => $request->name_en,
                        'ar' => $request->name_ar
                    ],
                    'grade_id' => $request->grade_id,
                    'level_id' => $request->level_id,
                    'teacher_id' => $request->teacher_id,
        
                ]);
                toastr()->success(trans('messages.success'));
                return redirect()->route('subjects.index');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function edit($id)
    {
        $data['subject'] = Subject::findOrFail($id);
        $data['grades'] = Grade::all();
        $data['levels'] = Level::all();
        $data['teachers'] = Teacher::all();
        return view('pages.subjects.edit')->with($data);
    }
    public function update($request)
    {
        try {
            $subject = Subject::findOrFail($request->id);
            $subject->update([
                'name' => [
                    'en' => $request->name_en,
                    'ar' => $request->name_ar
                ],
                'grade_id' => $request->grade_id,
                'level_id' => $request->level_id,
                'teacher_id' => $request->teacher_id,
    
            ]);
            toastr()->success(trans('messages.update'));
            return redirect()->route('subjects.index');
    }
    catch (Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
    }

    public function destroy($request)
    {
        try {
            $subject = Subject::findOrFail($request->id)->delete();
              toastr()->error(trans('messages.delete'));
              return redirect()->route('subjects.index');
      }
      catch(Exception $e){
          return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }

    }
}
?>
