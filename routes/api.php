<?php

use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Models\Book;
use App\Models\Category;
use Ramsey\Uuid\Uuid;

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
    Route::get("/healthcheck-and-init",function(){
        Category::create(
            ['name' => 'Fiction',"category_uuid" => Uuid::uuid4(), "id"=>1],
            ['name' => 'Non-Fiction',"category_uuid" => Uuid::uuid4(), "id"=>2],
            ['name' => 'Science Fiction',"category_uuid" => Uuid::uuid4(), "id"=>3],
            ["name"=>'History',"category_uuid" => Uuid::uuid4(), "id"=>4],
            ["name"=>'Magazine',"category_uuid" => Uuid::uuid4(), "id"=>5]
        );
        Book::create(
            ["name"=>"To Kill a Mockingbird","category_id"=>1, "id"=>1,"book_uuid"=>Uuid::uuid4()],
            ["name"=>"The Great Gatsby","category_id"=>1, "id"=>2,"book_uuid"=>Uuid::uuid4()],
            ["name"=>"Dune","category_id"=>3, "id"=>3,"book_uuid"=>Uuid::uuid4()],
            ["name"=>"The Art of War","category_id"=>2, "id"=>4,"book_uuid"=>Uuid::uuid4()],
            ["name"=>"Sapiens: A Brief History of Humankind","category_id"=>4, "id"=>5,"book_uuid"=>Uuid::uuid4()],
        );
            return response()->json("Welcome to Dsc Library, the database has been initialized with the categories and books ~Ishaan Khurana",200);
    });


    Route::post("/add-category",[CategoryController::class,"addCategory"]);
    Route::get("/get-categories",[CategoryController::class,"getCategories"]);
    Route::post("/delete-category",[CategoryController::class,"deleteCategory"]);

    Route::post("/add-book",[BookController::class,"addBook"]);
    Route::get("/get-books",[BookController::class,"getBooks"]);
    Route::post("/delete-book",[BookController::class,"deleteBook"]);
    Route::post("/update-book-category",[BookController::class,"updateBook"]);

});