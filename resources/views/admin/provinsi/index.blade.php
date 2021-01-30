@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><b>Data Provinsi</b></div>
                <div class="card">
                <a href="{{route('provinsi.create')}}" class="btn btn-primary float-right"> Tambah Data </a>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <table id="example1" class="table table-bordered table-striped"> 
                <thead>
                <tr class="bg-dark">
                <th><center>No</center></th>
                <th><center>Kode provinsi</center></th>
                <th><center>Nama provinsi</center></th>
                <th><center>Aksi</center></th>
                </tr>
            </thead>
            <tbody>
        @php  $no=1;  @endphp
        @foreach ($provinsi as $data)
                <tr>
                <th scope="row">{{ $no++}}</th>
                <td>{{$data->kode_provinsi}}</td>
                <td>{{$data->nama_provinsi}}</td>
                <td>
                    <form action="{{route('provinsi.destroy',$data->id)}}" method="post">
                        @csrf @method('delete')
                        <a href="{{route('provinsi.show',$data->id)}}" class="btn btn-sm btn-success">lihat</a>
                        <a href="{{route('provinsi.edit',$data->id)}}" class="btn btn-sm btn-warning">Edit</a>
                        <button type="sumbit" onclick="return confirm('Apakah anda yakin?')"class="btn btn-sm btn-danger">hapus</button>
                    </form>
                </td>
                </tr>

                @endforeach
            </body>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection