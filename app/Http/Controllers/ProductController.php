<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Banner;
use App\Models\Highlight;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    // public function index() {

    //     // $product = Product::latest()->paginate(5);
    //     // return view('index', compact('product'));
    //         // ->with('i', (request()->input('page', 1) - 1) * 3);
    // }

    // public function store(Request $request) {
    //     if($request->id) {
    //     return $product = Product::where('id', $request->id)->update($request->all());
    //     } else {
    //         $product = Product::create($request->all());
    //     }

    //     if(!is_null($product)) {
    //         return response()->json(["status" => "success", "message" => "Success!", "data" => $product]);
    //     } else {
    //         return response()->json(["status" => "failed", "message" => "Allert!"]);
    //     }
    // }
    // public function update(Request $request) {
    //     // $product_id = $r->id;
    //     return $product = Product::where('id', $request->id)->update($request->all());
    // }
    // public function destroy($product_id) {
    //     $product = Product::where("id", $product_id)->delete();
    // }
    public function getProduct(Request $request) {
        $search =  $request->search;
        if($search!=""){
             $cari = Product::where(function ($query) use ($search){
                $query->where('title', 'like', '%'.$search.'%')
                    ->orWhere('umkm', 'like', '%'.$search.'%');
            })->paginate(4);
            $cari->appends(['search' => $search]);
        } else {
            $cari = null;
        }
        error_log($cari);
        $banners = Banner::orderByDesc('created_at')->take(5)->get();
        $hlTags = Highlight::distinct()->select('tag')->get();
        $highlights = Highlight::get();
        $products = Product::latest()->paginate(4);
        return view('index', compact('products', 'banners', 'highlights', 'hlTags', 'cari'));
    }
}
