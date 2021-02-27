@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <center><b>{{ __('Data Kasus Local') }}</b></center>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Nama Provinsi</label>
                            <input type="text" name="nama_provinsi" class="form-control" id="exampleInputPassword1"
                                value="{{ $kasus2->rw->kelurahan->kecamatan->kota->provinsi->nama_provinsi }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Kota / Kabupaten</label>
                            <input type="text" name="nama_kota" class="form-control" id="exampleInputPassword1"
                                value="{{ $kasus2->rw->kelurahan->kecamatan->kota->nama_kota }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Kecamatan</label>
                            <input type="text" name="nama_kecamatan" class="form-control" id="exampleInputPassword1"
                                value="{{ $kasus2->rw->kelurahan->kecamatan->nama_kecamatan }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Kelurahan</label>
                            <input type="text" name="nama_kelurahan" class="form-control" id="exampleInputPassword1"
                                value="{{ $kasus2->rw->kelurahan->nama_kelurahan }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Jumlah Positif</label>
                            <input type="text" name="jpositif" class="form-control" id="exampleInputPassword1"
                                value="{{ $kasus2->jpositif }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Jumlah Meninggal</label>
                            <input type="text" name="jmeninggal" class="form-control" id="exampleInputPassword1"
                                value="{{ $kasus2->jmeninggal }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Jumlah Positif</label>
                            <input type="text" name="jsembuh" class="form-control" id="exampleInputPassword1"
                                value="{{ $kasus2->jsembuh }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" id="exampleInputEmail1"
                                value="{{ $kasus2->tanggal }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
