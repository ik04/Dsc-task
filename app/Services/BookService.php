<?php

namespace App\Services;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class BookService{

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

    public function store(string $name,Uuid $categoryUuid,){
        $actualCategoryId = $this->getCategoryId($categoryUuid);
        $book = Book::create(["name"=>strtolower($name),"category_id"=>$actualCategoryId,"book_uuid"=>Uuid::uuid4()]);  
        unset($book["category_id"]);
        unset($book["id"]);
        return $book;
    }
    public function getBooks(){
        $books = Book::join("categories", "categories.id", "=", "books.category_id")
        ->select("books.name", "books.book_uuid", "categories.name as category")
        ->get();
        return $books;
    }
    public function deleteBook(Uuid $bookUuid){
        if (!Uuid::isValid($bookUuid)) {
            return response()->json(["error" => "Invalid UUID format"], 400);
        }
        $actualBookId = $this->getBookId($bookUuid);
        Book::where("id",$actualBookId)->delete();
    }
    public function updateBookCategory(Uuid $bookUuid, Uuid $categoryUuid){
        $actualCategoryId = $this->getCategoryId($categoryUuid);
        $actualBookId = $this->getBookId($bookUuid);
        if (!$actualCategoryId) {
            return response()->json(["error" => "New category not found"], 404);
        }
        if(!$actualBookId){
            return response()->json(["error" => "Book not found"], 404);
        }
        Book::where("id", $actualBookId)->update(["category_id" => $actualCategoryId]);
    }
    // todo: run test cases
}