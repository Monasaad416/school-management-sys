<?php
namespace App\Repository;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Specialization;
use App\Models\Gender;
use Exception;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements TeacherRepositoryInterface {
    public function getSpecializaions() {
        return Specialization::all();
    }
    public function getGenders(){
        return Gender::all();
    }
    public function getAllTeachers() {
        return Teacher::paginate(20);
    }

    public function storeTeacher($request)
    {
        try {
              Teacher::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'name' => [
                    'en' => $request->name_en,
                    'ar' => $request->name_ar
                ],
                'specialization_id' => $request->specialization_id,
                'gender_id' => $request->gender_id,
                'joinning_date' => $request->joinning_date,
                'address' => $request->address,
        ]);
            toastr()->success(trans('messages.success'));
            return redirect()->route('teachers.index');
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
       }

    }


    public function editTeacher($id)
    {
        return  Teacher::findOrFail($id);
    }



    public function updateTeacher($request)
    {
        try {
            $request->validate([
                'name_en' => 'nullable|string',
                'name_ar' => 'nullable|string',
                'email' => 'nullable|email',
                'password' =>'nullable|string|min:5|max:25',
                'specialization_id' => 'exists:specializations,id',
                'gender_id' => 'exists:genders,id',
                'joinning_date' => 'nullable|date',
                'address' => 'nullable',
            ]);
            
            $teacher = Teacher::findOrFail($request->id);
            $teacher->update([
              'email' => $request->email,
              'name' => [
                  'en' => $request->name_en,
                  'ar' => $request->name_ar
              ],
              'specialization_id' => $request->specialization_id,
              'gender_id' => $request->gender_id,
              'joinning_date' => $request->joinning_date,
              'address' => $request->address,
            ]);
            if($request->has('password')){
                $teacher->update([
                    'password' => Hash::make($request->password),
                ]);
            }
       
            toastr()->success(trans('messages.update'));
            return redirect()->route('teachers.index');
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function deleteTeacher($request)
    {
        try {
              $teacher = Teacher::findOrFail($request->id)->delete();
                toastr()->error(trans('messages.delete'));
                return redirect()->route('teachers.index');
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
?>
