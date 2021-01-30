@extends('layouts.master')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header"><b>Tambah Data Kecamatan</b></div>
               <div class="card-body">
                  <form action="{{ route('kecamatan.store') }}" method="POST">
                  @csrf
                     <div class="form-group">
                        <label for="" class="form-label">Nama Kecamatan</label>
                        <input type="text" class="form-control" name="nama_kecamatan" required>
                     </div>
                     <div class="form-group">
                        <label for="" class="form-label">Nama Kota</label>
                        <select class="form-control" name="id_kota">
                           @foreach($kota as $data)
                              <option value="{{$data->id}}">{{$data->nama_kota}}</option>
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