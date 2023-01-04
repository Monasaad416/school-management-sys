<?php
namespace App\Repository;

interface PromotRepositoryInterface {
    public function index();
    public function create();
    public function store($request);
    public function demote_all($request);
    public function demote_student($request);
}
?>
