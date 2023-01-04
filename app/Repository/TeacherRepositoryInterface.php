<?php
namespace App\Repository;

interface TeacherRepositoryInterface {
    public function getSpecializaions();
    public function getGenders();
    public function getAllTeachers();
    public function storeTeacher($request);
    public function editTeacher($id);
    public function updateTeacher($request);
    public function deleteTeacher($request);
}
?>
