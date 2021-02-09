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
                        <p>Tambah Data Kasus</p>
                    </div>
                    
                    <div class="card-body">
                    <form action="{{ route('kasus2.update', $kasus2->id) }}" method="POST">
                        <input type="hidden" name="_method" value="put">
                        @csrf
                            <div class="col">
                            <!-- @livewire('hallo',['selectedRw'=>$kasus2->id_rw,'selectedKelurahan'=>$kasus2->rw->id_kelurahan,'selectedKecamatan'=>$kasus2->rw->kelurahan->id_kecamatan,'selectedKota'=>$kasus2->rw->kelurahan->kecamatan->id_kota,'selectedProvinsi'=>$kasus2->rw->kelurahan->kecamatan->kota->id_provinsi]) -->
                            </div>                                             
                            
                                <center><h2><p>-- Data Kasus Local --</p></h2></center>
                            
                            <div class="form-group">
                                    <label for="">Jumlah Positif</label>
                                <input type="text"name="jpositif" class="form-control" id="exampleInputEmail1" value="{{ $kasus2->jpositif }}  ">
                                @if($errors->has('jpositif'))
                                    <span class="text-danger">{{ $errors->first('jpositif') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Jumlah Meninggal</label>
                                <input type="text" name="jmeninggal" class="form-control" id="exampleInputEmail1" value="{{ $kasus2->jmeninggal}} ">
                                @if($errors->has('jmeninggal'))
                                    <span class="text-danger">{{ $errors->first('jmeninggal') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Jumlah Sembuh</label>
                                <input type="text" name="jsembuh" class="form-control" id="exampleInputEmail1" value="{{ $kasus2->jsembuh }}  ">
                                @if($errors->has('jsembuh'))
                                    <span class="text-danger">{{ $errors->first('jsembuh') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" id="exampleInputEmail1" value="{{ $kasus2->tanggal }}" >
                            </div>
                            <a href="{{url()->previous()}}" class="btn btn-outline-dark">Kembali</a>
                            <div class="float-right">
                                <button type="simpan" class="btn btn-outline-secondary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection