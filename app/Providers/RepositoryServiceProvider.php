<?php

namespace App\Providers;
use App\Repository\TeacherRepository;
use App\Repository\TeacherRepositoryInterface;
use App\Repository\StudentRepository;
use App\Repository\StudentRepositoryInterface;
use App\Repository\PromotRepository;
use App\Repository\PromotRepositoryInterface;
use App\Repository\GraduateRepository;
use App\Repository\GraduateRepositoryInterface;
use App\Repository\FeesRepository;
use App\Repository\FeesRepositoryInterface;
use App\Repository\InvoiceRepository;
use App\Repository\InvoiceRepositoryInterface;
use App\Repository\ReceiptStudentRepository;
use App\Repository\ReceiptStudentRepositoryInterface;
use App\Repository\ProcessingFeesRepository;
use App\Repository\ProcessingFeesRepositoryInterface;
use App\Repository\PaymentRepository;
use App\Repository\PaymentRepositoryInterface;
use App\Repository\AttendanceRepository;
use App\Repository\AttendanceRepositoryInterface;
use App\Repository\SubjectRepository;
use App\Repository\SubjectRepositoryInterface;
use App\Repository\QuizRepository;
use App\Repository\QuizRepositoryInterface;
use App\Repository\QuestionRepository;
use App\Repository\QuestionRepositoryInterface;
use App\Repository\OnlineClassRepository;
use App\Repository\OnlineClassRepositoryInterface;
use App\Repository\BookRepository;
use App\Repository\BookRepositoryInterface;
use App\Repository\StudentQuizRepository;
use App\Repository\StudentQuizRepositoryInterface;
use Illuminate\Support\ServiceProvider;




class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            TeacherRepositoryInterface::class,
            TeacherRepository::class
        );
        $this->app->bind(
            StudentRepositoryInterface::class,
            StudentRepository::class
        );
        $this->app->bind(
            PromotRepositoryInterface::class,
            PromotRepository::class
        );
            $this->app->bind(
            GraduateRepositoryInterface::class,
            GraduateRepository::class
        );
        $this->app->bind(
            FeesRepositoryInterface::class,
            FeesRepository::class
        );
        $this->app->bind(
            InvoiceRepositoryInterface::class,
            InvoiceRepository::class
        );
        $this->app->bind(
            ReceiptStudentRepositoryInterface::class,
            ReceiptStudentRepository::class
        );
        $this->app->bind(
            ProcessingFeesRepositoryInterface::class,
            ProcessingFeesRepository::class
        );
        $this->app->bind(
            PaymentRepositoryInterface::class,
            PaymentRepository::class
        );
        $this->app->bind(
           AttendanceRepositoryInterface::class,
           AttendanceRepository::class
        );
        $this->app->bind(
            SubjectRepositoryInterface::class,
            SubjectRepository::class
         );
        $this->app->bind(
            QuizRepositoryInterface::class,
            QuizRepository::class
         );
         $this->app->bind(
            QuestionRepositoryInterface::class,
            QuestionRepository::class
         );
         $this->app->bind(
            OnlineClassRepositoryInterface::class,
            OnlineClassRepository::class
         );
         $this->app->bind(
            BookRepositoryInterface::class,
            BookRepository::class
         );
         $this->app->bind(
            StudentQuizRepositoryInterface::class,
            StudentQuizRepository::class
         );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
