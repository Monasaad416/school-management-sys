<?php
namespace App\Repository;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Level;
use App\Models\Section;
use App\Models\Myparent;
use App\Models\Gender;
use App\Models\Nationality;
use App\Models\Blood;
use App\Models\Student;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentRepository implements StudentRepositoryInterface {
    public function create_student()
    {
        $data['grades'] = Grade::all();
        $data['levels'] = Level::all();
        $data['parents'] = Myparent::all();
        $data['genders'] = Gender::all();
        $data['nationalities'] = Nationality::all();
        $data['bloods'] = Blood::all();
        return view('pages.students.add_student')->with($data);
    }

    public function get_levels($id)
    {
        $list_levels = Level::where('grade_id',$id)->pluck('name','id');
        return response()->json($list_levels);
    }

    public function get_sections($id)
    {
        $list_sections = Section::where('level_id',$id)->pluck('name','id');
         return response()->json($list_sections);
    }
    public function get_all_students()
    {
       return Student::paginate(20);
    }
    public function index()
    {
        $students = $this->get_all_students();
        return view('pages.students.students',['students'=>$students]);
    }

    public function store_student($request)
    {
        //DB::beginTransaction();
        try {

            Student::create([
               'name' => [
                    'en' => $request->name_en,
                    'ar' => $request->name_ar
                ],
              'email' => $request->email,
              'password' => Hash::make($request->password),
              'gender_id' => $request->gender_id,
              'nationality_id' => $request->nationality_id,
              'blood_id' => $request->blood_id,
              'date_of_birth' => $request->date_of_birth,
              'grade_id' => $request->grade_id,
              'level_id' => $request->level_id,
              'section_id' => $request->section_id,
              'parent_id' => $request->parent_id,
              'academic_year' => $request->academic_year,
            ]);
            $student = Student::latest()->first();
            if($request->hasFile('images'))
            {
                foreach ($request->file('images') as $image) {
                    $path = Storage::putFile("attachments/students",$image);
                    Image::create([
                        'image_name' => $path,
                        'imageable_id' => $student->id,
                        'imageable_type' => 'App\Models\Student',
                    ]);
                }
            }

            //DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('students.index');
        }
         catch(Exception $e){
            //DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
     }
    }
    public function edit_student($id)
    {
        $data['grades'] = Grade::all();
        $data['levels'] = Level::all();
        $data['parents'] = Myparent::all();
        $data['genders'] = Gender::all();
        $data['nationalities'] = Nationality::all();
        $data['bloods'] = Blood::all();
        $data['student'] = Student::findOrFail($id);
        $data['students'] = Student::all();
        return view('pages.students.edit_student')->with($data);
    }
    public function update_student($request)
    {
        try {
            $student = Student::findOrFail($request->id);
            $student->update([
              'name' => [
                    'en' => $request->name_en,
                    'ar' => $request->name_ar
                ],
              'email' => $request->email,
              'gender_id' => $request->gender_id,
              'nationality_id' => $request->nationality_id,
              'blood_id' => $request->blood_id,
              'date_of_birth' => $request->date_of_birth,
              'grade_id' => $request->grade_id,
              'level_id' => $request->level_id,
              'section_id' => $request->section_id,
              'parent_id' => $request->parent_id,
              'academic_year' => $request->academic_year,
      ]);

      if($request->has('password')){
        $student->update([
            'password' => Hash::make($request->password),
        ]);
      }
          toastr()->success(trans('messages.update'));
          return redirect()->route('students.index');
      }
      catch(Exception $e){
          return redirect()->back()->withErrors(['error' => $e->getMessage()]);
     }

    }
    public function delete_student($request)
    {
        try {
            $student = Student::findOrFail($request->id)->delete();
              toastr()->error(trans('messages.delete'));
              return redirect()->route('students.index');
      }
      catch(Exception $e){
          return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }

    }

    public function show_student($id)
    {
        $student = Student::findOrFail($id);
        return view('pages.students.show',['student'=>$student]);
    }
    public function upload_attachment($request){
        foreach ($request->file('images') as $image) {
            $path = $image->getClientOriginalName();
            // $path = Storage::putFile("attachments/students",$image);
            Image::create([
                'image_name' => $path,
                'imageable_id' => $request->student_id,
                'imageable_type' => 'App\Models\Student',
            ]);

        }
        $id = $request->student_id;
        toastr()->success(trans('messages.success'));
        return redirect()->route('students.show',$id);
    }
    public function download_attachment($image_name)
    {
        return Storage::download($image_name);
    }
}
?>
