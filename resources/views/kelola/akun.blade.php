@extends('layouts.layout')

{{-- masukin yield --}}
@section('content-dinamis')
    <div class="container mt-5">
        <div class="d-flex justify-content-end">
            <form class="d-flex me-3" action="" method="GET">
                @csrf
                <input type="text" name="cari" placeholder="Cari Nama Siswa..." class="form-control me-2">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
            <a href="{{ route('kelola_akun.create') }}" class="btn btn-success">Tambah Siswa</a>
        </div>
        @if(Session::get('success'))
            <div class="alert alert-success mt-2">
                {{ Session::get('success') }}
            </div>
        @endif
        <table class="table table-stripped table-bordered mt-3 text-center">
            <thead>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                @foreach($users as $index => $item)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $item['nama'] }}</td>
                        <td>{{ $item['email'] }}</td>
                        <td>{{ $item['role'] }}</td>
                        <td class="d-flex justify-content-center">
                            <a href="{{ route('kelola_akun.edit', $item['id'])}}" class="btn btn-primary me-2">Edit</a>
                            <button class="btn btn-danger" onclick="showModalDelete('{{ $item->id }}', '{{ $item->name }}')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
{{-- @endsection --}}

 {{-- MODAL --}}
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <form class="modal-content" method="POST" action="">
        {{-- action kosong, diisi melalui js karna id dikirim ke js nya --}}
        @csrf
        {{-- menimpa method="POST" jadi DELETE sesuai web.php http-method --}}
        @method('DELETE')
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">HAPUS DATA PENGGUNA</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {{-- konten dinamis pada teks ini bagian nama, sehingga nama disediakan tempat penyimpanan (tag b) --}}
            Apakah Anda Yakin Ingin Menghapus Data Pengguna <b id="nama"></b>?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-danger">Hapus</button>
        </div>
    </form>
    </div>
</div>
</div>
@endsection

@push('script')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    function showModalDelete(id,nama) {
        // memasukkan teks dari parameter ke html bagian id="nama"
        $("#nama").text(nama);
        // memanggil route hapus
        let url = "{{ route('kelola_akun.delete', ':id') }}";
        // isi path dinamis :id dari data parameter id
        url = url.replace(':id', id);
        // action="" di form diisi dengan url diatas
        $("form").attr("action", url);
        // memunculkan modal dengan id="exampleModal"
        $("#exampleModal").modal('show');
        }
    </script>
@endpush
