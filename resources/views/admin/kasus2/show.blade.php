@extends('layouts.master')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header"><center><b>{{ __ ('Data Kasus Lokal') }}</b></center></div>
            
               <div class="card-body">
                      @if (session('status')) 
                          <div class="alert alert-success" role="alert">
                               {{ session('status') }}
                          </div>
                      @endif

                 <div class="mb-3">
                        <label for="" class="form-label">Rw</label>
                        <input type="text" name="nama_rw" value="{{$kasus2->rw->nama_rw}}" class="form-control" id="">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Jumlah Positif</label>
                        <input type="text" name="jpositif" value="{{$kasus2->jpositif}}" class="form-control" id="">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Jumlah Meninggal</label>
                        <input type="text" name="jmeninggal" value="{{$kasus2->jmeninggal}}" class="form-control" id="">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Jumlah Sembuh</label>
                        <input type="text" name="jsembuh" value="{{$kasus2->jsembuh}}" class="form-control" id="">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" value="{{$kasus2->tanggal}}" class="form-control" id="">
                    </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection