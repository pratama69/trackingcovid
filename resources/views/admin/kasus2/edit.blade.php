@extends('layouts.master')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header"><center><b>{{ __ ('Data Kasus Lokal') }}</b></center></div>
               <div class="card-body">
                  <form action="{{ route('kasus2.update', $kasus2->id) }}" method="POST">
                  <input type="hidden" name="_method" value="PUT">
                  @csrf
                      @if (session('status')) 
                          <div class="alert alert-success" role="alert">
                               {{ session('status') }}
                          </div>
                      @endif

                 <div class="mb-3">
                        <label for="" class="form-label">Rw</label>
                        <select name="id_rw" class="form-control" id="">
                        @foreach($rw as $data)
                        <option value="{{$data->id}}" {{ $data->id == $kasus2->id_rw ? 'selected' : ''}} > {{$data->nama_rw}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Jumlah Positif</label>
                        <input type="number" name="jpositif" value="{{$kasus2->jpositif}}" class="form-control" id="">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Jumlah Meninggal</label>
                        <input type="number" name="jmeninggal" value="{{$kasus2->jmeninggal}}" class="form-control" id="">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Jumlah Sembuh</label>
                        <input type="number" name="jsembuh" value="{{$kasus2->jsembuh}}" class="form-control" id="">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" value="{{$kasus2->tanggal}}" class="form-control" id="">
                    </div>
                    <button type="submit" class="btn btn-outline-primary">Tambah Data</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection