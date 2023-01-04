<?php

namespace App\Http\Controllers\OnlineClass;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\OnlineClassRepositoryInterface;

class OnlineClassController extends Controller
{
    protected $OnlineClass;

    public function __construct(OnlineClassRepositoryInterface $OnlineClass) {
        $this->OnlineClass = $OnlineClass;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->OnlineClass->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return $this->OnlineClass->create();
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
        return $this->OnlineClass->show($id);
    }

    public function store(Request $request)
    {
        return $this->OnlineClass->store($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->OnlineClass->edit($id);
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
        return $this->OnlineClass->update($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $this->OnlineClass->destroy($request);
    }
}
