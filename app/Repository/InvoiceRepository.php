<?php
namespace App\Repository;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Level;
use App\Models\Section;
use App\Models\Student;
use App\Models\StudentAccount;
use App\Models\Fee;
use App\Models\Invoice;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class InvoiceRepository implements InvoiceRepositoryInterface {
    public function index()
    {
        $data['fees'] = Fee::all();
        $data['invoices'] = Invoice::paginate(20);
        $data['grades'] = Grade::all();
        return view('pages.fees.invoices')->with($data);
    }
    public function getInvoices($student_id)
    {
        $data['fees'] = Fee::all();
        $data['invoices'] = Invoice::where(function($query) use($student_id) {
                if($student_id){
                $query->where('student_id',$student_id);
            }else {
                $query->get();
            }
        })->get();

        $data['grades'] = Grade::all();
        return view('pages.fees.invoices')->with($data);
    }


    public function create()
    {

    }

    public function show($student_id)
    {
        $data['fees'] = Fee::paginate(20);
        $data['student'] = Student::findOrFail($student_id);
        return view('pages.fees.add_invoice_item')->with($data);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $list_fees = $request->list_fees;
            foreach ($list_fees as $stud_fees) {
                $invoice = new Invoice();
                $invoice->invoice_date = Carbon::now()->toDateTimeString();
                $invoice->student_id = $stud_fees['student_id'];
                $invoice->fee_id  = $stud_fees['fee_id'];
                $invoice->amount = $stud_fees['amount'];
                $invoice->description = $stud_fees['description'];
                $invoice->grade_id = $request->grade_id;
                $invoice->level_id = $request->level_id;
                $invoice->save();

                $studAccount = new StudentAccount();
                $studAccount->student_id = $stud_fees['student_id'];
                $studAccount->invoice_id = $invoice->id;
                $studAccount->date = Carbon::now()->toDateTimeString();
                $studAccount->type ='Invoice';
                $studAccount->debit =  $stud_fees['amount'];
                $studAccount->credit = 0;
                $studAccount->description = $stud_fees['description'];
                $studAccount->save();
            }

            DB::commit();
                toastr()->success(trans('messages.success'));
                return redirect()->route('invoices.show');
        }
        catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function edit($id)
    {
        $invoice = Invoice::findOrFail($id);
        $fees = Fee::where('level_id', $invoice->level_id)->get();
        return view('pages.fees.edit_invoice',['invoice' => $invoice,'fees'=>$fees]);
    }
    public function update($request)
    {
        DB::beginTransaction();
        try {
            $invoice = Invoice::findOrFail($request->id);
            $invoice->update([
                'fee_id' => $request->fee_id,
                'amount' => $request->amount,
                'description' => $request->description,
            ]);

            $studentAccount = StudentAccount::where('invoice_id',$request->id)->first();

            $studentAccount->update([
                'type' =>'Invoice',
                'depit' =>  $request->amount,
                'credit' => 0,
                'description' => $request->description,
            ]);


            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('invoices.show');
        }
        catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($request)
    {
        try {
            $invoice = Invoice::findOrFail($request->id)->delete();
            toastr()->error(trans('messages.delete'));
            return back();
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
?>
