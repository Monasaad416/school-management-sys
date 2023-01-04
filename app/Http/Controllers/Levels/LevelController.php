<?php

namespace App\Http\Controllers\Levels;
use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Level;
use App\Http\Requests\StoreLevelRequest;
use Exception;
use Illuminate\Http\Request;

class LevelController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */

  public function index()
  {
    $data['levels'] = Level::all();
    $data['grades'] = Grade::all();
    return view('pages.levels.levels')->with($data);
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
  public function store(StoreLevelRequest $request)
  {
    // if(Level::where('name->ar',$request->name_ar)->orWhere('name->en',$request->name_en)->exists()){
    //     return redirect()->back()->withErrors(trans('messages.rebeat_warrning'));
    // }

    $list_levels = $request->list_levels;


  try {
      foreach ($list_levels as $level) {
        Level::create([
            'name' => [
               'en' => $level['name_en'],
               'ar' => $level['name_en'],
            ],
            'grade_id' => $level['grade_id'],
        ]);
        }



      toastr()->success(trans('messages.success'));
      return redirect()->route('levels.index');
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
  public function update(StoreLevelRequest $request,$id)
  {

    try {
        // $validated = $request->validated();
        $level = Level::findOrFail($request->id);
        // dd($request);
        $level->update([
            'name'=> ['ar'=> $request->name_ar, 'en'=> $request->name_en],
            'grade_id' => $request->grade_id,
        ]);

        toastr()->success(trans('messages.update'));
        return redirect()->route('levels.index');
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
  public function destroy(Request $request , $id)
  {
    try {
        $level = Level::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.delete'));
        return redirect()->route('levels.index');
    }
    catch(Exception $e){
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }

  public function delete_all(Request $request)
  {
      try{
        //   dd($request->delete_all_id);
        $all_deleted_ids = explode(',',$request->delete_all_id);
        Level::whereIn('id', $all_deleted_ids)->delete();
        toastr()->success(trans('messages.delete'));
        return redirect()->route('levels.index');
      }
      catch(Exception $e){
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }

  }


  public function filter_levels(Request $request)
  {
    $data['grades'] = Grade::all();
    $data['searchLevels'] = Level::where('grade_id',$request->grade_id)->get();
    // dd($data['searchLevels']);

    return view('pages.levels.levels')->with($data);


  }




}

?>
