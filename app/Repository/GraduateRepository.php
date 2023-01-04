<?php
namespace App\Repository;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Level;
use App\Models\Section;
use App\Models\Student;

use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class GraduateRepository implements GraduateRepositoryInterface {
    public function index()
    {
        $data['grades'] = Grade::all();
        $data['levels'] = Level::all();
        $data['sections'] = Section::all();
        $data['students'] = Student::all();
        return view('pages.students.graduation.index')->with($data);
    }

    public function create()
    {
        $grades = Grade::all();
        return view("pages.students.graduation.create",['grades'=>$grades]);
    }

    public function softDelete($request)
    {
        // DB::beginTransaction();
        try {
            $students = Student::where('grade_id',$request->grade_id)->where('level_id',$request->level_id)->where('section_id',$request->section_id)->get();
            if($students->count() < 1){
                return redirect()->back()->with('error_grad', __('promot_trans.no_students'));
            }

            foreach ($students as $student){
                $ids = explode(',' , $student->id);
                $del_students = Student::whereIn('id', $ids)->first();
                //problemmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm
                //problemmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm
                //problemmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm
                //problemmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm
                //problemmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm
                //problemmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm
                //problemmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm
                $del_students->delete();


                // DB::commit();
                toastr()->success(trans('messages.success'));
                return redirect()->route('graduation.index');
            }

        } catch (Exception $e) {
            // DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}
?>
