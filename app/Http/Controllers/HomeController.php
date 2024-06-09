<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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

    public function add_cart(Product $product)
    {
        if (Auth::id()) {
            $user = Auth::user();
            $cart = new Cart();
            $cart->user_id = $user->id;
            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->product_title = $product->title;
            if ($product->discount) {
                $cart->price = $product->discount * request('quantity');
            } else {
                $cart->price = $product->price * request('quantity');
            }
            $cart->image = $product->image;
            $cart->product_id = $product->id;
            $cart->quantity = request('quantity');
            $cart->save();
            return back();
        } else {
            return redirect('login');
        }
    }
}
