@extends('layouts.app')

@section('judul', 'Tipe Kamar')

@section('isi')

    {{-- FORM TAMBAH --}}
    <div class="card mb-4">
        <div class="card-header fw-bold">Tambah Tipe Kamar</div>
        <div class="card-body">
            <form method="POST" action="{{ route('tipe-kamar.store') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Tipe</label>
                        <input type="text" name="nama_tipe" class="form-control" value="{{ old('nama_tipe') }}" placeholder="Contoh: Deluxe" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Harga per Malam (Rp)</label>
                        <input type="number" name="harga_per_malam" class="form-control" value="{{ old('harga_per_malam') }}" placeholder="500000" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Fasilitas</label>
                        <textarea name="fasilitas" class="form-control" rows="3" placeholder="AC, TV, WiFi">{{ old('fasilitas') }}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
            </form>
        </div>
    </div>

    {{-- TABEL DATA --}}
    <div class="card">
        <div class="card-header fw-bold">Daftar Tipe Kamar</div>
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Tipe</th>
                        <th>Harga / Malam</th>
                        <th>Fasilitas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tipeKamars as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_tipe }}</td>
                            <td>Rp {{ number_format($item->harga_per_malam, 0, ',', '.') }}</td>
                            <td>{{ $item->fasilitas }}</td>
                            <td>
                                <form method="POST" action="{{ route('tipe-kamar.destroy', $item->id) }}" class="d-inline"
                                      onsubmit="return confirm('Hapus tipe kamar ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada data. Tambahkan tipe kamar di atas.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
