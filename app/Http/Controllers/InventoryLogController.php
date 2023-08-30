<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\InvLogs;
use Illuminate\Http\Request;

class InventoryLogController extends Controller
{
    public function inventorylog(){
        $invlog = InvLogs::with(['user', 'inv'])->get();
        return view('inventoryLog', ['inv_log' => $invlog]);
    }
}


