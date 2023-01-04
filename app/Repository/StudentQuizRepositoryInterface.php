<?php
namespace App\Repository;

interface StudentQuizRepositoryInterface {
    public function index();
    public function show($quiz_id);
    public function create();
    public function store($request);
    public function edit();
    public function update($request);
    public function destroy($id);

}
?>
