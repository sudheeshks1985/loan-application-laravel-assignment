<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\LoanApplicationController;
use App\Http\Controllers\api\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Register/Login and get an access token
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/loan-application/store-loan-application', [LoanApplicationController::class,'storeLoanApplication']);
Route::get('/loan-application/get-loan-application/{id}', [LoanApplicationController::class,'getLoanApplication']);
Route::get('/loan-application/get-total-annual-income/{id}', [LoanApplicationController::class, 'getTotalAnnualIncome']);

