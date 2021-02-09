@extends('layouts.master')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header"><center><b>Data Kecamatan</b></center></div>
            <div class="card-body">
            <a href="{{route('kecamatan.create')}}" class="btn btn-outline-success float-right"><b>Tambah Data</b></a> 
            @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
            <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr class="bg-info">
                     <th>No</th>
                     <th>Nama Kecamatan</th>
                     <th>Nama Kota</th>
                     <th><center>Aksi</center></th>
                     </tr>
                  </thead>
                  <tbody>
                  @php $no = 1; @endphp
                     @foreach ($kecamatan as $data)
                        <tr>
                           <td align="center">{{ $no++ }}</td>
                           <td>{{ $data->nama_kecamatan }} </td>
                           <td>{{ $data->kota->nama_kota }} </td>
                           <td align="center">
                              <form action="{{route('kecamatan.destroy', $data->id)}}" method="post">
                              @csrf
                              @method("DELETE")
                              <a href="{{route('kecamatan.show',$data->id)}}"  class="btn btn-primary btn-sm">lihat</a>
                              <a href="{{route('kecamatan.edit',$data->id)}}"  class="btn btn-warning btn-sm">Edit</a>
                              <button type="sumbit" onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-sm">hapus</button>
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
