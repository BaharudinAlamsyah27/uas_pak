@extends('admin.dashboard') {{-- Menggunakan dashboard sebagai layout utama --}}

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="header-title">Daftar Armada Kendaraan</h4>
                        <a href="{{ route('kendaraan.create') }}" class="btn btn-primary">Tambah Mobil</a>
                    </div>
                    
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Gambar</th>
                                <th>Merk</th>
                                <th>Plat Nomor</th>
                                <th>Harga/Hari</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kendaraans as $k)
                            <tr>
                                <td><img src="{{ asset($k->gambar) }}" width="100"></td>
                                <td>{{ $k->merk }}</td>
                                <td>{{ $k->plat_nomor }}</td>
                                <td>Rp {{ number_format($k->harga) }}</td>
                                <td>
                                    <span class="badge {{ $k->status == 'tersedia' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $k->status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('kendaraan.edit', $k->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('kendaraan.destroy', $k->id) }}" method="POST" style="display:inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus?')">Hapus</button>
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