<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sewa Kendaraan - {{ $kendaraan->merk }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Form Sewa Kendaraan</h4>
                </div>
                <div class="card-body">
                    
                    <div class="row mb-4">
                        <div class="col-md-5">
                            @if($kendaraan->gambar)
                                <img src="{{ asset('storage/' . $kendaraan->gambar) }}" class="img-fluid rounded" alt="Gambar Mobil">
                            @else
                                <img src="https://via.placeholder.com/300x200?text=No+Image" class="img-fluid rounded" alt="No Image">
                            @endif
                        </div>
                        <div class="col-md-7">
                            <h3>{{ $kendaraan->merk }}</h3>
                            <p class="text-muted">{{ $kendaraan->plat_nomor }}</p>
                            <h4 class="text-success">Rp {{ number_format($kendaraan->harga, 0, ',', '.') }} <small class="text-muted">/ hari</small></h4>
                            <p>{{ $kendaraan->deskripsi }}</p>
                        </div>
                    </div>

                    <hr>

                    <form action="{{ route('rental.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $kendaraan->id }}">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Tanggal Mulai Sewa</label>
                                <input type="date" name="start_date" class="form-control" required min="{{ date('Y-m-d') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Tanggal Kembali</label>
                                <input type="date" name="end_date" class="form-control" required>
                            </div>
                        </div>

                        <div class="alert alert-info small">
                            <i class="fas fa-info-circle"></i> Total harga akan dihitung otomatis oleh sistem setelah Anda klik "Konfirmasi Sewa".
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ url('/') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-success btn-lg">Konfirmasi Sewa</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>