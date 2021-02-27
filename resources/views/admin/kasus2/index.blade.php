@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <center><b>{{ __('Data Kasus Local') }}</b></center>
                    </div>

                    <div class="card-body">
                        <a href="{{ route('kasus2.create') }}" class="btn btn-outline-success float-right"><b>Tambah
                                Data</b></a>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr class="bg-info">
                                    <th scope="col">No</th>
                                    <th scope="col">
                                        <center>Lokasi</center>
                                    </th>
                                    <th scope="col">
                                        <center>RW</center>
                                    </th>
                                    <th scope="col">
                                        <center>Positif</center>
                                    </th>
                                    <th scope="col">
                                        <center>Meninggal</center>
                                    </th>
                                    <th scope="col">
                                        <center>Sembuh</center>
                                    </th>
                                    <th scope="col">
                                        <center>Tanggal</center>
                                    </th>
                                    <th scope="col">
                                        <center>Action</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($kasus2 as $data)

                                    <tr>
                                        <th scope="row">
                                            <center>{{ $no++ }}</center>
                                        </th>
                                        <td>
                                            <center><b>Provinsi :
                                                    {{ $data->rw->kelurahan->kecamatan->kota->provinsi->nama_provinsi }}<br>
                                                    Kota : {{ $data->rw->kelurahan->kecamatan->kota->nama_kota }}<br>
                                                    Kecamatan : {{ $data->rw->kelurahan->kecamatan->nama_kecamatan }}<br>
                                                    Kelurahan : {{ $data->rw->kelurahan->nama_kelurahan }}<br></b>
                                            </center>
                                        </td>
                                        <td>
                                            <center>{{ $data->rw->nama_rw }}</center>
                                        </td>
                                        <td>
                                            <center>{{ $data->jpositif }}</center>
                                        </td>
                                        <td>
                                            <center>{{ $data->jmeninggal }}</center>
                                        </td>
                                        <td>
                                            <center>{{ $data->jsembuh }}</center>
                                        </td>
                                        <td>
                                            <center>{{ $data->tanggal }}</center>
                                        </td>

                                        <td style="text-align: center;">
                                            <form action="{{ route('kasus2.destroy', $data->id) }}" method="POST">
                                                @csrf
                                                @method("DELETE")
                                                <a href="{{ route('kasus2.edit', $data->id) }}"
                                                    class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                                <a href="{{ route('kasus2.show', $data->id) }}"
                                                    class="btn btn-warning btn-sm"><i class="fa fa-eye"></i></a>
                                                <button type="submit" class="btn btn-danger  btn-sm"
                                                    onclick="return confirm('Apakah anda yakin ?')"><a>HAPUS</a></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
