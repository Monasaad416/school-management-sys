<?php
namespace App\Repository;
use Illuminate\Http\Request;

interface StudentRepositoryInterface {
    public function get_levels($id);
    public function get_sections($id);
    public function get_all_students();
    public function create_student();
    public function store_student($request);
    public function edit_student($id);
    public function update_student($request);
    public function delete_student($request);
    public function show_student($id);
    public function upload_attachment($request);
    public function download_attachment($image_name);
}
?>
