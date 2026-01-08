@extends('layouts.admin') 

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Data Kendaraan</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                    <li class="breadcrumb-item active">Kendaraan</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="mdi mdi-check-all mr-2"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title">Daftar Armada</h4>
                    <a href="{{ route('kendaraan.create') }}" class="btn btn-primary waves-effect waves-light">
                        <i class="bx bx-plus font-size-16 align-middle mr-2"></i> Tambah Baru
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-centered table-nowrap table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 70px;">No.</th>
                                <th>Gambar</th>
                                <th>Merk & Plat</th>
                                <th>Harga Sewa</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kendaraan as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    @if($item->gambar)
                                        <img class="rounded" src="{{ asset('storage/' . $item->gambar) }}" alt="Header" height="50">
                                    @else
                                        <div class="avatar-xs">
                                            <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                {{ substr($item->merk, 0, 1) }}
                                            </span>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <h5 class="font-size-14 mb-1"><a href="#" class="text-dark">{{ $item->merk }}</a></h5>
                                    <p class="text-muted mb-0">{{ $item->plat_nomor }}</p>
                                </td>
                                <td>Rp {{ number_format($item->harga, 0, ',', '.') }} / hari</td>
                                <td>
                                    @if($item->status == 'Tersedia')
                                        <span class="badge badge-pill badge-soft-success font-size-12">Tersedia</span>
                                    @else
                                        <span class="badge badge-pill badge-soft-danger font-size-12">Disewa</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('kendaraan.edit', $item->id) }}" class="btn btn-outline-warning btn-sm" title="Edit">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>
                                    
                                    <form action="{{ route('kendaraan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" title="Hapus">
                                            <i class="mdi mdi-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="text-muted">Belum ada data kendaraan.</div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection