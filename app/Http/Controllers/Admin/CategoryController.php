<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller{
    public function index(){
        $categories = Category::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create(){
        return view('admin.categories.create');
    }

    public function store(Request $request){
    $request->validate([
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:categories,slug',
        'description' => 'nullable|string',
    ]);

    Category::create([
        'name' => $request->name,
        'slug' => $request->slug,
        'description' => $request->description,
    ]);
    return redirect()->route('admin.categories.index')->with('success', 'Category added successfully!');
}

    public function edit(Category $category){
        return view('admin.categories.edit', compact('category'));
    }

    public function dashboard() {
        $categories = Category::all();
        return view('admin.dashboard', compact('categories'));
    }   

    public function update(Request $request, Category $category){
        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id,
            'slug' => 'required|unique:categories,slug,' . $category->id,
        ]);

        $category->update($request->all());
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category){
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}