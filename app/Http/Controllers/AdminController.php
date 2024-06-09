<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

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
}
