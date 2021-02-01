@extends('layouts.master')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header"><b>Tambah Data Rw</b></div>
               <div class="card-body">
                  <form action="{{ route('rw.store') }}" method="POST">
                  @csrf
                     <div class="form-group">
                        <label for="" class="form-label">Nama Rw</label>
                        <input type="text" class="form-control" name="nama_rw" required>
                        @if($errors->has('nama_rw'))
                        <span class="text-danger">{{ $errors->first('nama_rw')}}</span>
                        @endif
                     </div>
                     <div class="form-group">
                        <label for="" class="form-label">Nama Kelurahan</label>
                        <select class="form-control" name="id_kelurahan">
                           @foreach($kelurahan as $data)
                              <option value="{{$data->id}}">{{$data->nama_kelurahan}}</option>
                           @endforeach
                        </select>
                     </div>
                     <div class="form-group">
                     <button type="submit" class="btn btn-outline-primary">Tambah Data</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection