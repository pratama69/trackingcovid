@extends('layouts.master')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-10">
         <div class="card">
            <div class="card-header"><center><b>Data Kelurahan</b></center></div>
            <div class="card-body">
            <a href="{{route('kelurahan.create')}}" class="btn btn-outline-success float-right"><b>Tambah Data</b></a>
            @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
            <div class="card-body">
            <table id="example1" class="table table-bordered table-striped"> 
                  <thead>
                  <tr class="bg-info">
                     <th><center>No</center></th>
                     <th><center>Nama Kelurahan</center></th>
                     <th><center>Nama Kecamatan</center></th>
                     <th><center>Aksi</center></th>
                     </tr>
                  </thead>
                  <tbody>
                  @php $no = 1; @endphp
                     @foreach ($kelurahan as $data)
                        <tr>
                           <td align="center">{{ $no++ }}</td>
                           <td>{{ $data->nama_kelurahan }} </td>
                           <td>{{ $data->kecamatan->nama_kecamatan }} </td>
                           <td align="center">
                              <form action="{{route('kelurahan.destroy', $data->id)}}" method="post">
                              @csrf
                              @method("DELETE")
                              <a href="{{route('kelurahan.show',$data->id)}}"  class="btn btn-primary btn-sm">lihat</a>
                              <a href="{{route('kelurahan.edit',$data->id)}}"  class="btn btn-warning btn-sm">Edit</a>
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
