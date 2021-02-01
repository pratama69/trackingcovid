@extends('layouts.master')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header"><b>Tambah Data Kelurahan</b></div>
               <div class="card-body">
                  <form action="{{ route('kelurahan.store') }}" method="POST">
                  @csrf
                     <div class="form-group">
                        <label for="" class="form-label">Nama Kelurahan</label>
                        <input type="text" class="form-control" name="nama_kelurahan" required>
                        @if($errors->has('nama_kelurahan'))
                        <span class="text-danger">{{ $errors->first('nama_kelurahan')}}</span>
                        @endif
                     </div>
                     <div class="form-group">
                        <label for="" class="form-label">Nama Kecamatan</label>
                        <select class="form-control" name="id_kecamatan">
                           @foreach($kecamatan as $data)
                              <option value="{{$data->id}}">{{$data->nama_kecamatan}}</option>
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