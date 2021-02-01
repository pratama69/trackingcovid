@extends('layouts.master')
@section('css')
<!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
@endsection
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
@section('js')
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>

<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
@endsection