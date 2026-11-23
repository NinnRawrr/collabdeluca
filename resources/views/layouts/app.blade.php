<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('judul') - Hotel</title>

    {{-- Bootstrap 5 (diambil dari internet lewat CDN, tidak perlu install apa-apa) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    {{-- MENU ATAS --}}
    <nav class="navbar navbar-expand-md navbar-dark bg-primary mb-4">
        <div class="container">

            <a class="navbar-brand" href="{{ route('reservasi.index') }}">🏨 Hotel Kita</a>

            <a class="navbar-brand" href="{{ route('dashboard') }}">🏨 Hotel Kita</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuUtama">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menuUtama">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('tipe-kamar.*') ? 'active' : '' }}"
                            href="{{ route('tipe-kamar.index') }}">Tipe Kamar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('kamar.*') ? 'active' : '' }}"
                            href="{{ route('kamar.index') }}">Kamar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('tamu.*') ? 'active' : '' }}"
                            href="{{ route('tamu.index') }}">Tamu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('reservasi.*') ? 'active' : '' }}"
                            href="{{ route('reservasi.index') }}">Reservasi</a>
                    </li>
                </ul>
                <a class="btn btn-light btn-sm" href="{{ route('reservasi.create') }}">+ Reservasi Baru</a>
            </div>
        </div>
    </nav>

    {{-- ISI HALAMAN --}}
    <div class="container pb-5">
        <h1 class="h3 mb-4">@yield('judul')</h1>

        {{-- Pesan berhasil (dikirim dari controller dengan ->with('sukses', '...')) --}}
        @if (session('sukses'))
            <div class="alert alert-success">{{ session('sukses') }}</div>
        @endif

        {{-- Pesan error --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $pesan)
                        <li>{{ $pesan }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('isi')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
