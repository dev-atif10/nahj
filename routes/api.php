<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route; 
 
use App\Http\Controllers\Api\Auth\UserAuthController;
use App\Http\Controllers\Api\BankAccountController;
use App\Http\Controllers\Api\ProjectController;




Route::post('/register', [UserAuthController::class, 'register']);
Route::post('/login', [UserAuthController::class, 'login']);
Route::post('/forgot-password', [UserAuthController::class, 'forgotPassword']);
Route::post('/reset-password', [UserAuthController::class, 'resetPassword']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UserAuthController::class, 'logout']);
    Route::get('/me', [UserAuthController::class, 'me']);
   Route::put('/updateProfile', [UserAuthController::class, 'updateProfile']);
   Route::delete('/user', [UserAuthController::class, 'deleteAccount']);

 



    /// those are for bank accounts
    Route::get('/bank-accounts', [BankAccountController::class, 'index']);
    Route::post('/bank-accounts', [BankAccountController::class, 'store']);
    Route::get('/bank-accounts/{id}', [BankAccountController::class, 'show']);
    Route::put('/bank-accounts/{id}', [BankAccountController::class, 'update']);
    Route::delete('/bank-accounts/{id}', [BankAccountController::class, 'destroy']);


    // to add projects 
     Route::post('/projects', [ProjectController::class, 'store']);
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::get('/projects/{project}', [ProjectController::class, 'show']);
    Route::put('/projects/{project}', [ProjectController::class, 'update']);
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy']);
    
    // Route::post('/projects', [ProjectController::class, 'store']);
//     Route::prefix('projects')->group(function () {
//     Route::post('/', [ProjectController::class, 'store']);
//     Route::get('/', [ProjectController::class, 'index']);
//     Route::get('{project}', [ProjectController::class, 'show']);
//     Route::put('{project}', [ProjectController::class, 'update']);
//     Route::delete('{project}', [ProjectController::class, 'destroy']);
//     Route::delete('projects/{project}/images/{image}', [ProjectController::class, 'destroyImage']);

// });


});

