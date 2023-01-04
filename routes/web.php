<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\SSetting\SettingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\Levels\LevelController;
use App\Http\Controllers\Sections\SectionController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Teachers\TeacherController;
use App\Http\Controllers\Students\StudentController;
use App\Http\Controllers\Students\PromoteStudentController;
use App\Http\Controllers\Graduation\GraduationController;
use App\Http\Controllers\Fees\FeesController;
use App\Http\Controllers\Fees\InvoiceController;
use App\Http\Controllers\ReceiptStudents\ReceiptStudentController;
use App\Http\Controllers\Fees\ProcessingFeesController;
use App\Http\Controllers\Fees\PaymentController;
use App\Http\Controllers\Attendance\AttendanceController;
use App\Http\Controllers\Subject\SubjectController;
use App\Http\Controllers\Quiz\QuizController;
use App\Http\Controllers\Question\QuestionController;
use App\Http\Controllers\OnlineClass\OnlineClassController;
use App\Http\Controllers\Book\BookController;



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

// Auth::routes();
Route::get('/',[HomeController::class,'index'])->name('selection');
Route::get('/login/{type}',[LoginController::class,'loginForm'])->name('login.show');
Route::Post('/login',[LoginController::class,'login'])->name('login');
Route::get('/logout/{type}',[LoginController::class,'logout'])->name('logout');


// Route::get('/admin/dashboard',function(){
//     return view('dashboard');
// });

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth' ]
    ], function(){
        	/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/

		    Route::get('/admin/dashboard', [HomeController::class,'dashboard'])->name('dashboard');
            Route::resource('grades', GradeController::class);
            Route::resource('levels', LevelController::class);
            Route::post('levels/delete_all', [LevelController::class, 'delete_all']);
            Route::post('search_customers', [LevelController::class, 'customer_report']);
            Route::post('levels/filter_levels', [LevelController::class, 'filter_levels'])->name('filter_levels');
            Route::resource('sections', SectionController::class);
            Route::get('getLevelsByGrade/{grade_id}', [SectionController::class, 'getEachGradeLevels'])->name("getLevelsByGrade");

            Route::view('show_parents' , 'livewire.show')->name('show_parent');
            Route::view('add_parent' , 'livewire.show_form')->name('add_parent');
            // Route::get('/parent/{id}', EditPartent::class);

            Route::resource('admins', AdminController::class);
            Route::resource('teachers', TeacherController::class);
            Route::resource('students', StudentController::class);
            Route::get('getLevelsByGrade/{id}',[StudentController::class,'getLevelsByGrade']);
            Route::get('getSectionsByLevel/{id}',[StudentController::class,'getSectionsByLevel']);
            Route::post('upload_attachment',[StudentController::class,'upload_attachment'])->name('upload_attachment');
            Route::get('download_attachment/{image_name}',[StudentController::class,'download_attachment']);

            Route::resource('promotions', PromoteStudentController::class);
            Route::post('promotions/demote', [PromoteStudentController::class,'demote_all'])->name('demote');
            Route::post('promotions/demote_student/{id}', [PromoteStudentController::class,'demote_student'])->name('demote_student');
            Route::resource('graduation', GraduationController::class);
            Route::resource('fees', FeesController::class);
            Route::resource('invoices', InvoiceController::class);
            Route::get('/get-invoices/{student_id}',[InvoiceController::class,'getInvoices'])->name('invoices.get');
            Route::resource('receipt_students', ReceiptStudentController::class);
            Route::resource('processing_fees', ProcessingFeesController::class);
            Route::resource('payments_fund', PaymentController::class);
            Route::resource('attendance', AttendanceController::class);
            Route::resource('subjects', SubjectController::class);
            Route::resource('quizzes', QuizController::class);
            Route::resource('questions', QuestionController::class);
            Route::resource('online_classes', OnlineClassController::class);
            Route::resource('books', BookController::class);

            Route::get('settings',[SettingController::class,'index'])->name('settings');
            Route::put('settings/update',[SettingController::class,'update'])->name('settings.update');


            //Livewire::component('calendar', Calendar::class);
    });






