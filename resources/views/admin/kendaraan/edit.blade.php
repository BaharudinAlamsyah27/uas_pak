@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Edit Kendaraan</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('kendaraan.index') }}">Kendaraan</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Update Data: {{ $kendaraan->merk }}</h4>

                <form action="{{ route('kendaraan.update', $kendaraan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <div class="form-group row mb-4">
                        <label class="col-sm-3 col-form-label">Merk Kendaraan</label>
                        <div class="col-sm-9">
                            <input type="text" name="merk" class="form-control" value="{{ old('merk', $kendaraan->merk) }}">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label class="col-sm-3 col-form-label">Plat Nomor</label>
                        <div class="col-sm-9">
                            <input type="text" name="plat_nomor" class="form-control" value="{{ old('plat_nomor', $kendaraan->plat_nomor) }}">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label class="col-sm-3 col-form-label">Harga Sewa</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="number" name="harga" class="form-control" value="{{ old('harga', $kendaraan->harga) }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                            <select name="status" class="form-control custom-select">
                                <option value="Tersedia" {{ $kendaraan->status == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                                <option value="Sedang Disewa" {{ $kendaraan->status == 'Sedang Disewa' ? 'selected' : '' }}>Sedang Disewa</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label class="col-sm-3 col-form-label">Deskripsi</label>
                        <div class="col-sm-9">
                            <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $kendaraan->deskripsi) }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label class="col-sm-3 col-form-label">Gambar Saat Ini</label>
                        <div class="col-sm-9">
                            @if($kendaraan->gambar)
                                <img src="{{ asset('storage/' . $kendaraan->gambar) }}" alt="img" class="img-thumbnail rounded" width="150">
                            @else
                                <span class="text-muted font-italic">Tidak ada gambar</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label class="col-sm-3 col-form-label">Ganti Gambar</label>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" name="gambar" class="custom-file-input" id="customFileEdit">
                                <label class="custom-file-label" for="customFileEdit">Pilih file baru jika ingin mengubah...</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-success w-md">Update Perubahan</button>
                            <a href="{{ route('kendaraan.index') }}" class="btn btn-secondary w-md ml-1">Batal</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection