@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        @if (session('message'))
                <div class="alert alert-success" role="alert">
                {{ session('message') }}
                </div>
            @elseif(session('message1'))
                <div class="alert alert-danger" role="alert">
                {{ session('message1') }}
              s  </div>
            @endif
            <div class="card">
            <div class="card-header">{{ __('Data Kasus Local') }} 
                </div>
                <div class="card">
                <a href="{{route('kasus2.create')}}" class="btn btn-primary float-right"> Tambah Data </a>
                </div>

                <table id="example1" class="table table-bordered table-striped"> 
                            
                    <thead>
                    <tr class="bg-dark">
                         <th>No</th>      
                         <th>RW</th>
                         <th>Positif</th>
                         <th>Meninggal</th>
                         <th>Sembuh</th>
                         <th>Tanggal</th>
                         <th>Action</th>
                       </tr>  
                    </thead>
                    <tbody>
                         @php $no= 1; @endphp
                         @foreach($kasus2 as $data)
                            <tr>
                                <th scoppe="row">{{$no++}}</th>
                                <td>{{$data->rw->nama_rw}}</td>
                                <td class="text-center">{{$data->jpositif}}</td>
                                <td class="text-center">{{$data->jmeninggal}}</td>
                                <td class="text-center">{{$data->jsembuh}}</td>
                                <td class="text-center">{{$data->tanggal}}</td>
                                <td><form action="{{route('kasus2.destroy',$data->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{route('kasus2.show',$data->id)}}" class="btn btn-sm btn-success">Lihat</a> |
                                    <a href="{{route('kasus2.edit',$data->id)}}" class="btn btn-sm btn-warning">Edit</a> |
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda Yakin ?')">
                                     Delete
                                    </button>
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
</div>
</div>
@endsection