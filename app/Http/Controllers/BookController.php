<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function getCategoryId($categoryId)
    {
        $actualCategoryId = Category::where("category_uuid", $categoryId)->first("id")->id;
        return $actualCategoryId;
    }
    public function getBookId($bookId)
    {
        $actualCategoryId = Book::where("book_uuid", $bookId)->first("id")->id;
        return $actualCategoryId;
    }
    
    public function addBook(Request $request){
        $validation = Validator::make($request->all(),[
            "name" => "required|string|unique:books",
            "category_uuid"=>"uuid|required"
        ]);
        if($validation->fails()){
            return response()->json($validation->errors()->all(),400);
        }
        $validated = $validation->validated();
        $actualCategoryId = $this->getCategoryId($validated["category_uuid"]);
        $book = Book::create(["name"=>strtolower($validated["name"]),"category_id"=>$actualCategoryId,"book_uuid"=>Uuid::uuid4()]);
        return response()->json(["book"=>$book,"message"=>"book created"]);
    }
    public function getBooks(Request $request){
        return response()->json(  Book::join("categories", "categories.id", "=", "books.category_id")
        ->select("books.name", "books.book_uuid", "categories.name as category")
        ->get(),200);
    }
    public function deleteBook(Request $request){
        $validation = Validator::make($request->all(),[
            "book_uuid" => "required|uuid"
        ]);
        if($validation->fails()){
            return response()->json($validation->errors()->all(),400);
        }
        $validated = $validation->validated();
        $actualBookId = $this->getBookId($validated["book_uuid"]);
        Book::where("id",$actualBookId)->delete();
        return response()->json(["message"=>"Book deleted Successfully!"]);
    }
    public function getByCategory(Request $request){
        $validation = Validator::make($request->all(),[
            "book_uuid" => "required|uuid",
            "category_uuid" => "required|uuid"
        ]);

        if($validation->fails()){
            return response()->json($validation->errors()->all(),400);
        }

        $validated = $validation->validated();
        $actualBookId = $this->getBookId($validated["book_uuid"]);
        $actualCategoryId = $this->getCategoryId($validated["category_uuid"]);
        return response()->json(["message"=>"Book deleted Successfully!"]);
    }
    public function updateBook(Request $request){
        $validation = Validator::make($request->all(),[
            "book_uuid" => "required|uuid",
            "new_category_uuid" => "required|string"
        ]);
        if($validation->fails()){
            return response()->json($validation->errors()->all(),400);
        }
        $validated = $validation->validated();

    }
}
