@extends('layouts.master')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header"><b>Edit Data Kota</b></div>
               <div class="card-body">
                  <form action="{{ route('kota.update', $kota->id) }}" method="POST">
                  @csrf
                  @method('PUT')
                     <div class="form-group">
                        <label for="" class="form-label">Kode Kota</label>
                        <input type="text" class="form-control" name="kode_kota" value="{{$kota->kode_kota}}" class="form-control" required>
                     </div>
                     <div class="form-group">
                        <label for="" class="form-label">Nama Kota</label>
                        <input type="text" class="form-control" name="nama_kota" value="{{$kota->nama_kota}}" class="form-control" required>
                     </div>
                     <div class="form-group">
                        <label for="" class="form-label">Nama Provinsi</label>
                        <select class="form-control" name="id_provinsi">
                        @foreach($provinsi as $data)
                        <option value="{{$data->id}}"
                           {{$data->id == $kota->id_provinsi ? "selected":""}}>{{$data->nama_provinsi}}</option>
                        @endforeach
                        </select>
                     </div>
                     <div class="form-group">
                     <button type="submit" class="btn btn-outline-dark">Simpan</button>
                        <button type="submit" class="btn btn-outline-secondary">Kembali</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection