<?php

namespace App\Http\Controllers\Fees;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\InvoiceRepositoryInterface;
use App\Http\Requests\StoreInvoiceRequest;
use App\Models\Student;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $Invoice;

    public function __construct(InvoiceRepositoryInterface $Invoice) {
        $this->Invoice = $Invoice;
    }


    public function index()
    {
        return $this->Invoice->index();
    }
    public function getInvoices($student_id)
    {
        $student = Student::findOrFail($student_id);
        return $this->Invoice->getInvoices($student->id);
    }

    public function create($student_id)
    {
        return $this->Invoice->create($student_id);
    }

    public function show($student_id)
    {
        return $this->Invoice->show($student_id);
    }

    public function store(StoreInvoiceRequest $request)
    {
        return $this->Invoice->store($request);
    }

    public function edit($id)
    {
        return $this->Invoice->edit($id);
    }

    public function update(Request $request)
    {
        return $this->Invoice->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->Invoice->destroy($request);
    }
}
