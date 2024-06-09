<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
}
