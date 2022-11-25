<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductSearch;
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
            "start" => "required|numeric",
            "storeSearch" => "required"
        ]);

        if($validator->fails())
        {
            return response()->json([
                "message" => __("Input is not correct")
            ], 400);
        }
        
        $query = $this->query();

        if($request->input("storeSearch") == "true")
            $this->storeSearch();

        return response()->json([
            "state" => "success",
            "count" => $query->count(),
            "data" => $query->skip($request->input('start'))->take(12)->get(),
        ]);
    }

    public function query()
    {
        $request = request();
        return Product::when($request->input("categories"), function($query) use ($request) {
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
    }

    public function storeSearch()
    {
        $request = request();
        if($request->input("start") == 0)
        {
            ProductSearch::create([
                "search_query" => json_encode($request->except("_token"))
            ]);
        }
    }
}
