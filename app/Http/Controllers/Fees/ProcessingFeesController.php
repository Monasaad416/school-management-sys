<?php

namespace App\Http\Controllers\Fees;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\ProcessingFeesRepositoryInterface;
use App\Http\Requests\StoreProcessingFeesRequest;

class ProcessingFeesController extends Controller
{

    protected $ProcessingFees;

    public function __construct(ProcessingFeesRepositoryInterface $ProcessingFees) {
        $this->ProcessingFees = $ProcessingFees;
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->ProcessingFees->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create($student_id)
    {
        return $this->ProcessingFees->create($student_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->ProcessingFees->show($id);
    }

    public function store(StoreProcessingFeesRequest $request)
    {
        return $this->ProcessingFees->store($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->ProcessingFees->edit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        return $this->ProcessingFees->update($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $this->ProcessingFees->destroy($request);
    }
}
