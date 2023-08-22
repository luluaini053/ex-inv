<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Inv;
use App\Models\User;
use App\Models\InvLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class InvReturnController extends Controller
{
    public function return(){
        $users = User::where('id', '!=', '1')->where('status', '!=', 'inactive')->get();
        $inv = Inv::all();
        return view('inv-return', ['users' => $users, 'inv' =>$inv]);
    }

    public function heal(Request $request){
        $request['actual_return_date'] = Carbon::now()->toDateString(); // Tanggal aktual pengembalian

        try {
            DB::beginTransaction();

            // Mencari catatan peminjaman yang sesuai
            $invLog = InvLogs::where('user_id', $request->user_id)
                ->where('actual_return_date', null)
                ->where('inv_id', $request->inv_id)
                ->first();

            if (!$invLog) {
                Session::flash('message', 'Process error.');
                Session::flash('alert-class', 'alert-danger');
                return redirect('inv-return');
            }

            // Mengatur tanggal aktual pengembalian
            $invLog->actual_return_date = $request->actual_return_date;
            $invLog->save();

            // Memperbarui status inventaris menjadi 'in stock'
            $inv = Inv::findOrFail($request->inv_id);
            $inv->status = 'in stock';
            $inv->save();

            DB::commit();

            Session::flash('message', 'Item returned successfully.');
            Session::flash('alert-class', 'alert-success');
            return redirect('inv-return');

        } catch (\Throwable $th) {
            DB::rollBack();
        }

        //user dan inv yang dipilih untuk di return benar, maka berhasil return inv
        //user dan inv yang dipilih untuk di return salah, maka muncul error notice
        //$log = InvLogs::where('user_id', $request->user_id)->where('inv_id', $request->inv_id)->where('actual_return_date', null);
        //$logData = $log->first();
        //$countData = $log->count();

        //if($countData == 1){
        //    //return inv
        //    $logData->actual_return_date= Carbon::now()->toDateString();
        //    $logData->save();

        //    Session::flash('message', 'Item return success ');
        //    Session::flash('alert-class', 'alert-success');
        //    return redirect('inv-return');
        //}
        //else{
        //    //error notice muncul
        //    Session::flash('message', 'Item return process error ');
        //    Session::flash('alert-class', 'alert-danger');
        //    return redirect('inv-return');
        //}

        //$return = InvLogs::find(1);
        //$return->status = 'not available';
        //$return->save();
        //$borrow = InvLogs::where('status', '=', 'not available')-get();


    }
    public function rentItem(Request $request)
{
    //$request->validate([
    //    'inv_id' => 'required', // Ensure you have the necessary validation rules
    //    'user_id' => 'required',
    //    // Add other validation rules for your request
    //]);

    //$inv = Inv::findOrFail($request->inv_id);

    //if ($inv->status != 'in stock') {
    //    return redirect('inv-rent')
    //        ->with('error', 'Cannot rent the item');
    //}

    //$count = InvLogs::where('user_id', $request->user_id)
    //    ->whereNull('actual_return_date')
    //    ->count();

    //if ($count >= 3) {
    //    return redirect('inv-rent')
    //        ->with('error', 'Cannot rent, user has reached the limit');
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

    //    // Increase the stock of the item
    //    $inv->stock++;

    //    // Update the status to 'in stock'
    //    $inv->status = 'in stock';

    //    $inv->save();

    //    DB::commit();

    //    return redirect('inv-rent')
    //        ->with('success', 'Rent Item Success');
    //} catch (\Throwable $th) {
    //    DB::rollBack();

    //    return redirect('inv-rent')
    //        ->with('error', 'An error occurred while processing your request');
    //}

        $rules = [
            'inv_id' => 'required', // Add appropriate validation rules for inv_id
            'user_id' => 'required', // Add appropriate validation rules for user_id
        ];

        $this->validate($request, $rules);

        try {
            DB::beginTransaction();

            $inv = Inv::findOrFail($request->inv_id);

            if ($inv->status == 'in stock') { // Change the condition
                // Create a new record in the inv_logs table
                $invLogData = [
                    'inv_id' => $request->inv_id,
                    'user_id' => $request->user_id,
                    'inv_date' => Carbon::now()->toDateString(),
                    'return_date' => Carbon::now()->addDay(3)->toDateString(),
                ];

                // Create a new record in the inv_logs table
                InvLogs::create($invLogData);

                // Decrease the stock of the item
                $inv->stock++;

                // Update the status based on the remaining stock
                if ($inv->stock != 0) {
                    $inv->status = 'in stock';
                }

                $inv->save();

                DB::commit();

                Session::flash('message', 'Rent Item Success');
                Session::flash('alert-class', 'alert-success');
                return redirect('inv-rent');
            } else {
                Session::flash('message', 'Cannot rent the item');
                Session::flash('alert-class', 'alert-danger');
                return redirect('inv-rent');
            }
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect('inv-rent')
                ->with('error', 'An error occurred while processing your request: ' . $th->getMessage());
        }

}

}


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
        //            $inv->status = 'not available';
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

//status in stock blm bisa,

//kirim inv_id dan user_id ke controller (dari route)
//check status sekarang dari inv nya, kalau in stock -> tolak request (untuk apa dikembalikan, karena sedang ada barangnya)
//ambil data dari inv_logs yang actual_return_date = null, berdasarkan inv_id dan user_id
//kalau ada datanya, berarti dia sedang pinjam barangnya. isi actual_return_date dengan tanggal dan update status inv ke in stock
//kalau tak ada, berarti dia sedang tak pinjam barang nya (dia pernah pinjam tapi sudah dikembalikan semua)
