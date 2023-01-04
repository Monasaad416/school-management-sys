<?php
namespace App\Repository;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Level;
use App\Models\Section;
use App\Models\Student;
use App\Models\Fee;

use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class FeesRepository implements FeesRepositoryInterface {
    public function index()
    {
        $data['grades'] = Grade::all();
        $data['fees'] = Fee::all();
        return view('pages.fees.index')->with($data);
    }

    public function create()
    {
        $grades = Grade::all();
        return view('pages.fees.add',['grades'=>$grades]);
    }

    public function store($request)
    {
        try {
            Fee::create([
                'title' => [
                    'en' => $request->title_en,
                    'ar' => $request->title_ar,
                ],
                'amount' =>$request->amount,
                'grade_id' => $request->grade_id,
                'level_id' => $request->level_id,
                'description' => $request->description,
                'fees_type' => $request->fees_type,
                'academic_year' => $request->academic_year,
            ]);
                toastr()->success(trans('messages.success'));
                return redirect()->route('fees.index');
        }
        catch (Exception $e) {
            // DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }



    public function edit()
    {

    }
    public function update($request)
    {

    }

    public function destroy($id)
    {

    }
}
?>
