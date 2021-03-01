<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\Kelurahan;
use App\Models\Rw;
use App\Models\provinsi;
use App\Models\Kasus2;
class FrontendController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $positif = DB::table('rws')->select('kasus2s.jpositif','kasus2s.jsembuh','kasus2s.jmeninggal')
            ->join ('kasus2s','rws.id','=','kasus2s.id_rw')
            ->sum('kasus2s.jpositif');
           
           
            $sembuh = DB::table('rws')->select('kasus2s.jpositif','kasus2s.jsembuh','kasus2s.jmeninggal')
            ->join ('kasus2s','rws.id','=','kasus2s.id_rw')
            ->sum('kasus2s.jsembuh');

            $meninggal = DB::table('rws')->select('kasus2s.jpositif','kasus2s.jsembuh','kasus2s.jmeninggal')
            ->join ('kasus2s','rws.id','=','kasus2s.id_rw')
            ->sum('kasus2s.jmeninggal');

            $lokal = DB::table('provinsis')
            ->join('kotas','kotas.id_provinsi','=','provinsis.id')
            ->join('kecamatans','kecamatans.id_kota','=','kotas.id')
            ->join('kelurahans','kelurahans.id_kecamatan','=','kecamatans.id')
            ->join('rws','rws.id_kelurahan','=','kelurahans.id')
            ->join('kasus2s','kasus2s.id_rw','=','rws.id')
            ->select('nama_provinsi',           
                    DB::raw('sum(kasus2s.jpositif) as jpositif'),
                    DB::raw('sum(kasus2s.jsembuh) as jsembuh'),
                    DB::raw('sum(kasus2s.jmeninggal) as jmeninggal'))
            ->groupBy('nama_provinsi')->orderBy('nama_provinsi','ASC')
            ->get();

            //Pengambilan Data Positif sedunia secara online (by.KawalCorona.com)


             // Table Global        
       

        return view('frontend.index', compact('positif','sembuh','meninggal','lokal'));
    }
}