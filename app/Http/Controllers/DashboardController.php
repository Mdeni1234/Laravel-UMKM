<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $umkm = Product::distinct('umkm')->count();
        $product = Product::count();
        $banner = Product::where('banner_img', '!=', null)->count();
        $highlight = Product::where('highlight', '=', 1)->count();
        return view('dashboard', compact('umkm', 'product', 'banner', 'highlight'));
    }
}
