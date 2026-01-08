@extends('layouts.front')

@section('content')
<div class="container py-5">
    <h2>Riwayat Penyewaan Saya</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kendaraan</th>
                <th>Tgl Mulai</th>
                <th>Tgl Kembali</th>
                <th>Total Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rentals as $rental)
            <tr>
                <td>{{ $rental->kendaraan->nama ?? 'Kendaraan dihapus' }}</td>
                <td>{{ $rental->start_date }}</td>
                <td>{{ $rental->end_date }}</td>
                <td>Rp {{ number_format($rental->total_price) }}</td>
                <td>
                    <span class="badge bg-{{ $rental->status == 'active' ? 'warning' : 'success' }}">
                        {{ $rental->status }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection