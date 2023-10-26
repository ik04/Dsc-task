<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\Category;
use App\Services\BookService;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct(
        protected BookService $service
    ){

    }
    
    public function addBook(BookRequest $request){
        $book = $this->service->store($request->get("name"),$request->get("category_uuid"));     
        return response()->json(["book"=>$book,"message"=>"book created"]);
    }


    public function getBooks(){
        $books = $this->service->getBooks();
        return response()->json($books,200);
    }


    public function deleteBook($bookUuid){
        $this->service->deleteBook($bookUuid);
        return response()->json(["message"=>"Book deleted Successfully!"]);
    }
    
    public function updateBook($bookUuid,$categoryUuid){

        $this->service->updateBookCategory($bookUuid,$categoryUuid);
        // todo: learn to pass exceptions
        return response()->json(["message" => "Book category updated successfully"]);
    }
}
