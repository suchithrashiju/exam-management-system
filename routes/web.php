<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');


// Teacher login url
Route::get('register', [RegisteredUserController::class, 'create'])
    ->name('register');

Route::post('register', [RegisteredUserController::class, 'store']);

Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::post('login', [AuthenticatedSessionController::class, 'store']);

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

Route::middleware(['auth', 'teacher'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/student-list', [TeacherController::class, 'studentList'])->name('teacher.studentList');
    Route::get('/student-view/{student}', [TeacherController::class, 'studentView'])->name('teacher.studentView');

    Route::resource('exams', ExamController::class);
    Route::post('/exams/update-publish-status/{exam}', [ExamController::class, 'updatePublishStatus'])
        ->name('exams.updatePublishStatus');

    Route::post('/exams/update-archive-status/{exam}', [ExamController::class, 'updateArchiveStatus'])
        ->name('exams.updateArchiveStatus');
    Route::get('/completed-exams', [ExamController::class, 'completedExams'])->name('exams.completedExams');
    Route::get('/show-exam-result/{exam}/{student}', [ExamController::class, 'showResult'])->name('exams.showResult');

    Route::prefix('exams')->group(function () {
        Route::resource('{exam}/questions', QuestionController::class)
            ->names([
                'index' => 'exams.questions.index',
                'create' => 'exams.questions.create',
                'store' => 'exams.questions.store',
                'edit' => 'exams.questions.edit',
                'update' => 'exams.questions.update',
                'show' => 'exams.questions.show',
                'destroy' => 'exams.questions.destroy',
            ]);
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// teacher url end ---
//student url start

Route::get('/student/login', [StudentController::class, 'loginForm'])->name('student.login');
Route::get('/student/register', [StudentController::class, 'showRegisterForm'])->name('student.register');
Route::post('/student/register', [StudentController::class, 'register']);
Route::post('/student/login', [StudentController::class, 'login']);

Route::prefix('student')->middleware(['auth', 'student'])->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/apply-exams', [StudentController::class, 'applyExam'])->name('student.applyExam');
    Route::get('/exam-history', [StudentController::class, 'examHistory'])->name('student.examHistory');
    Route::get('/attend-exam/{exam}', [StudentController::class, 'attendExam'])->name('student.attendExam');
    Route::get('/view-exam-result/{exam}', [StudentController::class, 'viewExamResult'])->name('student.viewExamResult');

    Route::post('/submit-exam/{exam}', [StudentController::class, 'submitExam'])->name('student.submitExam');
    Route::post('/logout', [StudentController::class, 'logout'])->name('student.logout');

});
