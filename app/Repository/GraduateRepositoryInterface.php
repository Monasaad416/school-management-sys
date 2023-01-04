<?php
namespace App\Repository;

interface GraduateRepositoryInterface {
    public function index();
    public function create();
    public function softDelete($request);
}
?>
