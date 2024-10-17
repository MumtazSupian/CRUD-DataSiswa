@extends('layouts.layout')

@section('content-dinamis')


<form action="{{ route('index_data.proses') }}" class="card p-5" method="POST">
    @csrf
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (Session::get('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    <div class="mb-3 row">
        <label for="nama" class="col-sm-2 col-form-label">Nama Siswa: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama')}}" required>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="nis" class="col-sm-2 col-form-label">NIS: </label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="nis" name="nis" value="{{ old('nis')}}" required>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="rayon" class="col-sm-2 col-form-label">Rayon: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="rayon" name="rayon" value="{{ old('rayon')}}" required>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="rombel" class="col-sm-2 col-form-label">Rombel: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="rombel" name="rombel" value="{{ old('rombel')}}" required>
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Kirim</button>
</form>
@endsection
