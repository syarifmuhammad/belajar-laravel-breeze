<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class VehicleController extends Controller
{
    public function index()
    {
        return view('kendaraan.daftarKendaraan');
    }

    public function getAllVehicles(Request $request)
    {
        $vehicles = DB::table('vehicles as v')
            ->select(
                'v.id as id',
                'v.name as name',
                't.name as type',
                'v.license as license',
                'v.dailyPrice as dailyPrice',
            )
            ->join('types as t', 'v.typeId', '=', 't.id')
            ->orderBy('v.name', 'asc')
            ->get();

        return DataTables::of($vehicles)->make(true);
    }
}
