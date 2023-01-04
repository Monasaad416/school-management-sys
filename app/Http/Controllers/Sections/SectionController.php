<?php

namespace App\Http\Controllers\Sections;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSectionRequest;
use App\Models\Level;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;
use Exception;
use Illuminate\Http\Request;

class SectionController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
      $data['gradesWithSections'] = Grade::with(['sections'])->get();
      $data['grades'] = Grade::all();
      $data['levels'] = Level::all();
      $data['sections'] = Section::all();
      $data['teachers'] = Teacher::all();
      return view('pages.sections.sections')->with($data);
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
  public function store(StoreSectionRequest $request)
  {
    try {

        $validated = $request->validated();

          Section::create([
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar
             ],
              'status' => 1 ,
              'grade_id' => $request->grade_id,
              'level_id' => $request->level_id,
          ]);
        $section = Section::latest()->first();
        $section->teachers()->attach($request->teacher_id);

        toastr()->success(trans('messages.success'));
        return redirect()->route('sections.index');
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
  public function update(StoreSectionRequest $request)
  {
    try {

      $validated = $request->validated();
      if(isset($request->status)){
        $request->status = 1;
      } else {
        $request->status = 0;
      }

      $section = Section::findOrFail($request->id);
      $section->update([
        'name' => [
            'en' => $request->name_en,
            'ar' => $request->name_ar
          ],
          'status' => $request->status ,
          'grade_id' => $request->grade_id,
          'level_id' => $request->level_id,
      ]);

      //update pivot table
      if(isset($request->teacher_id)){
          $section->teachers()->sync($request->teacher_id);
      } else {
        $section->teachers()->sync(array());
      }


      toastr()->success(trans('messages.update'));
      return redirect()->route('sections.index');
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
  public function destroy($id)
  {

  }

  public function getEachGradeLevels($grade_id)
  {
    $listOfLevels = Level::where('grade_id',$grade_id)->pluck('name','id');
    return response()->json( $listOfLevels);

  }

}

?>
