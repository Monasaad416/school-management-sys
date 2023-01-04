<?php

namespace App\Http\Controllers\Teachers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OnlineClass;
use Illuminate\Support\Facades\Auth;
use App\Models\Grade;
use MacsiDigital\Zoom\Facades\Zoom;

class OnlineClassController extends Controller
{
    public function index()
    {
        $data['online_classes'] = OnlineClass::where('created_by',Auth::guard('teacher')->user()->email)->paginate(10);
        $data['teacher'] = Auth::guard('teacher')->user();
        return view('pages.teachers.dashboard.online_classes.index')->with($data);
    }

    public function create()
    {
        $grades = Grade::all();
        return view('pages.teachers.dashboard.online_classes.create',['grades'=>$grades]);
    }

    public function store(Request $request)
    {
        try {
            $user = Zoom::user()->first();
            $meeting = Zoom::meeting();
            $meeting ->make([
                'topic' => 'New meeting',
                'type' => 8,
                'start_time' => $request->start_time,
                'duration' =>$request->duration,
                'timezone' => config('zoom.timezone'),
              ]);

            $meeting->settings()->make([
                'join_before_host' => true,
                'approval_type' => 1,
                'registration_type' => 2,
                'mute_upon_entry' => true,
                'enforce_login' => false,
                'waiting_room' => false,
                'host_video' => false,
                'participants_video' =>false,
                'audio' => config('zoom.audio'),
                'auto_recording' => config('zoom.auto_recording'),
              ]);


            $meeting->recurrence()->make([
                'type' => 3,
                'repeat_interval' => 1,
                'end_times' => 1
            ]);
            $user->meetings()->save($meeting);


            OnlineClass::create([
                'grade_id' => $request->grade_id,
                'level_id' => $request->level_id,
                'section_id' => $request->section_id,
                'created_by' => Auth::guard('teacher')->user()->email,
                'meeting_id' => $meeting->id,
                'topic' => $request->topic,
                'start_at' => $request->start_time,
                'duration' => $meeting->duration,
                'password' => $meeting->password,
                'start_url' => $meeting->start_url,
                'join_url' => $meeting->join_url,
            ]);
                toastr()->success(trans('messages.success'));
                return redirect()->route('t_online_classes.index');
        }
        catch (Exception $e) {
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
    public function edit(Request $request)
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
