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
                        <label for="" class="form-label">Jumlah Positif</label>
                        <input type="number" name="jpositif" class="form-control" id="">
                        @error('jpositif')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Jumlah Meninggal</label>
                        <input type="number" name="jmeninggal" class="form-control" id="">
                        @error('jmeninggal')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Jumlah Sembuh</label>
                        <input type="number" name="jsembuh" class="form-control" id="">
                        @error('jsembuh')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" id="">
                        @error('tanggal')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-outline-primary">Simpan</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection