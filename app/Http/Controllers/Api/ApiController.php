<?php

namespace App\Http\Controllers\Api;
use App\Models\Kasus2;
use App\Models\Provinsi;
use App\Models\Kelurahan;
use App\Models\kecamatan;
use App\Models\RW;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    // DATA INDONESIA
public function index(){
    $positif = DB::table('rws')
                ->select('kasus2s.jpositif',
                'kasus2s.jsembuh', 'kasus2s.jmeninggal')
                ->join('kasus2s', 'rws.id', '=', 'kasus2s.id_rw')
                ->sum('kasus2s.jpositif');
    
    $sembuh = DB::table('rws')
                ->select('kasus2s.jpositif',
                'kasus2s.jsembuh', 'kasus2s.jmeninggal')
                ->join('kasus2s', 'rws.id', '=', 'kasus2s.id_rw')
                ->sum('kasus2s.jsembuh');

    $meninggal = DB::table('rws')
                ->select('kasus2s.jpositif',
                'kasus2s.jsembuh', 'kasus2s.jmeninggal')
                ->join('kasus2s', 'rws.id', '=', 'kasus2s.id_rw')
                ->sum('kasus2s.jmeninggal');


    $res = [
        'success' => true,
        'data' => 'Data Kasus Indonesia',
        'jpositif' => $positif,
        'jsembuh' => $sembuh,
        'jmeninggal' => $meninggal,
        'message' => 'Data Kasus Ditampilkan'
    ];
    return response()->json($res,200);
}

// DATA PROVINSI (ID)
  public function provinsi($id){
    $positif = DB::table('provinsis')
    ->join('kotas', 'kotas.id_provinsi', '=', 'provinsis.id')
    ->join('kecamatans', 'kecamatans.id_kota', '=', 'kotas.id')
    ->join('kelurahans', 'kelurahans.id_kecamatan', '=', 'kecamatans.id')
    ->join('rws', 'rws.id_kelurahan', '=', 'kelurahans.id')
    ->join('kasus2s', 'kasus2s.id_rw', '=', 'rws.id')
    ->select('kasus2s.jpositif')
    ->where('provinsis.id',$id)
    ->sum('kasus2s.jpositif');

     $sembuh = DB::table('provinsis')
     ->join('kotas', 'kotas.id_provinsi', '=', 'provinsis.id')
     ->join('kecamatans', 'kecamatans.id_kota', '=', 'kotas.id')
     ->join('kelurahans', 'kelurahans.id_kecamatan', '=', 'kecamatans.id')
     ->join('rws', 'rws.id_kelurahan', '=', 'kelurahans.id')
     ->join('kasus2s', 'kasus2s.id_rw', '=', 'rws.id')
     ->select('kasus2s.jsembuh')
     ->where('provinsis.id',$id)
     ->sum('kasus2s.jsembuh');

     $meninggal = DB::table('provinsis')
     ->join('kotas', 'kotas.id_provinsi', '=', 'provinsis.id')
     ->join('kecamatans', 'kecamatans.id_kota', '=', 'kotas.id')
     ->join('kelurahans', 'kelurahans.id_kecamatan', '=', 'kecamatans.id')
     ->join('rws', 'rws.id_kelurahan', '=', 'kelurahans.id')
     ->join('kasus2s', 'kasus2s.id_rw', '=', 'rws.id')
     ->select('kasus2s.jmeninggal')
     ->where('provinsis.id',$id)
     ->sum('kasus2s.jmeninggal');

     $provinsi = Provinsi::whereId($id)->first();

    $res = [
        'success' => true,
        'nama_provinsi' => $provinsi['nama_provinsi'],
        'jpositif' => $positif,
        'jsembuh' => $sembuh,
        'jmeninggal' => $meninggal,
        'message' => 'Data Berhasil DItampilkan'
    ];
    return response()->json($res, 200);
}

// DATA PROVINSI
public function provinsikasus(){
    $var = DB::table('provinsis')
    ->join('kotas', 'kotas.id_provinsi', '=', 'provinsis.id')
    ->join('kecamatans', 'kecamatans.id_kota', '=', 'kotas.id')
    ->join('kelurahans', 'kelurahans.id_kecamatan', '=', 'kecamatans.id')
    ->join('rws', 'rws.id_kelurahan', '=', 'kelurahans.id')
    ->join('kasus2s', 'kasus2s.id_rw', 'rws.id')
    ->select('nama_provinsi',
        DB::raw('sum(kasus2s.jpositif) as jPositif'),
        DB::raw('sum(kasus2s.jsembuh) as jsembuh'),
        DB::raw('sum(kasus2s.jmeninggal) as jmeninggal'),
    )
    ->groupBy('nama_provinsi')
    ->get();

$data = [
    'status' => true,
    'message' => 'Menampilkan Provinsi',
    'data' => $var,
];

return response()->json($data, 200);
}

// DATA KOTA
public function skota()
{
    $tampil = DB::table('kotas')
    ->join('kecamatans','kecamatans.id_kota','=','kotas.id')
    ->join('kelurahans','kelurahans.id_kecamatan','=','kecamatans.id')
    ->join('rws','rws.id_kelurahan','=','kelurahans.id')
    ->join('kasus2s','kasus2s.id_rw','=','rws.id')
    ->select('nama_kota','kode_kota',
    DB::raw('sum(kasus2s.jpositif) as jpositif'),
    DB::raw('sum(kasus2s.jsembuh) as jsembuh'),
    DB::raw('sum(kasus2s.jmeninggal) as jmeninggal'))
    ->groupBy('nama_kota','kode_kota')
    ->get();

    $data = [
        'success' => true,
        'Data Provinsi' => $tampil,
        'message' => 'Data Kasus Di tampilkan'
    ];
return response()->json($data,200);

}

public function kotaId($id) {
        
    $positif = DB::table('kotas')
            ->join('kecamatans','kecamatans.id_kota','=','kotas.id')
            ->join('kelurahans','kelurahans.id_kecamatan','=','kecamatans.id')
            ->join('rws','rws.id_kelurahan','=','kelurahans.id')
            ->join('kasus2s','kasus2s.id_rw','=','rws.id')
            ->select('kasus2s.jpositif')
            ->where('kotas.id', $id)
            ->sum('kasus2s.jpositif');

    $sembuh = DB::table('kotas')
            ->join('kecamatans','kecamatans.id_kota','=','kotas.id')
            ->join('kelurahans','kelurahans.id_kecamatan','=','kecamatans.id')
            ->join('rws','rws.id_kelurahan','=','kelurahans.id')
            ->join('kasus2s','kasus2s.id_rw','=','rws.id')
            ->select('kasus2s.jsembuh')
            ->where('kotas.id', $id)
            ->sum('kasus2s.jsembuh');

    $meninggal = DB::table('kotas')
            ->join('kecamatans','kecamatans.id_kota','=','kotas.id')
            ->join('kelurahans','kelurahans.id_kecamatan','=','kecamatans.id')
            ->join('rws','rws.id_kelurahan','=','kelurahans.id')
            ->join('kasus2s','kasus2s.id_rw','=','rws.id')
            ->select('kasus2s.jmeninggal')
            ->where('kotas.id', $id)
            ->sum('kasus2s.jmeninggal');

    $kota = Kota::findOrFail($id);

    $data = [
        'success'           => true,
        'Kota'          => $kota['nama_kota'],
        'Jumlah Positif'    => $positif,
        'Jumlah Sembuh'     => $sembuh,
        'Jumlah Meninggal'  => $meninggal,
        'message'           => 'Data Kasus Ditampilkan'
    ];

    return response()->json($data,200);

}

// DATA KECAMATAN
public function skecamatan()
    {
        $tampil = DB::table('kecamatans')
        ->join('kelurahans','kelurahans.id_kecamatan','=','kecamatans.id')
        ->join('rws','rws.id_kelurahan','=','kelurahans.id')
        ->join('kasus2s','kasus2s.id_rw','=','rws.id')
        ->select('nama_kecamatan',
        DB::raw('sum(kasus2s.jpositif) as jpositif'),
        DB::raw('sum(kasus2s.jsembuh) as jsembuh'),
        DB::raw('sum(kasus2s.jmeninggal) as jmeninggal'))
        ->groupBy('nama_kecamatan')
        ->get();

        $data = [
            'success' => true,
            'Data Provinsi' => $tampil,
            'message' => 'Data Kasus Di tampilkan'
        ];
return response()->json($data,200);

    }

// DATA KELURAHAN
    public function kelurahan(){
    
        $kelurahan = DB::table('kelurahans')
        ->join('rws', 'rws.id_kelurahan', '=', 'kelurahans.id')
        ->join('kasus2s', 'kasus2s.id_rw', 'rws.id')
        ->select( 'nama_kelurahan',
               DB::raw('sum(kasus2s.jpositif) as jpositif'),
               DB::raw('sum(kasus2s.jsembuh) as jsembuh'),
               DB::raw('sum(kasus2s.jmeninggal) as jmeninggal'),
           )
       ->groupBy('nama_kelurahan')
       ->get();
    
    $data = [
    'status' => true,
    'Data Kota' => $kelurahan,
    'message' => 'Menampilkan kelurahan',
    ];
    
    return response()->json($data, 200);
    
    }

// DATA RW
public function rw()
    { 
        $data = DB::table('rws')
        ->join('kasus2s','kasus2s.id_rw', '=', 'rws.id')
        ->select('rws.nama_rw',
        DB::raw('sum(kasus2s.jpositif) as jpositif'),
        DB::raw('sum(kasus2s.jmeninggal) as jmeninggal'),
        DB::raw('sum(kasus2s.jsembuh) as jsembuh'))
        ->groupBy('nama_rw')
        ->get();
                $res = [
                    'succsess' => true,
                    'Data' => $data,
                    'message' => 'Data Kasus Di Tampilkan'
                ];
                return response()->json($res,200);
    }

// DATA PERHARI
public function hari() 
    {
        $kasus2 = Kasus2::get('created_at')->last();
        $jpositif = Kasus2::where('tanggal', date('Y-m-d'))->sum('jpositif');
        $jsembuh = Kasus2::where('tanggal', date('Y-m-d'))->sum('jsembuh');
        $jmeninggal = Kasus2::where('tanggal', date('Y-m-d'))->sum('jmeninggal');

        $join = DB::table('kasus2s')
            ->select('jpositif', 'jsembuh', 'jmeninggal')
            ->join('rws', 'kasus2s.id_rw', '=', 'rws.id')
            ->get();

        $arr1 = [
                'Data' => 'DATA KASUS SELURUH INDONESIA',
                'jpositif' => $join->sum('jpositif'),
                'jsembuh' => $join->sum('jsembuh'),
                'jmeninggal' => $join->sum('jmeninggal'),
            ];
        
        $arr2 = [
            'Data' => 'DATA KASUS HARI INI',
            'jpositif' => $jpositif,
            'jsembuh' => $jsembuh,
            'jmeninggal' => $jmeninggal,
        ];
        
        $arr = [
            'Status'    => 200,
            'Data'      => [ 
                'Hari Ini'  => $arr2,
                'Total'     => $arr1
            ],
            'message' => 'Berhasil'
       
        ];
        return response()->json($arr, 200);
    }

   //BERDASARKAN DATA API GLOBAL
   public function global() 
   {
       $response = Http::get('https://api.kawalcorona.com/')->json();
       $data = [
           'Success'            => true,
           'Data Api Global'   => $response,
           'Message'           => 'Data Api Global Ditampilkan'        
       ];
       return response()->json($data, 200);
   }

   //BERDASARKAN DATA API GLOBAL (ID, NAMA NEGARA, POSITIF, NEGATIF, MENINGGAL)
   public function global2() 
   {        
       $response = Http::get('https://api.kawalcorona.com/')->json();
       $data = [];
       foreach ($response as $key => $value) {
           $ul = $value['attributes'];
           $res = [
               'id '=>$ul['OBJECTID'],
               'Country'=>$ul['Country_Region'],
               'Confirmed'=>$ul['Confirmed'],
               'Deaths'=>$ul['Deaths'],
               'Recovered'=>$ul['Recovered'],
           ];
           array_push($data,$res);

       }
       $response = [
           'success' => true,
           'country' =>$data,
           'message'=> ' Data berhasil ditampilkan',
       ];
       return response()->json($response,200);

    }
}

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

