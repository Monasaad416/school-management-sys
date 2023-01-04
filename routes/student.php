<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Setting\SettingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Students\Dashboard\QuizController;
use App\Http\Livewire\ShowQuestion;
use App\Http\Controllers\Students\Dashboard\ProfileController;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:student' ]
    ], function(){

        Route::prefix('/student/dashboard')->group(function(){
            Route::get('/',function(){
                return view('pages.students.dashboard.dashboard');
            })->name('student_dashboard');

            Route::resource('s_quizzes', QuizController::class);
            Route::resource('student_profile', ProfileController::class);
        });

});








