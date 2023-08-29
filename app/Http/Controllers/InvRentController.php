<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Inv;
use App\Models\User;
use App\Models\Depart;
use App\Models\InvLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class InvRentController extends Controller
{
    public function index(){
        $users = User::where('id', '!=', '1')->where('status', '!=', 'inactive')->get();
        $inv = Inv::all();
        return  view('inv-rent', ['users' => $users, 'inv' => $inv]);
    }

    public function store(Request $request){
        $rules = [
            'inv_id' => 'required', // Add appropriate validation rules for inv_id
            'stock' => 'required', // Add appropriate validation rules for stock
            'nickname' => 'required',
            'condition' => 'required',
        ];

        $this->validate($request, $rules);

        try {
            DB::beginTransaction();

            $inv = Inv::findOrFail($request->inv_id);

            if ($inv->stock - $request->stock < 0) {
                Session::flash('message', 'Item stock is not enough');
                Session::flash('alert-class', 'alert-danger');
                return redirect('inv-rent');
            }
            if ($inv->status != 'in stock') {
                Session::flash('message', 'Cannot rent the item');
                Session::flash('alert-class', 'alert-danger');
                return redirect('inv-rent');
            }

            $user = User::find(Auth::user()->id);

            $invLogData = [
                'inv_id' => $request->inv_id,
                'title' => $request->title,
                'user_id' => $user->id,
                'nickname' => $request->nickname,
                'depart_id' => $user->depart_id,
                'stock' => $request->stock,
                'inv_date' => Carbon::now()->toDateString(),
                'return_date' => Carbon::now()->addDay(3)->toDateString(),
                'condition' => $request->condition,
            ];

            // Create a new record in the inv_logs table
            InvLogs::create($invLogData);

            // Decrease the stock of the item
            $inv->stock -= $request->stock;

            // Update the status based on the remaining stock dan menghilangkan barang dari diplay
            if ($inv->stock <= 0) {
                $inv->status = 'not available';
                $inv->stock = 0;
            }
            $inv->save();
            DB::commit();

            Session::flash('message', 'Rent Item Success');
            Session::flash('alert-class', 'alert-success');
            return redirect('inv-rent');

        } catch (\Throwable $th) {

            DB::rollBack();
        }
    }

}



