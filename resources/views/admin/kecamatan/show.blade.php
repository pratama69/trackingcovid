@extends('layouts.master')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header"><b>Show Data Kecamatan</b></div>
               <div class="card-body">
                  <form>
                     <div class="form-group">
                        <label for="" class="form-label">Nama Kecamatan</label>
                        <input type="text" class="form-control" name="nama_kecamatan" value="{{$kecamatan->nama_kecamatan}}" readonly>
                     </div>
                     <div class="form-group">
                        <label for="" class="form-label">Nama Kota</label>
                        <input type="text" name="id_kota" class="form-control" value="{{$kecamatan->kota->nama_kota}}" readonly>
                     </div>
                     <div class="form-group">
                        <a href="{{ route('kecamatan.index') }}" type="submit" class="btn btn-outline-secondary">Kembali</a>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection