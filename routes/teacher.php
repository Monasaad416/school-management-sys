<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Models\Teacher;
use App\Models\Student;
use App\Http\Controllers\Teachers\Dashboard\StudentController ;
use App\Http\Controllers\Teachers\Dashboard\SectionController;
use App\Http\Controllers\Teachers\Dashboard\AttendanceController;
use App\Http\Controllers\Teachers\Dashboard\TquizController;
use App\Http\Controllers\Teachers\Dashboard\TquestionController;
use App\Http\Controllers\Teachers\Dashboard\OnlineClassController;
use App\Http\Controllers\Teachers\Dashboard\ProfileController;



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:teacher' ]
    ], function(){

        Route::prefix('/teacher/dashboard')->group(function(){
            Route::get('/',function(){
                $sections_teacher =Teacher::findOrFail( Auth::guard('teacher')->user()->id)->sections()->pluck('section_id');
                $data['sections_teacher_count'] = $sections_teacher->count();
                $data['students_teacher'] = Student::whereIn('section_id',$sections_teacher)->get()->count();
                return view('pages.teachers.dashboard.dashboard')->with($data);
            })->name('teacher_dashboard');

            Route::get('students', [StudentController::class,'index'])->name('t_students');
            Route::get('sections', [SectionController::class,'index'])->name('t_sections');

            // Route::get('attendance', [AttendanceController::class,'index'])->name('t_attendance');
            Route::post('student_attendance_store', [StudentController::class,'store'])->name('t_attendance.store');
            Route::get('student_attendance_edit/{id}', [StudentController::class,'edit'])->name('t_attendance.edit');
            Route::post('student_attendance_update/{id}', [StudentController::class,'update'])->name('t_attendance.update');
            Route::get('student_attendance_report', [AttendanceController::class,'attendance_report'])->name('t_attendance.report');
            Route::get('student_submit_quiz/{quiz_id}', [TquizController::class,'students_submit'])->name('students.submit_quiz');
            Route::post('attendance_search', [AttendanceController::class,'attendance_search'])->name('t_attendance.search');

            Route::resource('t_quizzes', TquizController::class);
            Route::get('t_getLevelsByGrade/{id}',[TquizController::class,'t_getLevelsByGrade']);
            Route::get('t_getSectionsByLevel/{id}',[TquizController::class,'t_getSectionsByLevel']);

            Route::resource('t_questions', TquestionController::class);
            Route::resource('t_online_classes', OnlineClassController::class);

            Route::get('teacher_profile', [ProfileController::class,'index'])->name('teacher.profile');
            Route::post('teacher_profile/update/{id}', [ProfileController::class,'update'])->name('teacher_profile.update');
        });

});










