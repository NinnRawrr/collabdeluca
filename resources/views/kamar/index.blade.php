@extends('layouts.app')

@section('judul', 'Kamar')

@section('isi')

    {{-- Warna label untuk tiap status kamar --}}
    @php
        $warna = ['tersedia' => 'success', 'terisi' => 'warning', 'perbaikan' => 'secondary'];
    @endphp

    {{-- FORM TAMBAH --}}
    <div class="card mb-4">
        <div class="card-header fw-bold">Tambah Kamar</div>
        <div class="card-body">
            <form method="POST" action="{{ route('kamar.store') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Tipe Kamar</label>
                        <select name="tipe_kamar_id" class="form-select" required>
                            <option value="">-- Pilih tipe --</option>
                            @foreach ($tipeKamars as $tipe)
                                <option value="{{ $tipe->id }}" {{ old('tipe_kamar_id') == $tipe->id ? 'selected' : '' }}>
                                    {{ $tipe->nama_tipe }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nomor Kamar (tidak boleh sama)</label>
                        <input type="text" name="nomor_kamar" class="form-control" value="{{ old('nomor_kamar') }}" placeholder="101" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Lantai</label>
                        <input type="number" name="lantai" class="form-control" value="{{ old('lantai') }}" placeholder="1" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="tersedia">tersedia</option>
                            <option value="terisi">terisi</option>
                            <option value="perbaikan">perbaikan</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
            </form>
        </div>
    </div>

    {{-- TABEL DATA --}}
    <div class="card">
        <div class="card-header fw-bold">Daftar Kamar</div>
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>No. Kamar</th>
                        <th>Tipe</th>
                        <th>Lantai</th>
                        <th>Status</th>
                        <th>Ubah Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kamars as $item)
                        <tr>
                            <td>{{ $item->nomor_kamar }}</td>
                            <td>{{ $item->tipeKamar->nama_tipe }}</td>
                            <td>{{ $item->lantai }}</td>
                            <td><span class="badge text-bg-{{ $warna[$item->status] ?? 'secondary' }}">{{ $item->status }}</span></td>
                            <td>
                                <form method="POST" action="{{ route('kamar.update', $item->id) }}" class="d-flex gap-1">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="form-select form-select-sm w-auto">
                                        @foreach (['tersedia', 'terisi', 'perbaikan'] as $s)
                                            <option value="{{ $s }}" {{ $item->status == $s ? 'selected' : '' }}>{{ $s }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-outline-primary btn-sm">OK</button>
                                </form>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('kamar.destroy', $item->id) }}" class="d-inline"
                                      onsubmit="return confirm('Hapus kamar ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted py-4">Belum ada kamar.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
