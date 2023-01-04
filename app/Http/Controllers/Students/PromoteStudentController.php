<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Repository\PromotRepository;
use App\Repository\PromotRepositoryInterface;
use Illuminate\Http\Request;

class PromoteStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected PromotRepositoryInterface $PromotStudent;

    public function __construct(PromotRepositoryInterface $PromotStudent) {
        $this->PromotStudent = $PromotStudent;
    }
    public function index()
    {
        return $this->PromotStudent->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->PromotStudent->create();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->PromotStudent->store($request);
    }

    public function demote_all(Request $request){
        return $this->PromotStudent->demote_all($request);
    }

    public function demote_student(Request $id){
        return $this->PromotStudent->demote_student($id);
    }
        public function graduate()
    {
        return("graduate");
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */




    public function destroy($id)
    {
        //
    }
}
