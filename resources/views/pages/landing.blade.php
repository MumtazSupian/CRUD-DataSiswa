@extends('layouts.layout')

@section('content-dinamis')
<style>
    .background {
        background-image: url({{ asset('images/assets/wk.jpg') }});
        background-repeat: no-repeat;
        background-position: center center;
        background-attachment: fixed;
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    h1, a {
        color: white;
    }

</style>

<div class="background">
    <h1 class="text-center">DATA SISWA</h1>
    <a href="{{ route('index_data.index') }}" class="btn btn-primary text-center">Lihat CRUD Disini</a>
</div>
@endsection
