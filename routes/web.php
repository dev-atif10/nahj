<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Web\ProjectController as ProjectWebController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\HomeController;


:get('/', function () {
    return view('pages.auth.signin', ['title' => 'E-commerce Dashboard']);
})->name('dashboard');



  Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
 



// Auth pages (custom)
Route::middleware('guest')->group(function () {

     Route::get('/', function () {
    return view('pages.auth.signin', ['title' => 'E-commerce Dashboard']);
})->name('dashboard');

    Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');



});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout')->middleware('auth');

// protect project pages with auth
Route::middleware(['web','auth'])->group(function () {
    Route::get('/projects', [ProjectWebController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [ProjectWebController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectWebController::class, 'store'])->name('projects.store');
    Route::get('/projects/{project}', [ProjectWebController::class, 'show'])->name('projects.show');
    Route::get('/projects/{project}/edit', [ProjectWebController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{project}', [ProjectWebController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project}', [ProjectWebController::class, 'destroy'])->name('projects.destroy');
    Route::delete('/projects/{project}/images/{image}', [ProjectWebController::class, 'destroyImage'])->name('projects.images.destroy');
});

// Admin routes for managing permissions
Route::prefix('admin')->name('admin.')->middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
});
