<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function cate(){
        $cate = Category::all();
        return view('category', ['cate' => $cate]);
    }

    public function add(){
        return view('category-add');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:100',
        ]);

        $cateStore = Category::create($request->all());
        return redirect('categories')->with('status', 'Add Category Success');

    }

    public function edit($slug){
        $catego = Category::where('slug', $slug)->first();
        return view('category-edit', ['catego' => $catego]);
    }

    public function update(Request $request, $slug){
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:100',
        ]);

        $catego = Category::where('slug', $slug)->first();
        $catego->slug = null;
        $catego->update($request->all());
        return redirect('categories')->with('status', 'Update Category Success');

    }

    public function delete($slug){
        $cate = Category::where('slug', $slug)->first();
        return view('category-delete', ['cate' => $cate]);

    }

    public function eliminate($slug){
        $cate = Category::where('slug', $slug)->first();
        $cate->delete();
        return redirect('categories')->with('status', 'Delete Category Success');
    }

    public function deleteCategory(){
        $deletedCate = Category::onlyTrashed()->get();
        return view('category-deleted-list', ['deletedCate' => $deletedCate]);
    }

    public function restore($slug){
        $cate = Category::withTrashed()->where('slug', $slug)->first();
        $cate->restore();
        return redirect('categories')->with('status', 'Restore Category Success');
    }

}
