<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(3);
        return view('home.userpage', compact('products'));
    }
    public function redirect()
    {
        $usertype = Auth::user()->usertype;
        if ($usertype == '1') {
            return view('admin.home');
        } else {
            $products = Product::latest()->paginate(3);
            return view('home.userpage', compact('products'));
        }
    }

    public function product_details(Product $product)
    {
        return view('home.product_details', compact('product'));
    }
}
