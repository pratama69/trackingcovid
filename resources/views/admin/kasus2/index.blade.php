@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-16">
            <div class="card">
                <div class="card-header"><center><b>{{ __('Data Kasus Local') }}</b></center></div>

                <div class="card-body">
                <a href="{{route('kasus2.create')}}" class="btn btn-primary float-right"><b>Tambah Data</b></a>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table id="example1" class="table table-bordered table-striped"> 
                    <thead>
                    <tr class="bg-dark">
                        <th scope="col">No</th>
                        <th scope="col">Rw</th>
                        <th scope="col">Lokasi</th>
                        <th scope="col">Jumlah Positif</th>
                        <th scope="col">Jumlah Meninggal</th>
                        <th scope="col">Jumlah Sembuh</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @php $no = 1; @endphp
                    @foreach($kasus2 as $data)
                      <tr>
                        <th scope="row">{{$no++}}</th>
                        <td>{{$data->rw->nama_rw}}</td>
                        <td><center><b>Provinsi : {{$data->rw->kelurahan->kecamatan->kota->provinsi->nama_provinsi}}<br>
                                            Kota : {{$data->rw->kelurahan->kecamatan->kota->nama_kota}}<br>
                                            Kecamatan : {{$data->rw->kelurahan->kecamatan->nama_kecamatan}}<br>
                                            Kelurahan : {{$data->rw->kelurahan->nama_kelurahan}}<br></b>
                                           </center></td>
                        <td>{{$data->jpositif}}</td>
                        <td>{{$data->jmeninggal}}</td>
                        <td>{{$data->jsembuh}}</td>
                        <td>{{$data->tanggal}}</td>
                        <td>
                        <form action="{{route('kasus2.destroy', $data->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <a class="btn btn-success btn-sm" href="{{route('kasus2.show', $data->id)}}">show</a>|
                                <a class="btn btn-warning btn-sm" href="{{route('kasus2.edit', $data->id)}}">edit</a>|
                                <button type="submit" class="btn btn-danger  btn-sm" onclick="return confirm('Apakah anda yakin ?')"><a>delete</a></button>
                        </td>
                      </tr>
                          </form>
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection