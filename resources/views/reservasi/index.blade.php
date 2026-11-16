@extends('layouts.app')

@section('judul', 'Daftar Reservasi')

@section('isi')

    {{-- Warna label untuk tiap status reservasi --}}
    @php
        $warna = ['booking' => 'primary', 'checkin' => 'warning', 'selesai' => 'success', 'batal' => 'secondary'];
    @endphp

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span class="fw-bold">Semua Reservasi</span>
            <a href="{{ route('reservasi.create') }}" class="btn btn-primary btn-sm">+ Reservasi Baru</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Tamu</th>
                        <th>Kamar</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Total Bayar</th>
                        <th>Status</th>
                        <th>Ubah Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reservasis as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->tamu->nama }}</td>
                            <td>{{ $item->kamar->nomor_kamar }} ({{ $item->kamar->tipeKamar->nama_tipe }})</td>
                            <td>{{ $item->tanggal_checkin }}</td>
                            <td>{{ $item->tanggal_checkout }}</td>
                            <td>Rp {{ number_format($item->total_bayar, 0, ',', '.') }}</td>
                            <td><span class="badge text-bg-{{ $warna[$item->status] ?? 'secondary' }}">{{ $item->status }}</span></td>
                            <td>
                                <form method="POST" action="{{ route('reservasi.update', $item->id) }}" class="d-flex gap-1">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="form-select form-select-sm w-auto">
                                        @foreach (['booking', 'checkin', 'selesai', 'batal'] as $s)
                                            <option value="{{ $s }}" {{ $item->status == $s ? 'selected' : '' }}>{{ $s }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-outline-primary btn-sm">OK</button>
                                </form>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('reservasi.destroy', $item->id) }}" class="d-inline"
                                      onsubmit="return confirm('Hapus reservasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="9" class="text-center text-muted py-4">Belum ada reservasi.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
