@extends('layouts.master')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header"><b>Tambah Data Kota</b></div>
               <div class="card-body">
                  <form action="{{ route('kota.store') }}" method="POST">
                  @csrf
                     <div class="form-group">
                        <label for="" class="form-label">Kode Kota</label>
                        <input type="text" class="form-control" name="kode_kota" required>
                        @error('kode_kota'))
                          <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                     </div>
                     <div class="form-group">
                        <label for="" class="form-label">Nama Kota</label>
                        <input type="text" class="form-control" name="nama_kota" required>
                        @error('nama_kota'))
                          <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                     <div class="form-group">
                        <label for="" class="form-label">Nama Provinsi</label>
                        <select class="form-control" name="id_provinsi">
                           @foreach($provinsi as $data)
                              <option value="{{$data->id}}">{{$data->nama_provinsi}}</option>
                           @endforeach
                        </select>
                     </div>
                     <div class="form-group">
                     <button type="submit" class="btn btn-outline-primary">Simpan</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection