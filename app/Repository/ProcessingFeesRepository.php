<?php
namespace App\Repository;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Level;
use App\Models\Section;
use App\Models\Student;
use App\Models\Fee;
use App\Models\ProcessingFee;
use App\Models\StudentAccount;

use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Http\Requests\StoreProcessingFeesRequest;

use function Ramsey\Uuid\v1;

class ProcessingFeesRepository implements ProcessingFeesRepositoryInterface {
    public function index()
    {
        $data['processing_fees'] = ProcessingFee::paginate(20);
        return view('pages.processing_fees.index')->with($data);
    }
    public function show($id)
    {
        $student = Student::findOrFail($id);
        toastr()->success(trans('messages.success'));
        return view('pages.processing_fees.add',['student'=>$student]); 
        
    }

    public function create()
    {
        $grades = Grade::all();
        return view('pages.fees.add',['grades'=>$grades]);
    }

    public function store($request)
    {

        DB::beginTransaction();
        try {
                $processing_fees = new ProcessingFee();
                $processing_fees->processing_fees_date = Carbon::now()->toDateTimeString();
                $processing_fees->student_id = $request->student_id;
                $processing_fees->amount = $request->debit;
                $processing_fees->description = $request->description;
                $processing_fees->save();

                $studAccount = new StudentAccount();
                $studAccount->student_id =  $request->student_id;
                $studAccount->processing_id = $processing_fees->id;
                $studAccount->date = Carbon::now()->toDateTimeString(); 
                $studAccount->type ='processing_fees';
                $studAccount->debit =  0;
                $studAccount->credit = $request->debit;
                $studAccount->description = $request->description;
                $studAccount->save();
    
            DB::commit();
                toastr()->success(trans('messages.success'));
                return redirect()->route('processing_fees.index');
        } 
        catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function edit($id)
    {
        $processing_fee = ProcessingFee::findOrFail($id);
        return view('pages.processing_fees.edit',['processing_fee'=>$processing_fee]);

    }
    public function update($request)
    {
        DB::beginTransaction();
        try {
                $processing_fee = ProcessingFee::where('id',$request->id)->first();
                $processing_fee->amount = $request->debit;
                $processing_fee->description = $request->description;
                $processing_fee->save();

                $studAccount = StudentAccount::where('student_id',$request->student_id)->where('processing_id',$processing_fee->id)->first();
                $studAccount->credit = $request->debit;
                $studAccount->description = $request->description;
                $studAccount->save();
    
            DB::commit();
                toastr()->success(trans('messages.success'));
                return redirect()->route('processing_fees.index');
        } 
        catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function destroy($request)
    {
        try {
            $processing_fee = ProcessingFee::findOrFail($request->id)->delete();
            toastr()->error(trans('messages.delete'));
            return back();
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}
?>
