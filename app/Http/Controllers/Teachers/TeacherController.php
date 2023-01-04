<?php
namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeacherRequest;
use App\Models\Specialization;
use Illuminate\Http\Request;

use App\Repository\TeacherRepositoryInterface;


class TeacherController extends Controller
{

    protected $Teacher;

    public function __construct(TeacherRepositoryInterface $Teacher) {
        $this->Teacher = $Teacher;
    }
    public function index()
    {
        // $teachers = $this->Teacher->getAllTeachers()->dd();
        $teachers = $this->Teacher->getAllTeachers();
        return view('pages.teachers.teachers',['teachers'=>$teachers]);
    }

    public function create()
    {
        $specialization = $this->Teacher->getSpecializaions();
        $genders = $this->Teacher->getGenders();
        return view('pages.teachers.create',['specializations'=> $specialization,'genders'=>$genders]);
    }

    public function store(StoreTeacherRequest $request)
    {
        return $this->Teacher->storeTeacher($request);
    }


    public function edit($id)
    {
        $teacher = $this->Teacher->editTeacher($id);
        $specializations = $this->Teacher->getSpecializaions();
        $genders = $this->Teacher->getGenders();
        return view('pages.teachers.edit_teacher',['teacher'=>$teacher,'specializations'=> $specializations,'genders'=>$genders]);
    }

    public function update(Request $request)
    {
        return $this->Teacher->updateTeacher($request);
    }

    public function destroy(Request $request)
    {
        $this->Teacher->deleteTeacher($request);
    }
}
