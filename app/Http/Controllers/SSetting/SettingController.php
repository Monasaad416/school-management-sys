<?php

namespace App\Http\Controllers\SSetting;

use Exception;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request as FacadesRequest;

class SettingController extends Controller
{
    public function index()
    {
        $collection = Setting::all();

         $setting['setting'] =$collection->flatMap(function($collection){
            return [ $collection->key =>$collection->value];
         });

         return view('pages.schoolSettings.index',$setting);
    }

    public function update(Request $request)
    {
        try {
            $data = $request->all();

            foreach($data as $key => $value){
                $setting = Setting::where('key',$key)->update([
                    'value' => $value,
                ]);
            }
    

            toastr()->success(trans('messages.update'));
            return back();
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
