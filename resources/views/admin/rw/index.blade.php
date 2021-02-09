@extends('layouts.master')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header"><center><b>Data Rw</b></center></div>
            <div class="card-body">
            <a href="{{route('rw.create')}}" class="btn btn-outline-success float-right"><b>Tambah Data</b></a>    
            @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif            
            <div class="card-body">
            <table class="table table-bordered" id="datatable">
                  <thead>
                  <tr class="bg-info">
                     <th>No</th>
                     <th>Nama Rw</th>
                     <th>Nama Kelurahan</th>
                     <th><center>Aksi</center></th>
                     </tr>
                  </thead>
                  <tbody>
                  @php $no = 1; @endphp
                     @foreach ($rw as $data)
                        <tr>
                           <td align="center">{{ $no++ }}</td>
                           <td>{{ $data->nama_rw }} </td>
                           <td>{{ $data->kelurahan->nama_kelurahan }} </td>
                           <td align="center">
                              <form action="{{route('rw.destroy', $data->id)}}" method="post">
                              @csrf
                              @method("DELETE")
                              <a href="{{route('rw.show',$data->id)}}" class="btn btn-primary btn-sm">lihat</a>
                              <a href="{{route('rw.edit',$data->id)}}" class="btn btn-warning btn-sm">Edit</a>
                              <button type="sumbit" onclick="return confirm('Apakah anda yakin?')"class="btn btn-danger btn-sm">hapus</button>
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
