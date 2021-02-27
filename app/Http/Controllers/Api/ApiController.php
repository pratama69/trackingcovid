<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Rw;
use App\Models\Kasus2;
use DB;
use GuzzleHttp\Client;

class ApiController extends Controller
{
    public $data = [];
    public function global()
    {
        
        $response = Http::get( 'https://api.kawalcorona.com/global/' )->json();
        foreach ($response as $data => $val){
            $raw =$val['attributes'];
            $res = [
                'Negara' => $raw['Country_Region'],
                'Positif' => $raw ['Confirmed'],
                'Sembuh' => $raw ['Recovered'],
                'meninggal' => $raw ['Deaths']
            ];
            array_push($this->data, $res);
         }
            $data = [
                'success' => true,
                'data' => $this->data,
                'message' => 'berhasil'
            ];
            return response()->json($data,200);

    }
    public function provinsi()
    {
        $provinsi = DB::table('provinsis')
                    ->select('provinsis.nama_provinsi',
                    DB::raw('SUM(kasus2s.jpositif) as Positif'),
                    DB::raw('SUM(kasus2s.jsembuh) as Sembuh'),
                    DB::raw('SUM(kasus2s.jmeninggal) as Meninggal'))
                        ->join('kotas', 'provinsis.id', '=', 'kotas.id_provinsi')    
                        ->join('kecamatans', 'kotas.id', '=', 'kecamatans.id_kota')
                        ->join('kelurahans', 'kecamatans.id', '=', 'kelurahans.id_kecamatan')
                        ->join('rws', 'kelurahans.id', '=', 'rws.id_kelurahan')
                        ->join('kasus2s', 'rws.id', '=', 'kasus2s.id_rw')
                        ->groupBy('provinsis.nama_provinsi')
                        ->get();

                        $provinsi2 = DB::table('provinsis')
                        ->select('provinsis.nama_provinsi',
                        DB::raw('SUM(kasus2s.jpositif) as Positif'),
                        DB::raw('SUM(kasus2s.jsembuh) as Sembuh'),
                        DB::raw('SUM(kasus2s.jmeninggal) as Meninggal'))
                            ->join('kotas', 'provinsis.id', '=', 'kotas.id_provinsi')    
                            ->join('kecamatans', 'kotas.id', '=', 'kecamatans.id_kota')
                            ->join('kelurahans', 'kecamatans.id', '=', 'kelurahans.id_kecamatan')
                            ->join('rws', 'kelurahans.id', '=', 'rws.id_kelurahan')
                            ->join('kasus2s', 'rws.id', '=', 'kasus2s.id_rw')
                            ->whereDate('kasus2s.tanggal', date('Y-m-d'))
                            ->groupBy('provinsis.nama_provinsi')
                            ->get();
                            $arr = [
                                'status' => 200,
                                'data' => [     
                                'Hari Ini' =>[$provinsi2],
                                'Total' =>[$provinsi]
                                ],
                                'message' => 'Berhasil'
                            ];
                            return response()->json($arr, 200);
                
    }
    public function showKasus($id)
    {
        $provinsi = Provinsi::findOrFail($id);
        $provinsi = DB::table('provinsis')
                    ->select('provinsis.nama_provinsi',
                    DB::raw('SUM(kasus2s.jpositif) as Positif'),
                    DB::raw('SUM(kasus2s.jsembuh) as Sembuh'),
                    DB::raw('SUM(kasus2s.jmeninggal) as Meninggal'))
                        ->join('kotas', 'provinsis.id', '=', 'kotas.id_provinsi')    
                        ->join('kecamatans', 'kotas.id', '=', 'kecamatans.id_kota')
                        ->join('kelurahans', 'kecamatans.id', '=', 'kelurahans.id_kecamatan')
                        ->join('rws', 'kelurahans.id', '=', 'rws.id_kelurahan')
                        ->join('kasus2s', 'rws.id', '=', 'kasus2s.id_rw')
                        ->where('provinsis.id', $id)
                        ->groupBy('provinsis.id')
                        ->get();
                    return response()->json($provinsi, 200);    

    }
    public function all()
    {
        $positif = DB::table('rws')
                   ->select('kasus2s.jpositif',
                   'kasus2s.jsembuh', 'kasus2s.jmeninggal')
                   ->join('kasus2s', 'rws.id', '=', 'kasus2s.id_rw')
                   ->sum('kasus2s.jpositif');
        $sembuh = DB::table('rws')
                   ->select('kasus2s.jsembuh',
                   'kasus2s.jpositif', 'kasus2s.jmeninggal')
                   ->join('kasus2s', 'rws.id', '=', 'kasus2s.id_rw')
                   ->sum('kasus2s.jsembuh');
        $meninggal = DB::table('rws')
                   ->select('kasus2s.jmeninggal',
                   'kasus2s.jsembuh', 'kasus2s.jpositif')
                   ->join('kasus2s', 'rws.id', '=', 'kasus2s.id_rw')
                   ->sum('kasus2s.jmeninggal');
        return response([
            'success' => true,
            'data' => 'Data Indonesia',
                      'Jumlah Positif' => $positif,
                      'Jumlah Sembuh' => $sembuh,
                      'Jumlah Meninggal' => $meninggal,
            'message' => 'Berhasil'
        ], 200);
    }

    public function kota()
    {
        $kota = DB::table('kotas')
                    ->select('kotas.nama_kota',
                    DB::raw('SUM(kasus2s.jpositif) as Positif'),
                    DB::raw('SUM(kasus2s.jsembuh) as Sembuh'),
                    DB::raw('SUM(kasus2s.jmeninggal) as Meninggal')) 
                        ->join('kecamatans', 'kotas.id', '=', 'kecamatans.id_kota')
                        ->join('kelurahans', 'kecamatans.id', '=', 'kelurahans.id_kecamatan')
                        ->join('rws', 'kelurahans.id', '=', 'rws.id_kelurahan')
                        ->join('kasus2s', 'rws.id', '=', 'kasus2s.id_rw')
                        ->groupBy('kotas.nama_kota')
                        ->get();

                        $kota2 = DB::table('kotas')
                        ->select('kotas.nama_kota',
                        DB::raw('SUM(kasus2s.jpositif) as Positif'),
                        DB::raw('SUM(kasus2s.jsembuh) as Sembuh'),
                        DB::raw('SUM(kasus2s.jmeninggal) as Meninggal'))  
                            ->join('kecamatans', 'kotas.id', '=', 'kecamatans.id_kota')
                            ->join('kelurahans', 'kecamatans.id', '=', 'kelurahans.id_kecamatan')
                            ->join('rws', 'kelurahans.id', '=', 'rws.id_kelurahan')
                            ->join('kasus2s', 'rws.id', '=', 'kasus2s.id_rw')
                            ->whereDate('kasus2s.tanggal', date('Y-m-d'))
                            ->groupBy('kotas.nama_kota')
                            ->get();
                            $arr = [
                                'status' => 200,
                                'data' => [     
                                'Hari Ini' =>[$kota2],
                                'Total' =>[$kota]
                                ],
                                'message' => 'Berhasil'
                            ];
                            return response()->json($arr, 200);
                
    }
    public function showKasusKota($id)
    {
        $kota = Kota::findOrFail($id);
        $kota = DB::table('kotas')
                    ->select('kotas.nama_kota',
                    DB::raw('SUM(kasus2s.jpositif) as Positif'),
                    DB::raw('SUM(kasus2s.jsembuh) as Sembuh'),
                    DB::raw('SUM(kasus2s.jmeninggal) as Meninggal'))  
                        ->join('kecamatans', 'kotas.id', '=', 'kecamatans.id_kota')
                        ->join('kelurahans', 'kecamatans.id', '=', 'kelurahans.id_kecamatan')
                        ->join('rws', 'kelurahans.id', '=', 'rws.id_kelurahan')
                        ->join('kasus2s', 'rws.id', '=', 'kasus2s.id_rw')
                        ->where('kotas.id', $id)
                        ->groupBy('kotas.nama_kota')
                        ->get();
                    return response()->json($kota, 200);    

    }

    public function kecamatan()
    {
        $kecamatan = DB::table('kecamatans')
                    ->select('kecamatans.nama_kecamatan',
                    DB::raw('SUM(kasus2s.jpositif) as Positif'),
                    DB::raw('SUM(kasus2s.jsembuh) as Sembuh'),
                    DB::raw('SUM(kasus2s.jmeninggal) as Meninggal')) 
                        ->join('kelurahans', 'kecamatans.id', '=', 'kelurahans.id_kecamatan')
                        ->join('rws', 'kelurahans.id', '=', 'rws.id_kelurahan')
                        ->join('kasus2s', 'rws.id', '=', 'kasus2s.id_rw')
                        ->groupBy('kecamatans.id')
                        ->get();

                        $kecamatan2 = DB::table('kecamatans')
                        ->select('kecamatans.nama_kecamatan',
                        DB::raw('SUM(kasus2s.jpositif) as Positif'),
                        DB::raw('SUM(kasus2s.jsembuh) as Sembuh'),
                        DB::raw('SUM(kasus2s.jmeninggal) as Meninggal'))  
                            ->join('kelurahans', 'kecamatans.id', '=', 'kelurahans.id_kecamatan')
                            ->join('rws', 'kelurahans.id', '=', 'rws.id_kelurahan')
                            ->join('kasus2s', 'rws.id', '=', 'kasus2s.id_rw')
                            ->whereDate('kasus2s.tanggal', date('Y-m-d'))
                            ->groupBy('kecamatans.id')
                            ->get();
                            $arr = [
                                'status' => 200,
                                'data' => [     
                                'Hari Ini' =>[$kecamatan2],
                                'Total' =>[$kecamatan]
                                ],
                                'message' => 'Berhasil'
                            ];
                            return response()->json($arr, 200);
                
    }
    public function showKasusKecamatan($id)
    {
        $kecamatan = Kecamatan::findOrFail($id);
        $kecamatan = DB::table('kecamatans')
                    ->select('kecamatans.nama_kecamatan',
                    DB::raw('SUM(kasus2s.jpositif) as Positif'),
                    DB::raw('SUM(kasus2s.jsembuh) as Sembuh'),
                    DB::raw('SUM(kasus2s.jmeninggal) as Meninggal'))  
                        ->join('kelurahans', 'kecamatans.id', '=', 'kelurahans.id_kecamatan')
                        ->join('rws', 'kelurahans.id', '=', 'rws.id_kelurahan')
                        ->join('kasus2s', 'rws.id', '=', 'kasus2s.id_rw')
                        ->where('kecamatans.id', $id)
                        ->groupBy('kecamatans.id')
                        ->get();
                    return response()->json($kecamatan, 200);    

    }

    public function kelurahan()
    {
        $kelurahan = DB::table('kelurahans')
                    ->select('kelurahans.nama_kelurahan',
                    DB::raw('SUM(kasus2s.jpositif) as Positif'),
                    DB::raw('SUM(kasus2s.jsembuh) as Sembuh'),
                    DB::raw('SUM(kasus2s.jmeninggal) as Meninggal')) 
                        ->join('kasus2s', 'rws.id', '=', 'kasus2s.id_rw')
                        ->groupBy('kelurahans.id')
                        ->get();

                        $kelurahan2 = DB::table('kelurahans')
                        ->select('kelurahans.nama_kelurahan',
                        DB::raw('SUM(kasus2s.jpositif) as Positif'),
                        DB::raw('SUM(kasus2s.jsembuh) as Sembuh'),
                        DB::raw('SUM(kasus2s.jmeninggal) as Meninggal'))  
                            ->join('rws', 'kelurahans.id', '=', 'rws.id_kelurahan')
                            ->join('kasus2s', 'rws.id', '=', 'kasus2s.id_rw')
                            ->whereDate('kasus2s.tanggal', date('Y-m-d'))
                            ->groupBy('kelurahans.id')
                            ->get();
                            $arr = [
                                'status' => 200,
                                'data' => [     
                                'Hari Ini' =>[$kelurahan2],
                                'Total' =>[$kelurahan]
                                ],
                                'message' => 'Berhasil'
                            ];
                            return response()->json($arr, 200);
                
    }
    public function showKasusKelurahan($id)
    {
        $kelurahan = Kelurahan::findOrFail($id);
        $kelurahan = DB::table('kelurahans')
                    ->select('kelurahans.nama_kelurahan',
                    DB::raw('SUM(kasus2s.jpositif) as Positif'),
                    DB::raw('SUM(kasus2s.jsembuh) as Sembuh'),
                    DB::raw('SUM(kasus2s.jmeninggal) as Meninggal'))  
                        ->join('rws', 'kelurahans.id', '=', 'rws.id_kelurahan')
                        ->join('kasus2s', 'rws.id', '=', 'kasus2s.id_rw')
                        ->where('kelurahans.id', $id)
                        ->groupBy('kelurahans.id')
                        ->get();
                    return response()->json($kecamatan, 200);    

    }

    public function rw()
    {
        $rw = DB::table('rws')
                    ->select('rws.nama',
                    DB::raw('SUM(kasus2s.jpositif) as Positif'),
                    DB::raw('SUM(kasus2s.jsembuh) as Sembuh'),
                    DB::raw('SUM(kasus2s.jmeninggal) as Meninggal')) 
                        ->join('kasus2s', 'rws.id', '=', 'kasus2s.id_rw')
                        ->groupBy('rws.id')
                        ->get();

                        $rw2 = DB::table('rws')
                        ->select('rws.nama',
                        DB::raw('SUM(kasus2s.jpositif) as Positif'),
                        DB::raw('SUM(kasus2s.jsembuh) as Sembuh'),
                        DB::raw('SUM(kasus2s.jmeninggal) as Meninggal'))  
                            ->join('kasus2s', 'rws.id', '=', 'kasus2s.id_rw')
                            ->whereDate('kasus2s.tanggal', date('Y-m-d'))
                            ->groupBy('rws.id')
                            ->get();
                            $arr = [
                                'status' => 200,
                                'data' => [     
                                'Hari Ini' =>[$rw2],
                                'Total' =>[$rw]
                                ],
                                'message' => 'Berhasil'
                            ];
                            return response()->json($arr, 200);
                
    }
    public function showKasusRw($id)
    {
        $rw = Rw::findOrFail($id);
        $rw = DB::table('rws')
                    ->select('rws.nama',
                    DB::raw('SUM(kasus2s.jpositif) as Positif'),
                    DB::raw('SUM(kasus2s.jsembuh) as Sembuh'),
                    DB::raw('SUM(kasus2s.jmeninggal) as Meninggal'))      
                        ->join('kasus2s', 'rws.id', '=', 'kasus2s.id_rw')
                        ->where('rws.id', $id)
                        ->groupBy('rws.id')
                        ->get();
                    return response()->json($rw, 200);    

    }
}

// DATA PERHARI
// public function hari() 
//     {
//         $kasus2 = Kasus2::get('created_at')->last();
//         $jpositif = Kasus2::where('tanggal', date('Y-m-d'))->sum('jpositif');
//         $jsembuh = Kasus2::where('tanggal', date('Y-m-d'))->sum('jsembuh');
//         $jmeninggal = Kasus2::where('tanggal', date('Y-m-d'))->sum('jmeninggal');

//         $join = DB::table('kasus2s')
//             ->select('jpositif', 'jsembuh', 'jmeninggal')
//             ->join('rws', 'kasus2s.id_rw', '=', 'rws.id')
//             ->get();

//         $arr1 = [
//                 'Data' => 'DATA KASUS SELURUH INDONESIA',
//                 'jpositif' => $join->sum('jpositif'),
//                 'jsembuh' => $join->sum('jsembuh'),
//                 'jmeninggal' => $join->sum('jmeninggal'),
//             ];
        
//         $arr2 = [
//             'Data' => 'DATA KASUS HARI INI',
//             'jpositif' => $jpositif,
//             'jsembuh' => $jsembuh,
//             'jmeninggal' => $jmeninggal,
//         ];
        
//         $arr = [
//             'Status'    => 200,
//             'Data'      => [ 
//                 'Hari Ini'  => $arr2,
//                 'Total'     => $arr1
//             ],
//             'message' => 'Berhasil'
       
//         ];
//         return response()->json($arr, 200);
//     }

//    //BERDASARKAN DATA API GLOBAL
//    public function global() 
//    {
//        $response = Http::get('https://api.kawalcorona.com/')->json();
//        $data = [
//            'Success'            => true,
//            'Data Api Global'   => $response,
//            'Message'           => 'Data Api Global Ditampilkan'        
//        ];
//        return response()->json($data, 200);
//    }

//    //BERDASARKAN DATA API GLOBAL (ID, NAMA NEGARA, POSITIF, NEGATIF, MENINGGAL)
//    public function global2() 
//    {        
//        $response = Http::get('https://api.kawalcorona.com/')->json();
//        $data = [];
//        foreach ($response as $key => $value) {
//            $ul = $value['attributes'];
//            $res = [
//                'id '=>$ul['OBJECTID'],
//                'Country'=>$ul['Country_Region'],
//                'Confirmed'=>$ul['Confirmed'],
//                'Deaths'=>$ul['Deaths'],
//                'Recovered'=>$ul['Recovered'],
//            ];
//            array_push($data,$res);

//        }
//        $response = [
//            'success' => true,
//            'country' =>$data,
//            'message'=> ' Data berhasil ditampilkan',
//        ];
//        return response()->json($response,200);

//     }
// }

//     /**
//      * Show the form for editing the specified resource.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function edit($id)
//     {
//         //
//     }

//     /**
//      * Update the specified resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function update(Request $request, $id)
//     {
//         //
//     }

//     /**
//      * Remove the specified resource from storage.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function destroy($id)
//     {
//         //
//     }
// }

