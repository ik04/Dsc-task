<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::prefix("v1")->group(function(){
    Route::get("/healthcheck",function(){
        return response()->json("Welcome to Dsc Library ~Ishaan Khurana",200);
    });


    Route::post("/add-category",[CategoryController::class,"addCategory"]);
    Route::get("/get-categories",[CategoryController::class,"getCategories"]);
    Route::post("/delete-category",[CategoryController::class,"deleteCategory"]);

});