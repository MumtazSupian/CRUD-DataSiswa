@extends('layouts.layout')

@section('content-dinamis')

<form action="{{ route('kelola_akun.update', $user->id) }}" class="card p-5" method="POST">
    @csrf
    @method('PATCH')
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
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $user->nama }}" required>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="email" class="col-sm-2 col-form-label">Email: </label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="role" class="col-sm-2 col-form-label">Role: </label>
        <div class="col-sm-10">
            <select class="form-select" name="role" id="role">
                <option selected disabled hidden>Pilih Role</option>
                <option value="admin" {{ $user->role == "admin" ? 'selected' : '' }}>Admin</option>
                <option value="siswa" {{ $user->role == "siswa" ? 'selected' : '' }}>Siswa</option>
            </select>
        </div>
    </div>

    <div class="mb-3 row">
        <label for="password" class="col-sm-2 col-form-label">Password: </label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="password" name="password" value="">
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Kirim</button>
</form>
@endsection
