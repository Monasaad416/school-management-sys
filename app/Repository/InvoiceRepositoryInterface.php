<?php
namespace App\Repository;

interface InvoiceRepositoryInterface {
    public function index();
    public function getInvoices($student_id);
    public function show($student_id);
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request);
    public function destroy($request);
}
?>
