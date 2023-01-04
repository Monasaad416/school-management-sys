<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gender;
use App\Models\Admin;
use Exception;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['admins'] = Admin::all();
        return view('pages.admins.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['genders'] = Gender::all();
        return view('pages.admins.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // $request->validate(([
            //     'email' => 'required|email|max:255',
            //     'password' =>'required|string|min:5|max:25|confirmed',
            //     'name_en' => 'required|string',
            //     'name_ar' => 'required|string',
            //     'gender_id' => 'required|exists:genders,id',


            // ]));
            Admin::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'name' => [
                    'en' => $request->name_en,
                    'ar' => $request->name_ar,
                 ],
                'gender_id' => $request->gender_id,

                'joinning_date'=> $request->joinning_date,
                'address' => $request->address,
             ]);
            toastr()->success(trans('messages.success'));
            return redirect()->route('admins.index');
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
       }
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
        $data['admin'] = Admin::findOrFail($id);
        $data['genders'] = Gender::all();
        return view('pages.admins.edit')->with($data);
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
        try {
            $admin = Admin::findOrFail($request->admin_id);
            return $request->all();

            if(!empty($request->password)){
                $admin->update([
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'name' => [
                        'en' => $request->name_en,
                        'ar' => $request->name_ar,
                     ],
                    'gender_id' => $request->gender_id,

                    'joinning_date'=> $request->joinning_date,
                    'address' => $request->address,

                 ]);

            } else {
                $admin->update([
                    'email' => $request->email,
                    'name' => [
                        'en' => $request->name_en,
                        'ar' => $request->name_ar,
                     ],
                    'gender_id' => $request->gender_id,

                    'joinning_date'=> $request->joinning_date,
                    'address' => $request->address,

                 ]);
            }


            toastr()->success(trans('messages.success'));
            return redirect()->route('admins.index');
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
       }
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
