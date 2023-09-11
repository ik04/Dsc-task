<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function addCategory(Request $request){
        $validation = Validator::make($request->all(),[
            "name" => "required|unique:categories"
        ]);
        if($validation->fails()){
            return response()->json($validation->errors()->all(),400);
        }
        $validated = $validation->validated();
        $santiziedCategory = strtolower($validated["name"]);
        if($existingCategory = Category::where('name', $santiziedCategory)
        ->exists()){
            return response()->json(["message" => "Category already exists!"], 409);
        }
        $category = Category::create(["name"=>$santiziedCategory,"category_uuid"=>Uuid::uuid4()]);
        $category = ["category_uuid"=>$category["category_uuid"],"name"=>$category["name"]];
        return response()->json(['category'=>$category,"message"=>"Category Added"]);
    }
    public function getCategoryId($categoryId)
    {
        $actualCategoryId = Category::where("category_uuid", $categoryId)->first("id")->id;
        return $actualCategoryId;
    }
    public function getCategories(Request $request){
        return response()->json(Category::select("name","category_uuid")->get(),200);
    }
    public function deleteCategory(Request $request){
        $validation = Validator::make($request->all(),[
            "category_uuid" => "required|uuid"
        ]);
        if($validation->fails()){
            return response()->json($validation->errors()->all(),400);
        }
        $validated = $validation->validated();
        $actualCategoryId = $this->getCategoryId($validated["category_uuid"]);
        $deleteCategory = Category::where("id",$actualCategoryId)->delete();
        return response()->json(["message"=>"Category deleted"],200);
    }

}
