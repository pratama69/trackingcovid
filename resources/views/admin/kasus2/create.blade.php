@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><center><b>{{ __('Data Kasus Local') }}</b></center></div>

                <div class="card-body">
                <form action="{{route('kasus2.store')}}" method="POST">
                @csrf
                <div class="col">
                <livewire:hallo>
                </div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
            
                <div class="mb-3">
                        <label for="" class="form-label">Rw</label>
                       <select name="id_rw" class="form-control" id="">
                       @foreach($rw as $data)
                       <option value="{{$data->id}}">{{$data->nama_rw}}</option>
                       @endforeach
                       </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Jumlah Positif</label>
                        <input type="number" name="jpositif" class="form-control" id="">
                        @if($errors->has('jpositif'))
                        <span class="text-danger">{{ $errors->first('jpositif')}}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Jumlah Meninggal</label>
                        <input type="number" name="jmeninggal" class="form-control" id="">
                        @if($errors->has('jmeninggal'))
                        <span class="text-danger">{{ $errors->first('jmeninggal')}}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Jumlah Sembuh</label>
                        <input type="number" name="jsembuh" class="form-control" id="">
                        @if($errors->has('jsembuh'))
                        <span class="text-danger">{{ $errors->first('jsembuh')}}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" id="">
                        @if($errors->has('tanggal'))
                        <span class="text-danger">{{ $errors->first('tanggal')}}</span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection