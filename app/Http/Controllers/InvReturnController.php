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

class InvReturnController extends Controller
{
public function return(Request $request){
    $users = User::where('id', '!=', '1')->where('status', '!=', 'inactive')->get();
    $invLogs = InvLogs::with(['inv','depart'])->where('actual_return_date', null)->get();
    $depart = Depart::all();
    // InvLogs::with(['user', 'inv'])
    // dd($invLogs[0]);
    return view('inv-return', ['users' => $users, 'invs' => $invLogs, 'depart' => $depart]);
}

public function heal(Request $request){
    $request['actual_return_date'] = Carbon::now()->toDateString(); // Tanggal aktual pengembalian

    try {
        DB::beginTransaction();

        // Mencari catatan peminjaman yang sesuai
        foreach ($invlog as $invlogs) {
            InvLogs::where('user_id', $request->user_id)
            ->where('actual_return_date', null)
            ->where('inv_id', $request->inv_id)
            ->first();
        }

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
        $inv->stock += $request->stock; //tambah kembali jumah stock yg dipinjam

        $inv->save();

        DB::commit();

        Session::flash('message', 'Item returned successfully.');
        Session::flash('alert-class', 'alert-success');
        return redirect('inv-return');

    } catch (\Throwable $th) {
        dd($th->getMessage());
        DB::rollBack();
    }

        //$request['actual_return_date'] = Carbon::now()->toDateString(); // Tanggal aktual pengembalian

        //try {
        //    DB::beginTransaction();

        //    // Mencari catatan peminjaman yang sesuai
        //    $invLogs = InvLogs::where('user_id', $request->user_id)
        //        ->whereNull('actual_return_date')
        //        ->where('inv_id', $request->inv_id)
        //        ->get();

        //    if ($invLogs->isEmpty()) {
        //        Session::flash('message', 'No matching rental records found.');
        //        Session::flash('alert-class', 'alert-danger');
        //        return redirect('inv-return');
        //    }

        //    // Memperbarui tanggal aktual pengembalian pada semua catatan peminjaman yang sesuai
        //    foreach ($invLogs as $invLog) {
        //        $invLog->actual_return_date = $request->actual_return_date;
        //        $invLog->save();
        //    }

        //    // Memperbarui status inventaris menjadi 'in stock' dan menambahkan kembali jumlah yang dikembalikan
        //    $inv = Inv::findOrFail($request->inv_id);
        //    $inv->status = 'in stock';
        //    $inv->stock += $request->stock; // Menambahkan kembali jumlah stok yang dikembalikan
        //    $inv->save();

        //    DB::commit();

        //    Session::flash('message', 'Items returned successfully.');
        //    Session::flash('alert-class', 'alert-success');
        //    return redirect('inv-return');

        //} catch (\Throwable $th) {
        //    dd($th->getMessage());
        //    DB::rollBack();
        //}
    }
}



//status in stock blm bisa,

//kirim inv_id dan user_id ke controller (dari route)
//check status sekarang dari inv nya, kalau in stock -> tolak request (untuk apa dikembalikan, karena sedang ada barangnya)
//ambil data dari inv_logs yang actual_return_date = null, berdasarkan inv_id dan user_id
//kalau ada datanya, berarti dia sedang pinjam barangnya. isi actual_return_date dengan tanggal dan update status inv ke in stock
//kalau tak ada, berarti dia sedang tak pinjam barang nya (dia pernah pinjam tapi sudah dikembalikan semua)
