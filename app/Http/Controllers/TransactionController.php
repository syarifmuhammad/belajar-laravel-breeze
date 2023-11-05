<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    public function index() {
        return view('transaksi.daftarTransaksi');
    }

    public function getAllTransactions(Request $request) {
        $transactions = DB::table('transactions as t')
        ->select(
            't.id as id',
            'u.name as peminjam',
            'v.name as kendaraan',
            't.startDate as start',
            't.endDate as end',
            't.price as price',
            DB::raw('
                (CASE 
                WHEN t.status="1" THEN "Pinjam" 
                WHEN t.status="2" THEN "Kembali" 
                WHEN t.status="3" THEN "Hilang" 
                END) AS status
                '),
        )
        ->join('users as u', 't.userId', '=', 'u.id')
        ->join('vehicles as v', 't.vehicleId', '=', 'v.id')
        ->orderBy('t.startDate', 'asc')
        ->get();

        return DataTables::of($transactions)->addColumn('action', function($transaction) {
            $html = "<a class='btn btn-info' href='".route('transactions.edit', $transaction->id)."'>Update</a>";
            return $html;
        })->make(true);
    }

    public function create() {
        $users = DB::table('users')->get();
        $vehicles = DB::table('vehicles')->get();
        return view('transaksi.peminjaman', compact('users', 'vehicles'));
    }

    public function store(Request $request) {
        $request->validate([
            'idPeminjam' => 'required|exists:users,id',
            'jenisKendaraan' => 'required|exists:vehicles,id',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after:startDate',
        ]);

        DB::beginTransaction();
        try {
            $vehicle = DB::table('vehicles')->where('id', $request->jenisKendaraan)->first();
            $transaction = new Transaction();
            $transaction->userId = $request->idPeminjam;
            $transaction->vehicleId = $request->jenisKendaraan;
            $transaction->startDate = $request->startDate;
            $transaction->endDate = $request->endDate;
            $transaction->price = $vehicle->dailyPrice * (strtotime($request->endDate) - strtotime($request->startDate)) / (60 * 60 * 24);
            $transaction->status = 1;
            $transaction->save();
            DB::commit();

            return redirect()->route('transactions.index')->with('success', 'Berhasil menambahkan transaksi');
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
            // return abort(500, $e->getMessage());
        }

    }

    public function edit(Request $request, $id) {
        $transaction = DB::table('transactions as t')
        ->select(
            't.id as id',
            'u.name as peminjam',
            'v.name as kendaraan',
            't.startDate as start',
            't.endDate as end',
            't.price as price',
            't.status as status',
        )
        ->join('users as u', 't.userId', '=', 'u.id')
        ->join('vehicles as v', 't.vehicleId', '=', 'v.id')
        ->where('t.id', '=', $id)
        ->first();

        return view('transaksi.pengembalian', compact('transaction'));

    }

    public function update(Request $request) {
        $request->validate([
            'idTransaksi' => 'required|exists:transactions,id',
            'status' => 'required|in:1,2,3',
        ]);

        $transaction = Transaction::find($request->idTransaksi);
        $transaction->status = $request->status;
        $transaction->save();

        return redirect()->route('transactions.index')->with('success', 'Berhasil mengubah status transaksi');
    }
}
