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
use App\Models\Payment;
use App\Models\AccountingFund;

use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Http\Requests\StorePaymentRequest;

class PaymentRepository implements PaymentRepositoryInterface {
    public function index()
    {
        $data['payments'] = Payment::paginate(20);
        return view('pages.payments_fund.index')->with($data);
    }
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('pages.payments_fund.add',['student'=>$student]);

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
            $payment_fund = new Payment();
            $payment_fund->date = Carbon::now()->toDateTimeString();
            $payment_fund->student_id = $request->student_id;
            $payment_fund->amount = $request->amount;
            $payment_fund->description = $request->description;
            $payment_fund->save();

            $fund_account = new AccountingFund();
            $fund_account->date = Carbon::now()->toDateTimeString();
            $fund_account->payment_id = $payment_fund->id;
            $fund_account->debit = 0.00;
            $fund_account->credit = $request->amount;
            $fund_account->description = $request->description;
            $fund_account->save();

            $students_accounts = new StudentAccount();
            $students_accounts->date = Carbon::now()->toDateTimeString();
            $students_accounts->type = 'payment';
            $students_accounts->student_id = $request->student_id;
            $students_accounts->payment_id = $payment_fund->id;
            $students_accounts->debit = $request->amount;
            $students_accounts->credit = 0.00;
            $students_accounts->description = $request->description;
            $students_accounts->save();

            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Payment_students.index');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function edit($id)
    {
        $payment= Payment::findOrFail($id);
        return view('pages.payments_fund.edit',['payment'=>$payment]);

    }
    public function update($request)
    {
        DB::beginTransaction();
        try {

                $payment_fund = Payment::where('id',$request->id)->first();
                $payment_fund->amount = $request->amount;
                $payment_fund->description = $request->description;
                $payment_fund->save();

                $fund_account = AccountingFund::where('payment_id',$payment_fund->id)->first();
                $fund_account->date = Carbon::now()->toDateTimeString();
                $fund_account->payment_id = $payment_fund->id;
                $fund_account->debit = 0.00;
                $fund_account->credit = $request->amount;
                $fund_account->description = $request->description;
                $fund_account->save();

                $students_accounts = StudentAccount::where('student_id',$request->student_id)->where('payment_id',$payment_fund->id)->first();
                $students_accounts->date = Carbon::now()->toDateTimeString();
                $students_accounts->type = 'payment';
                $students_accounts->student_id = $request->student_id;
                $students_accounts->payment_id = $payment_fund->id;
                $students_accounts->debit = $request->amount;
                $students_accounts->credit = 0.00;
                $students_accounts->description = $request->description;
                $students_accounts->save();

            DB::commit();
                toastr()->success(trans('messages.update'));
                return redirect()->route('payments_fund.index');
        }
        catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function destroy($request)
    {
        try {
            $payment = Payment::findOrFail($request->id)->delete();
            toastr()->error(trans('messages.delete'));
            return back();
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}
?>
