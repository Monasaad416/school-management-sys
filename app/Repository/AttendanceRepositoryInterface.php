<?php
namespace App\Repository;

interface AttendanceRepositoryInterface {
    public function index();
    public function show($id);
    public function create();
    public function store($request);
    public function edit();
    public function update($request);
    public function destroy($id);

}
?>
