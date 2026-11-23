@extends('layouts.app')

@section('judul', 'Dashboard')

@section('isi')

    {{-- 4 kartu: jumlah data per tabel --}}
    <div class="row g-3">

        <div class="col-6 col-lg-3">
            <div class="card text-bg-primary h-100">
                <div class="card-body">
                    <div class="small">Tipe Kamar</div>
                    <div class="display-5 fw-bold">{{ $jumlah['tipe_kamar'] }}</div>
                </div>
                <a href="{{ route('tipe-kamar.index') }}" class="card-footer text-white text-decoration-none small">Lihat data &raquo;</a>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card text-bg-success h-100">
                <div class="card-body">
                    <div class="small">Kamar</div>
                    <div class="display-5 fw-bold">{{ $jumlah['kamar'] }}</div>
                </div>
                <a href="{{ route('kamar.index') }}" class="card-footer text-white text-decoration-none small">Lihat data &raquo;</a>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card text-bg-warning h-100">
                <div class="card-body">
                    <div class="small">Tamu</div>
                    <div class="display-5 fw-bold">{{ $jumlah['tamu'] }}</div>
                </div>
                <a href="{{ route('tamu.index') }}" class="card-footer text-dark text-decoration-none small">Lihat data &raquo;</a>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card text-bg-danger h-100">
                <div class="card-body">
                    <div class="small">Reservasi</div>
                    <div class="display-5 fw-bold">{{ $jumlah['reservasi'] }}</div>
                </div>
                <a href="{{ route('reservasi.index') }}" class="card-footer text-white text-decoration-none small">Lihat data &raquo;</a>
            </div>
        </div>

    </div>

@endsection
