@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Tambah Data Provinsi</div>
                            
                <form action="{{route('provinsi.store')}}" method="POST">
                @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">kode provinsi</label>
                            <input type="text" name="kode_provinsi" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @if($errors->has('kode_provinsi'))
                        <span class="text-danger">{{ $errors->first('kode_provinsi')}}</span>
                        @endif
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Provinsi</label>
                            <input type="text" name="nama_provinsi" class="form-control" id="exampleInputPassword1">
                            @if($errors->has('nama_provinsi'))
                        <span class="text-danger">{{ $errors->first('nama_provinsi')}}</span>
                        @endif
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
@endsection