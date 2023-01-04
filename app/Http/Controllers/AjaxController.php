<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\models\Level;
use App\models\Section;

class AjaxController extends Controller
{
    // public function getLevelsByGrade($id)
    // {
    //     $list_levels = Level::where('grade_id',$id)->pluck('name','id');
    //     return response()->json($list_levels);
    // }

    // public function getSectionsByLevel($id)
    // {
    //     $list_sections = Section::where('level_id',$id)->pluck('name','id');
    //      return response()->json($list_sections);
    // }
}
