<?php
namespace App\Repository;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Level;
use App\Models\Section;
use App\Models\Student;
use App\Models\Promotion;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PromotRepository implements PromotRepositoryInterface {
    public function index()
    {
        $data['grades'] = Grade::all();
        $data['levels'] = Level::all();
        $data['sections'] = Section::all();
        return view('pages.students.promot_student')->with($data);
    }

    public function create()
    {
        $promotions = Promotion::all();
        return view("pages.students.promotions_management",['promotions'=>$promotions]);
    }
    public function store($request)
    {
        DB::beginTransaction();
        try {
            $students = student::where('grade_id',$request->grade_id)
                ->where('level_id',$request->level_id)
                ->where('section_id',$request->section_id)
                ->where('academic_year',$request->academic_year)
                ->get();

            if($students->count() < 1){
                return redirect()->back()->with('error_promotions', __('promot_trans.no_students'));
            }

            // update in table student
            foreach ($students as $student){
                $ids = explode(',',$student->id);
                Student::whereIn('id', $ids)
                    ->update([
                        'grade_id'=>$request->grade_id_new,
                        'level_id'=>$request->level_id_new,
                        'section_id'=>$request->section_id_new,
                        'academic_year'=>$request->academic_year_new,
                    ]);

                // insert in to promotions
                Promotion::updateOrCreate(
                    [
                        'student_id'=>$student->id,
                    ],
                    [
                    'from_grade'=>$request->grade_id,
                    'from_level'=>$request->level_id,
                    'from_section'=>$request->section_id,
                    'to_grade'=>$request->grade_id_new,
                    'to_level'=>$request->level_id_new,
                    'to_section'=>$request->section_id_new,
                    'academic_year'=>$request->academic_year,
                    'academic_year_new'=>$request->academic_year_new,
                ]);
            }

            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('students.index');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function demote_all($request)
    {

        // DB::beginTransaction();
        try {
            $promotions = Promotion::all();
            // update in student
            foreach ($promotions as $promot){
                $ids = explode(',' , $promot->student_id);
                Student::whereIn('id', $ids)->update(
                    [
                        'grade_id'=>$promot->from_grade,
                        'level_id'=>$promot->from_level,
                        'section_id'=>$promot->from_section,
                        'academic_year'=>$promot->academic_year,
                ]);

                 Promotion::truncate();


            // DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('students.index');
            }

        } catch (Exception $e) {
            // DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function demote_student($request)
    {
        try{
            $promotion = Promotion::findOrFail($request->promot_id);
            $student_id = $promotion->student_id;
            Student::where('id',$student_id)->update([
                'grade_id'=>$promotion->from_grade,
                'level_id'=>$promotion->from_level,
                'section_id'=>$promotion->from_section,
                'academic_year'=>$promotion->academic_year,
            ]);

            $promotion->delete();

            toastr()->error(trans('messages.delete'));
            return redirect()->route('promotions.create');
        } catch (Exception $e) {
            // DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}
?>
