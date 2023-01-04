<?php
namespace App\Repository;

use Exception;
use Carbon\Carbon;
use App\Models\Grade;
use App\Models\OnlineClass;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\DB;
use MacsiDigital\Zoom\Facades\Zoom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class OnlineClassRepository implements OnlineClassRepositoryInterface {
    public function index()
    {
        $data['online_classes'] = OnlineClass::paginate(20);
        $data['admin'] = Auth('admin')->user()->name;
        return view('pages.online_classes.index')->with($data);
    }

    public function create()
    {
        $grades = Grade::all();
        return view('pages.online_classes.create',['grades'=>$grades]);
    }

    public function store($request)
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
                return redirect()->route('books.index');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }



    public function edit($id)
    {

    }
    public function update($request)
    {

    }

    public function destroy($request)
    {
        try {
            $meeting = Zoom::meeting()->find($request->id);
            $class = OnlineClass::where('meeting_id',$meeting->id)->delete();
            $meeting->delete();
            toastr()->error(trans('messages.delete'));
            return back();
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


}
?>
