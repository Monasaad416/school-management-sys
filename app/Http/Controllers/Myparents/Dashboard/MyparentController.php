<?php

namespace App\Http\Controllers\Myparents\Dashboard;

use Exception;
use App\Models\Invoice;
use App\Models\Student;
use App\Models\Myparent;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\ReceiptStudent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MyparentController extends Controller
{
    public function getStudents($parent)
    {
        $parents = student::all();
        $sons = $parents->where('parent_id',$parent->id)->all();
        return $sons;
    }
    public function index()
    {
        $parent= Auth::guard('myparent')->user();

        return view('pages.myparents.dashboard.sons',['parent'=>$parent,'sons'=>$this->getStudents($parent)]);
    }

    public function results($id)
    {
        $parent = Student::findOrFail($id);
        if($parent->parent_id == Auth::guard('myparent')->user()->id){
            $data['results'] = $parent->quizzes;
            return view('pages.myparents.dashboard.results',['student'=>$parent])->with($data);

        } else{
            toastr()->error(trans('messages.student_code_error'));
            return redirect()->route('sons.index');
        }
    }

    public function attendance()
    {
        $parent= Auth::guard('myparent')->user();
        return view('pages.myparents.dashboard.attendance',['sons'=> $this->getStudents($parent)]);
    }


    public function attendance_search(Request $request)
    {
        $parent= Auth::guard('myparent')->user();
        $sons = $this->getStudents($parent);

        if($request->student_id == 0){
            $sons = Attendance::whereBetween('attendance_date',[$request->from,$request->to])->get();
            return view('pages.myparents.dashboard.attendance_search',['sons'=>$sons]);
        }
        else{
            $sons = Attendance::whereBetween('attendance_date',[$request->from,$request->to])->where('student_id',$request->student_id)->get();
            return view('pages.myparents.dashboard.attendance_search',['sons'=>$sons]);
        }
    }

    public function invoices(){
        $parentId = Student::where('parent_id',Auth::guard('myparent')->user()->id)->pluck('id');
        $invoices = Invoice::whereIn('student_id',$parentId)->get();
        return view('pages.myparents.dashboard.invoices',['invoices'=>$invoices]);
    }


    public function receipts($id){
        $parent = Student::findOrFail($id);
        if($parent->parent_id == Auth::guard('myparent')->user()->id){
            $receipts = ReceiptStudent::where('student_id',$parent->id)->get();
            if($receipts->isEmpty()){
                toastr()->error(trans('messages.no_receipts'));
                return redirect()->route('sons.fees');
            }
            else{
                return view('pages.myparents.dashboard.receipts',['receipts'=>$receipts]);
            }

        }
        else{
            toastr()->error(trans('messages.student_code_error'));
            return redirect()->route('sons.fees');
        }
    }


    public function profile()
    {
        $parent = Auth::guard('myparent')->user();
        return view('pages.myparents.dashboard.profile',['parent'=>$parent]);
    }

    public function update(Request $request,$id)
    {
        try{
            $parent = Myparent::findOrFail($id);
            if(!empty($request->password)){
                $parent->update([
                    'father_name' => [
                        'en' => $request->name_en,
                        'ar' => $request->name_ar
                        ],
                    'password' => Hash::make($request->password),

                ]);

            } else {
                $parent->update([
                    'father_name' => [
                        'en' => $request->name_en,
                        'ar' => $request->name_ar
                        ],
                ]);
            }
            toastr()->success(trans('messages.update'));
            return redirect()->route('parent.profile');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
