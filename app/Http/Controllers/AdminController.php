<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Notifications\MyFirstNotification;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
    public function view_category()
    {
        $categories = Category::all();
        // dd($categories);
        return view('admin.category', compact('categories'));
    }

    public function add_category()
    {
        $category = new Category();
        $category->category_name = request('category');
        $category->save();
        return back()->with('message', 'Category Added Successfully');
    }

    public function delete_category(Category $category)
    {
        $category->delete();
        return back()->with('message', 'Category Deleted Successfully');
    }

    public function view_product()
    {
        $categories = Category::all();
        return view('admin.product', compact('categories'));
    }

    public function add_product()
    {
        $product = new Product();
        $product->title = request('title');
        $product->description = request('description');
        $product->category = request('category');
        $product->quantity = request('quantity');
        $product->price = request('price');
        $product->discount = request('discount');

        $image = request('image');
        $image_name = time() . '.' . $image->getClientOriginalExtension();
        $image->move('product', $image_name);
        $product->image =  $image_name;
        $product->save();

        return back()->with('message', 'Product Added Successfully');
    }

    public function show_product()
    {
        $products = Product::all();
        return view('admin.show_product', compact('products'));
    }

    public function delete_product(Product $product)
    {
        $product->delete();
        return back()->with('message', 'Product Deleted Successfully');
    }

    public function update_product(Product $product)
    {
        $categories = Category::all();
        return view('admin.update_product', compact('product', 'categories'));
    }

    public function update_product_confirm(Product $product)
    {
        $product->title = request('title');
        $product->description = request('description');
        $product->category = request('category');
        $product->quantity = request('quantity');
        $product->price = request('price');
        $product->discount = request('discount');
        $image = request('image');
        if ($image) {
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move('product', $image_name);
            $product->image =  $image_name;
        }
        $product->update();
        return redirect('show_product')->with('message', 'Product Updated Successfully');
    }

    public function order()
    {
        $orders = Order::all();
        return view('admin.order', compact('orders'));
    }

    public function delivered(Order $order)
    {
        // dd($order);
        $order->delivery_status = 'delivered';
        $order->payment_status = 'paid';
        $order->update();
        return back();
    }

    public function print_pdf(Order $order)
    {
        $pdf = FacadePdf::loadView('admin.pdf', compact('order'));
        return $pdf->download($order->id . '.pdf');
    }

    public function send_email(Order $order)
    {
        return view('admin.email_info', compact('order'));
    }

    public function send_email_confirm(Order $order)
    {
        $details = [
            'greeting' => request('greeting'),
            'firstline' => request('firstline'),
            'body' => request('body'),
            'button' => request('button'),
            'url' => request('url'),
            'lastline' => request('lastline'),
        ];

        Notification::send($order, new MyFirstNotification($details));

        return back();
    }

    public function searchData(Request $request)
    {
        $searchText = $request->search;
        $orders = Order::where('product_title', 'like', '%' . $searchText . '%')->get();
        return view('admin.order', compact('orders'));
    }
}
