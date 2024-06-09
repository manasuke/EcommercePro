<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function view_category()
    {
        return view('admin.category');
    }

    public function add_category()
    {
        $category = new Category();
        $category->category_name = request('category');
        $category->save();
        return back()->with('message', 'Category Added Successfully');
    }
}
