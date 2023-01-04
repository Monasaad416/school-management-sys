<?php
namespace App\Repository;

interface FeesRepositoryInterface {
    public function index();
    public function create();
    public function store($request);
    public function edit();
    public function update($request);
    public function destroy($id);

}
?>
