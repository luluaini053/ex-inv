<?php

namespace App\Http\Controllers;

use App\Models\Inv;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request){
        $cate = Category::all();

        if($request->category|| $request->title){
            $invs = Inv::where('title', 'like', '%'.$request->title.'%')
                        ->orWhereHas('categories', function($q) use($request){
                            $q->where('categories.id', $request->category);
                        })
                        ->get();

        }else{
            $invs = Inv::all()->where('status', 'in stock');
        }
        return view('inventory-list', ['invs' => $invs, 'cate' => $cate]);
    }
}
