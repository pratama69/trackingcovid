@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Show Provinsi</div>
                <div class="card-body"> 
                    <div class="form-group">
                        <label for="">Kode provinsi</label>
                        <input type="text" name="kode_provinsi" value="{{$provinsi->kode_provinsi}}" class="form-control" readonly>
                    </div> 
                    <div class="form-group">
                        <label for="">Nama provinsi</label>
                        <input type="text" name="nama_provinsi" value="{{$provinsi->nama_provinsi}}" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                    <a href="{{url()->previous()}}" class="btn btn-outline-secondary">kembali</a>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection