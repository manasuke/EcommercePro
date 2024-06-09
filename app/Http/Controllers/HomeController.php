<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Stripe\Charge;
use Stripe\Stripe;

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

    public function show_cart()
    {
        if (Auth::id()) {
            $id = Auth::user()->id;
            $carts = Cart::where('user_id', $id)->get();
            return view('home.showcart', compact('carts'));
        } else {
            return redirect('login');
        }
    }

    public function remove_cart(Cart $cart)
    {
        $cart->delete();
        return back();
    }

    public function cash_order()
    {
        $user = Auth::user();
        $data = Cart::where('user_id', $user->id)->get();

        foreach ($data as $data) {
            $order = new Order();
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->image = $data->image;
            $order->product_id = $data->product_id;

            $order->payment_status = 'cash on delivery';
            $order->delivery_status = 'processing';

            $order->save();

            $cart_id = $data->id;
            Cart::destroy($cart_id);
        }
        return back()->with('message', 'We have Received Your Order. We will connect with you soon.');
    }

    public function stripe($totalPrice)
    {
        return view('home.stripe', compact('totalPrice'));
    }

    public function stripePost(Request $request, $totalPrice)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        Charge::create([

            "amount" => $totalPrice * 100,

            "currency" => "usd",
            "source" => $request->stripeToken,

            "description" => "Thank for payment."

        ]);

        $user = Auth::user();
        $data = Cart::where('user_id', $user->id)->get();

        foreach ($data as $data) {
            $order = new Order();
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->image = $data->image;
            $order->product_id = $data->product_id;

            $order->payment_status = 'Paid';
            $order->delivery_status = 'processing';

            $order->save();

            $cart_id = $data->id;
            Cart::destroy($cart_id);
        }

        Session::flash('success', 'Payment successful!');

        return back();
    }
}
