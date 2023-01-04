<?php
namespace App\Repository;

use Exception;
use Carbon\Carbon;
use App\Models\Book;
use App\Models\Quiz;
use App\Models\Grade;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class BookRepository implements BookRepositoryInterface {
    public function index()
    {
        $data['books'] = Book::paginate(20);
        return view('pages.books.index')->with($data);
    }

    public function show($id)
    {

    }

    public function create()
    {
        $data['grades'] = Grade::all();
        $data['teachers'] = Teacher::all();
        return view('pages.books.create')->with($data);
    }

    public function store($request)
    {
        try {
            $path = Storage::putFile('books', $request->file('file_name'));
            Book::create([
                'title' => $request->title,
                'grade_id' => $request->grade_id,
                'level_id' => $request->level_id ,
                'section_id' => $request->section_id ,
                'teacher_id' => $request->teacher_id ,
                'file_name' => $path,
            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->route('qubooksizzes.index');
        }
        catch (Exception $e) {
            // DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function edit($id)
    {
        $data['book'] = Book::findOrFail($id);
        $data['grades'] = Grade::all();
        $data['teachers'] = Teacher::all();
        return view('pages.books.edit')->with($data);
    }
    public function update($request)
    {
        try {
            $book = Book::findOrFail($request->id);
            $Quiz->update([
                'name' => [
                    'en' => $request->name_en,
                    'ar' => $request->name_ar
                ],
                'subject_id' => $request->subject_id ,
                'teacher_id' => $request->teacher_id ,
                'grade_id' => $request->grade_id,
                'level_id' => $request->level_id ,
                'section_id' => $request->section_id ,

            ]);
            toastr()->success(trans('messages.update'));
            return redirect()->route('quizzes.index');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        $Quiz = Quiz::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.delete'));
        return back();
    }


    public function download($request)
    {

    }
}
?>
