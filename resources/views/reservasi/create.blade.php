@extends('layouts.app')

@section('judul', 'Form Reservasi Baru')

@section('isi')

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('reservasi.store') }}">
                @csrf
                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Tamu</label>
                        <select name="tamu_id" class="form-select" required>
                            <option value="">-- Pilih tamu --</option>
                            @foreach ($tamu as $tamu)
                                <option value="{{ $tamu->id }}" {{ old('tamu_id') == $tamu->id ? 'selected' : '' }}>
                                    {{ $tamu->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Kamar</label>
                        {{-- $kamars sudah difilter di controller: hanya kamar berstatus "tersedia" --}}
                        <select name="kamar_id" id="kamar" class="form-select" required>
                            <option value="">-- Pilih kamar --</option>
                            @foreach ($kamar as $kamar)
                                <option value="{{ $kamar->id }}" data-harga="{{ $kamar->tipeKamar->harga_per_malam }}"
                                    {{ old('kamar_id') == $kamar->id ? 'selected' : '' }}>
                                    {{ $kamar->nomor_kamar }} - {{ $kamar->tipeKamar->nama_tipe }}
                                    (Rp {{ number_format($kamar->tipeKamar->harga_per_malam, 0, ',', '.') }}/malam)
                                </option>
                            @endforeach
                        </select>
                        <div class="form-text">Hanya menampilkan kamar dengan status <b>tersedia</b>.</div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Tanggal Check-in</label>
                        <input type="date" name="tanggal_checkin" id="checkin" class="form-control" value="{{ old('tanggal_checkin') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Check-out</label>
                        <input type="date" name="tanggal_checkout" id="checkout" class="form-control" value="{{ old('tanggal_checkout') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Total Bayar (dihitung otomatis)</label>
                        <input type="text" id="total" class="form-control bg-light" value="Rp 0" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="booking">booking</option>
                            <option value="checkin">checkin</option>
                            <option value="selesai">selesai</option>
                            <option value="batal">batal</option>
                        </select>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary mt-4">Simpan Reservasi</button>
                <a href="{{ route('reservasi.index') }}" class="btn btn-outline-secondary mt-4">Batal</a>
            </form>
        </div>
    </div>

    {{-- Script kecil untuk menghitung total bayar = jumlah malam x harga kamar --}}
    <script>
        function hitungTotal() {
            var kamar    = document.getElementById('kamar').selectedOptions[0];
            var harga    = kamar ? kamar.dataset.harga : 0;
            var checkin  = new Date(document.getElementById('checkin').value);
            var checkout = new Date(document.getElementById('checkout').value);
            var malam    = (checkout - checkin) / 86400000;
            var total    = (harga && malam > 0) ? harga * malam : 0;
            document.getElementById('total').value = 'Rp ' + total.toLocaleString('id-ID');
        }
        document.getElementById('kamar').addEventListener('change', hitungTotal);
        document.getElementById('checkin').addEventListener('change', hitungTotal);
        document.getElementById('checkout').addEventListener('change', hitungTotal);
    </script>

@endsection
