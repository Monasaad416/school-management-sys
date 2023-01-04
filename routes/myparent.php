<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Setting\SettingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Myparents\Dashboard\MyparentController;
use App\Models\Student;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:myparent' ]
    ], function(){

        Route::prefix('/myparent/dashboard')->group(function(){
            Route::get('/',function(){
                $parent= Auth::guard('myparent')->user();
                $students = student::all();
                $data['sons'] = $students->where('parent_id',$parent->id)->all();
                return view('pages.myparents.dashboard.dashboard',['parent'=>$parent])->with($data);
            })->name('myparent.dashboard');
            Route::get('/sons',[MyparentController::class,'index'])->name('sons.index');
            Route::get('/son/{id}/results',[MyparentController::class,'results'])->name('sons.results');
            Route::get('/sons/attendance',[MyparentController::class,'attendance'])->name('sons.attendance');
            Route::post('/sons/attendance/search',[MyparentController::class,'attendance_search'])->name('sons_attendance.search');
            Route::get('/sons/fees',[MyparentController::class,'invoices'])->name('sons.fees');
            Route::get('/son/{id}/receipt',[MyparentController::class,'receipts'])->name('sons.receipts');
            Route::get('/profile',[MyparentController::class,'profile'])->name('parent.profile');
            Route::post('/profile/update/{id}',[MyparentController::class,'update'])->name('parent.profile.update');
        });

});








