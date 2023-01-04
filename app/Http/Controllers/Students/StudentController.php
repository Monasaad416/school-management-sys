<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreStudentRequest;

use App\Repository\StudentRepositoryInterface;

class StudentController extends Controller
{

    protected StudentRepositoryInterface $Student;

    public function __construct(StudentRepositoryInterface $Student) {
        $this->Student = $Student;
    }

    public function index()
    {
        return $this->Student->index();
    }

    public function create()
    {
        return $this->Student->create_student();
    }

    public function store(StoreStudentRequest $request)
    {
        $this->Student->store_student($request);
    }

    public function show($id)
    {
        return $this->Student->show_student($id);
    }
    public function edit($id)
    {
        return $this->Student->edit_student($id);
    }


    public function update(Request $request)
    {
        return $this->Student->update_student($request);
    }

    public function destroy(Request $request)
    {
        return $this->Student->delete_student($request);
    }

    public function getLevelsByGrade($id)
    {
        return $this->Student->get_levels($id);
    }

    public function getSectionsByLevel($id)
    {
        return $this->Student->get_sections($id);
    }


    public function upload_attachment(Request $request)
    {
        return $this->Student->upload_attachment($request);
    }
    public function download_attachment($image_name)
    {
        return $this->Student->download_attachment($image_name);
    }
    
}
