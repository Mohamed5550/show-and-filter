<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home', ["title" => __("Show and Filter")]);
    }

    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "search-input" => "string|nullable",
            "categories" => "array|nullable",
            "brands" => "array|nullable",
        ]);

        if($validator->fails())
        {
            return response()->json([
                "message" => __("Input is not correct")
            ], 400);
        }

        $query = Product::when($request->input("categories"), function($query) use ($request) {
            return $query->whereIn("category", $request->input("categories"));
        })
        ->when($request->input("brands"), function($query) use ($request) {
            return $query->whereIn("brand", $request->input("brands"));
        })
        ->when($request->input("search-input"), function($query) use ($request) {
            return $query->where("product", $request->input("search-input"))
                ->orWhere("category", $request->input("search-input"))
                ->orWhere("brand", $request->input("search-input"));
        });
        

        return response()->json([
            "state" => "success",
            "data" => $query->limit(12)->get(),
            "count" => $query->count()
        ]);
    }
}
