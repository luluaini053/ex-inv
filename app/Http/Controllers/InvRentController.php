<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Inv;
use App\Models\User;
use App\Models\InvLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class InvRentController extends Controller
{
    public function index(){
        $users = User::where('id', '!=', '1')->where('status', '!=', 'inactive')->get();
        $inv = Inv::all();
        return  view('inv-rent', ['users' => $users, 'inv' => $inv]);
    }

    public function store(Request $request){
        //$request['inv_date'] = Carbon::now()->toDateString();
        //$request['return_date'] = Carbon::now()->addDay(3)->toDateString();

        //$inv = Inv::findOrFail($request->inv_id)->only('status');

        //if ($inv['status'] != 'in stock') {
        //    Session::flash('message', 'Cannot rent the item ');
        //    Session::flash('alert-class', 'alert-danger');
        //    return redirect('inv-rent');
        //}else{
        //    $count = InvLogs::where('user_id', $request->user_id)->where('actual_return_date', null)->count();

        //    if($count >= 3){
        //        Session::flash('message', 'Cannot rent, user has reach a limit');
        //        Session::flash('alert-class', 'alert-danger');
        //        return redirect('inv-rent');
        //    }else{
        //        try {
        //            DB::beginTransaction();

        //            //proses insert to inv_logs table
        //            InvLogs::create($request->all());
        //            //proses update invs table
        //            $inv = Inv::findOrFail($request->inv_id);
        //            DB::table('inv')->decrement('stock');
        //            if ($inv->stock == 0) {
        //                $inv->status = 'not available';
        //            }

        //            $inv->save();
        //            DB::commit();

        //            Session::flash('message', 'Rent Item Success');
        //            Session::flash('alert-class', 'alert-success');
        //            return redirect('inv-rent');

        //        } catch (\Throwable $th) {
        //            DB::rollBack();
        //        }
        //    }


        //}

        //$request->validate([
        //    'inv_id' => 'required', // Make sure you have the necessary validation rules
        //    'user_id' => 'required',
        //    // Add other validation rules for your request
        //]);

        //$inv = Inv::findOrFail($request->inv_id);

        //if ($inv->status != 'in stock') {
        //        Session::flash('message', 'Cannot rent the item ');
        //        Session::flash('alert-class', 'alert-danger');
        //        return redirect('inv-rent');
        //}

        //$count = InvLogs::where('user_id', $request->user_id)
        //    ->whereNull('actual_return_date')
        //    ->count();

        //if ($count >= 3) {
        //    Session::flash('message', 'Cannot rent, user has reach a limit');
        //    Session::flash('alert-class', 'alert-danger');
        //    return redirect('inv-rent');
        //}

        //try {
        //    DB::beginTransaction();

        //    $invLogData = [
        //        'inv_id' => $request->inv_id,
        //        'user_id' => $request->user_id,
        //        'inv_date' => Carbon::now()->toDateString(),
        //        'return_date' => Carbon::now()->addDay(3)->toDateString(),
        //    ];

        //    // Create a new record in the inv_logs table
        //    InvLogs::create($invLogData);

        //    // Decrease the stock of the item
        //    $inv->stock--;

        //    // Update the status based on the remaining stock
        //    if ($inv->stock == 0) {
        //        $inv->status = 'not available';
        //    }

        //    $inv->save();

        //    DB::commit();

        //    Session::flash('message', 'Rent Item Success');
        //    Session::flash('alert-class', 'alert-success');
        //    return redirect('inv-rent');

        //} catch (\Throwable $th) {
        //    DB::rollBack();
        //}

        $rules = [
            'inv_id' => 'required', // Add appropriate validation rules for inv_id
            'user_id' => 'required', // Add appropriate validation rules for user_id
        ];

        $this->validate($request, $rules);

        try {
            DB::beginTransaction();

            $inv = Inv::findOrFail($request->inv_id);

            if ($inv->stock - $request->stock < 0) {
                // tolak peminjaman karena stock tidak cukup
                Session::flash('message', 'item stock is not enough');
                Session::flash('alert-class', 'alert-danger');
                return redirect('inv-rent');
            }

            if ($inv->status != 'in stock') {
                Session::flash('message', 'Cannot rent the item');
                Session::flash('alert-class', 'alert-danger');
                return redirect('inv-rent');
            }

            $count = InvLogs::where('user_id', $request->user_id)
                ->whereNull('actual_return_date')
                ->count();

            $invLogData = [
                'inv_id' => $request->inv_id,
                'user_id' => $request->user_id,
                'stock' => $request->stock,
                'inv_date' => Carbon::now()->toDateString(),
                'return_date' => Carbon::now()->addDay(3)->toDateString(),
            ];

            // Create a new record in the inv_logs table
            InvLogs::create($invLogData);

            // Decrease the stock of the item
            //$inv->stock--;
            $inv->stock -= $request->stock;

            // Update the status based on the remaining stock
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

//kendala di display, nggk bisa munculin qty yg di req.
//display tidak bisa berkurang sesuai dengan request an user.





