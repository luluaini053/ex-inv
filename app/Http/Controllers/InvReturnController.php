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
        $invLogs = InvLogs::with(['inv', 'depart'])->where('stock', '>', 0)->get();
        return view('inv-return', ['users' => $users, 'invs' => $invLogs]);
    }

public function heal(Request $request){
    try {
        DB::beginTransaction();
        // $condition = $request->condition;
        $requestFields = $request->all();
        // dd($requestFields);
        // request ->
        //    "_token" => "y4ROR9u7a6bPiVWaI8EyYMN1InVlpTbgQLiuWF8R"
        //   "qty1" => "3"
        //   "qty2" => "2"
        //   "qty3" => null
        //   "nickname" => "fui"
        //   "condition" => "bagus www"

        // loop through all fields in request

        foreach ($requestFields as $key => $value) {

            // periksa apakah field nya itu mengandung "qty"
            // key = qty23 "qty" ?
            if (strpos($key, "qty") !== false) {
                // jika iya, maka ambil angka di field tersebut, contohnya qty3 -> ambil 3
                $idInvLog = filter_var($key, FILTER_SANITIZE_NUMBER_INT);
                if (!empty($idInvLog)) {
                    // ambil data inv logs
                    $invLog = InvLogs::findOrFail($idInvLog);

                    // jika catatan peminjaman tidak ada, maka skip
                    if (!$invLog || $value == null) {
                        continue;
                    }

                    // kurangi jumlah yang dipinjam di inv logs dengan jumlah yang dikembalikan
                    $invLog->stock = $invLog->stock - $value;
                    // Mengatur tanggal aktual pengembalian
                    $invLog->actual_return_date = Carbon::now()->toDateString();
                    //update condition
                    $invLog->condition = $request->condition;

                    // save inv log
                    $invLog->save();

                    // ambil data inv dengan id inv
                    $inv = Inv::findOrFail($invLog->inv_id);
                    // value dari field adalah jumlah barang yang dikembalikan, tambhakn value dengan jumlah stock inv
                    $inv->stock = $inv->stock + $value;
                    // memperbarui status inventaris menjadi 'in stock'
                    $inv->status = 'in stock';
                    // save inv
                    $inv->save();
                }
            }
        }

        DB::commit();

        Session::flash('message', 'Item returned successfully.');
        Session::flash('alert-class', 'alert-success');
        return redirect('inv-return');

    } catch (\Throwable $th) {
        DB::rollBack();

            Session::flash('message', $th->getMessage());
            Session::flash('alert-class', 'alert-danger');
            return redirect('inv-return');
        }
    }

}


//status in stock blm bisa,

//kirim inv_id dan user_id ke controller (dari route)
//check status sekarang dari inv nya, kalau in stock -> tolak request (untuk apa dikembalikan, karena sedang ada barangnya)
//ambil data dari inv_logs yang actual_return_date = null, berdasarkan inv_id dan user_id
//kalau ada datanya, berarti dia sedang pinjam barangnya. isi actual_return_date dengan tanggal dan update status inv ke in stock
//kalau tak ada, berarti dia sedang tak pinjam barang nya (dia pernah pinjam tapi sudah dikembalikan semua)
