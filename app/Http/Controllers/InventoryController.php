<?php

namespace App\Http\Controllers;

use App\Models\Inv;
use App\Models\Category;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function inventory(){

        $invens = Inv::all();
        return view('inventory', ['invens' => $invens]);
    }

    public function add(){
        $cate = Category::all();
        return view('inv-add', ['cate' => $cate]);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'inv_code' => 'required|unique:invs|max:255',
            'title' => 'required|max:255',
            'stock' => 'required|max:255',
        ]);

        $inv = Inv::create($request->all());
        $inv->categories()->sync($request->categories);
        return redirect('inventory')->with('status', 'Add Item Success');
    }

    public function edit($slug){
        $inv = Inv::where('slug', $slug)->first();
        $cate = Category::all();
        return view('inv-edit', ['cate' => $cate, 'inv' => $inv]);
    }

    public function update(Request $request, $slug){

        $inv = Inv::where('slug', $slug)->first();
        $inv->update($request->all());

        if ($request->categories) {
            $inv->categories()->sync($request->categories);
        }


        return redirect('inventory')->with('status', 'Edit Item Success');

    }

    public function delete($slug){
        $inv = Inv::where('slug', $slug)->first();
        return view('inv-delete', ['inv' => $inv]);
    }

    public function eliminate($slug){
        $inv = Inv::where('slug', $slug)->first();
        $inv->delete();
        return redirect('inventory')->with('status', 'Delete Item Success');
    }

    public function deletedInv(){
        $deletedInv = Inv::onlyTrashed()->get();
        return view('inv-deleted-list', ['deletedInv' => $deletedInv]);
    }

    public function restore($slug){
        $inv = Inv::withTrashed()->where('slug', $slug)->first();
        $inv->restore();
        return redirect('inventory')->with('status', 'Restore Item Success');
    }
}
