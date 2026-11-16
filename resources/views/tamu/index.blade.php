@extends('layouts.app')

@section('judul', 'Tamu')

@section('isi')

    {{-- FORM TAMBAH --}}
    <div class="card mb-4">
        <div class="card-header fw-bold">Tambah Tamu</div>
        <div class="card-body">
            <form method="POST" action="{{ route('tamu.store') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" placeholder="Nama lengkap" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">No. Identitas (KTP/Paspor)</label>
                        <input type="text" name="no_identitas" class="form-control" value="{{ old('no_identitas') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">No. HP</label>
                        <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}" placeholder="0812xxxxxxx" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="nama@email.com">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
            </form>
        </div>
    </div>

    {{-- TABEL DATA --}}
    <div class="card">
        <div class="card-header fw-bold">Daftar Tamu</div>
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>No. Identitas</th>
                        <th>No. HP</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tamus as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->no_identitas }}</td>
                            <td>{{ $item->no_hp }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                <form method="POST" action="{{ route('tamu.destroy', $item->id) }}" class="d-inline"
                                      onsubmit="return confirm('Hapus tamu ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted py-4">Belum ada tamu.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
