<?php

namespace App\Http\Controllers;

use App\Models\Inv;
use App\Models\User;
use App\Models\InvLogs;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $invQty = Inv::count();
        $cateQty = Category::count();
        $userQty = User::count();
        $invlog = InvLogs::with(['user', 'inv'])->get();
        return view('dashboard', ['inv_qty' => $invQty, 'cate_qty'=> $cateQty, 'user_qty' => $userQty, 'inv_log' => $invlog]);
    }
}
