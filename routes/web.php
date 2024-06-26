<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavorityCommentController;
use App\Http\Controllers\FavorityController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\RepositoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

Route::post('/language-switch', [LanguageController::class, 'languageSwitch'])->name('language.switch');

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
    ->middleware('auth')
    ->name('password.confirm');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.update');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
    ->middleware('auth');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/repository/{id}', [HomeController::class, 'repository'])->name('repository');
Route::get('search', [HomeController::class, 'search'])->name('search');
Route::post('download', [HomeController::class, 'download'])->name('download');

Route::group(['middleware' => 'auth'], function () {
    // Dashboard Routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Users Module
    Route::resource('users', UserController::class);

    // Topic Module
    Route::resource('topics', TopicController::class);

    // Topic Module
    Route::resource('types', TypeController::class);

    // Repository Module
    Route::resource('repositories', RepositoryController::class);
    Route::get('admin-repositories', [RepositoryController::class, 'indexAdmin'])->name('admin.repositories.index');

    Route::post('file', [FileUploadController::class, 'uploadFile'])->name('fileUpload');
    Route::post('file/{id}', [FileUploadController::class, 'uploadFile'])->name('fileUploadRepository');
    Route::delete('file/{id}', [FileUploadController::class, 'deleteFile'])->name('fileRemove');

    // Favority Module
    Route::get('favorities', [FavorityController::class, 'index'])->name('favorities.index');
    Route::post('favorities', [FavorityController::class, 'store'])->name('favorities.store');

    // Favority Comment Module
    Route::post('favoritiesComments', [FavorityCommentController::class, 'store'])->name('favorities.comment.store');

    // Rate Module
    Route::resource('ratings', RateController::class);

    // Favority Module
    Route::resource('comments', CommentController::class);
});

Route::get('clean', function(){
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('cache:cache');
    Artisan::call('config:cache');
    Artisan::call('route:cache');
    Storage::deleteDirectory('tmp');
});

/*
Route::get('deploy', function(){
    Artisan::call('migrate');
});
*/