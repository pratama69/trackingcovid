@extends('layouts.master')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header"><b>Edit Data Kelurahan</b></div>
               <div class="card-body">
                  <form action="{{ route('kelurahan.update', $kelurahan->id) }}" method="POST">
                  @csrf
                  @method('PUT')
                     <div class="form-group">
                        <label for="" class="form-label">Nama Kelurahan</label>
                        <input type="text" class="form-control" name="nama_kelurahan" value="{{$kelurahan->nama_kelurahan}}" class="form-control" required>
                     </div>
                     <div class="form-group">
                        <label for="" class="form-label">Nama Kecamatan</label>
                        <select class="form-control" name="id_kecamatan">
                        @foreach($kecamatan as $data)
                        <option value="{{$data->id}}"
                           {{$data->id == $kelurahan->id_kelurahan ? "selected":""}}>{{$data->nama_kecamatan}}</option>
                        @endforeach
                        </select>
                     </div>
                     <div class="form-group">
                        <button type="submit" class="btn btn-outline-secondary">Tambah Data</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection