@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Data Provinsi</div>
                                
                    <form action="{{route('provinsi.update',$provinsi->id)}}" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    @csrf
                            <div class="form-group">
                                <label for="">Kode provinsi</label>
                                <input type="text" name="kode_provinsi" value="{{$provinsi->kode_provinsi}}" class="form-control" required>
                            </div> 
                            <div class="form-group">
                                <label for="">Nama provinsi</label>
                                <input type="text" name="nama_provinsi" value="{{$provinsi->nama_provinsi}}" class="form-control" required>
                            </div>
                            <div class="form-group">
                            <button type="submit" class="btn btn-primary">simpan</button>
                            <a href="{{url()->previous()}}" class="btn btn-outline-secondary">kembali</a>
                            </div>
                    </form>
                                

                 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection