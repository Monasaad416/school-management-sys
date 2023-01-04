<?php
namespace App\Repository;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Level;
use App\Models\Section;
use App\Models\Myparent;
use App\Models\Gender;
use App\Models\Nationality;
use App\Models\Blood;
use App\Models\Student;
use App\Models\Image;
use App\Models\ReceiptStudent;
use App\Models\AccountingFund;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ReceiptStudentRepository implements ReceiptStudentRepositoryInterface {
    public function index()
    {
        $data['receipt_students'] = ReceiptStudent::paginate(20);

        return view('pages.receipts.index')->with($data);
    }
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('pages.receipts.add',['student'=>$student]);

    }
    public function create()
    {

    }
    public function store($request)
    {
        DB::beginTransaction();
        try {
                $receipt = new ReceiptStudent();
                $receipt->receipt_date = Carbon::now()->toDateTimeString();
                $receipt->student_id = $request->student_id;
                $receipt->debit = $request->debit;
                $receipt->description = $request->description;
                $receipt->save();

                $accountingFund = new AccountingFund();
                $accountingFund->date = Carbon::now()->toDateTimeString();
                $accountingFund->receipt_id = $receipt->id;
                $accountingFund->debit = $request->debit;
                $accountingFund->credit = 0;
                $accountingFund->description = $request->description;
                $accountingFund->save();

                $studentAccount = new StudentAccount();
                $studentAccount->student_id = $receipt->student_id;
                $studentAccount->receipt_id = $receipt->id;
                $studentAccount->date = Carbon::now()->toDateTimeString();
                $studentAccount->type = 'Cash Receipt';
                $studentAccount->debit = 0;
                $studentAccount->credit = $request->debit;
                $studentAccount->description = $request->description;
                $studentAccount->save();

            DB::commit();
                toastr()->success(trans('messages.success'));
                return redirect()->route('receipt_students.index');
        }
        catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        $data['receipt_student'] = ReceiptStudent::findOrFail($id);
        return view('pages.receipts.edit')->with($data);
    }
    public function update($request)
    {
        DB::beginTransaction();
        try {
                $receipt = ReceiptStudent::findOrFail($request->id);
                $receipt->debit = $request->debit;
                $receipt->description = $request->description;
                $receipt->save();

                $accountingFund = AccountingFund::where('receipt_id',$receipt->id)->first();
                $accountingFund->debit = $request->debit;
                $accountingFund->description = $request->description;
                $accountingFund->save();

                $studentAccount = StudentAccount::where('receipt_id',$receipt->id)->first();
                $studentAccount->student_id = $receipt->student_id;
                $studentAccount->receipt_id = $receipt->id;
                $studentAccount->date = Carbon::now()->toDateTimeString();
                $studentAccount->type = 'Cash Receipt';
                $studentAccount->debit = 0;
                $studentAccount->credit = $request->debit;
                $studentAccount->description = $request->description;
                $studentAccount->save();

            DB::commit();
                toastr()->success(trans('messages.update'));
                return redirect()->route('receipt_students.index');
        }
        catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    public function destroy($request)
    {
        try {
            $receipt = ReceiptStudent::findOrFail($request->id)->delete();
            toastr()->error(trans('messages.delete'));
            return back();
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}
?>
