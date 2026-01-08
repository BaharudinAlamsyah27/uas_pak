@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Kendaraan Baru</h4>
                <form action="{{ route('kendaraan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label>Merk Mobil</label>
                        <input type="text" name="merk" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Harga Sewa / Hari</label>
                        <input type="number" name="harga" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Plat Nomor</label>
                        <input type="text" name="plat_nomor" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Gambar Mobil</label>
                        <input type="file" name="gambar" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="tersedia">Tersedia</option>
                            <option value="disewa">Disewa</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                    <a href="{{ route('kendaraan.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection