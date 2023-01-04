<?php
namespace App\Http\Controllers\Grades;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGradeRequest;
use App\Models\Grade;
use App\Models\Level;
use Exception;
use Illuminate\Http\Request;


class GradeController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $data['grades'] = Grade::paginate(20);
    return view('pages.grades.grades')->with($data);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {

  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(StoreGradeRequest $request)
  {
      if(Grade::where('name->ar',$request->name)->orWhere('name->en',$request->name_en)->exists()){
          return redirect()->back()->withErrors(trans('messages.rebeat_warrning'));
      }
    try {
        //method #1
        // $grade = new Grade();
        // $grade->name = ['en'=> $request->name_en, 'ar'=>$request->name];
        // $grade->notes = $request->notes;
        // $grade->save();

        //method#2
       
        Grade::create([
            'name' => [
               'en' => $request->name_en,
               'ar' => $request->name
            ],
         ]);
        toastr()->success(trans('messages.success'));
        return redirect()->route('grades.index');
    }
    catch(Exception $e){
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
   }

  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(StoreGradeRequest $request)
  {
    try {
        $validated = $request->validated();
        $grade = Grade::findOrFail($request->id);
        // dd($request);
        $grade->update([
            'name'=> ['ar'=> $request->name, 'en'=> $request->name_en],
            'notes' => $request->notes
        ]);

        toastr()->success(trans('messages.update'));
        return redirect()->route('grades.index');
    }
    catch(Exception $e){
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
   }

  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Request $request)
  {
    try {

        $gradeLevels = Level::where('grade_id',$request->id)->pluck('grade_id');
        if($gradeLevels->count() === 0) {
            $grade = Grade::findOrFail($request->id)->delete();
            toastr()->error(trans('messages.delete'));
            return redirect()->route('grades.index');
        } else {
            toastr()->warning(trans('messages.nested_warrning'));
            return redirect()->route('grades.index');
        }
     
    }
    catch(Exception $e){
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
   }

  }


}

?>
