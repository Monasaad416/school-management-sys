<?php

namespace App\Http\Controllers\Teachers\Dashboard;

use Exception;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use League\CommonMark\Node\Block\Document;

class ProfileController extends Controller
{
    public function index()
    {
        $teacher = Teacher::findOrFail(Auth::guard('teacher')->user()->id);
        return view('pages.teachers.dashboard.profile.index',['teacher'=>$teacher]);
    }


    public function update(Request $request,$id)
    {
        try{
            $teacher = Teacher::findOrFail($id);
            if(!empty($request->password)){
                $teacher->update([
                    'name' => [
                        'en' => $request->name_en,
                        'ar' => $request->name_ar
                        ],
                    'password' => Hash::make($request->password),

                ]);

            } else {
                $teacher->update([
                    'name' => [
                        'en' => $request->name_en,
                        'ar' => $request->name_ar
                        ],
                ]);
            }
            toastr()->success(trans('messages.update'));
            return redirect()->route('teacher_profile.index');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}

