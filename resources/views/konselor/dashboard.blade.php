<!DOCTYPE html>
<html>
<head><title>Dashboard Konselor</title>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
     <div class="container">
    <h2>Selamat Datang, {{ Auth::user()->name }} (Konselor)</h2>
    <form action="{{ route('logout') }}" method="POST">@csrf <button type="submit">Logout</button></form>

    @if(session('success')) <p style="color:green">{{ session('success') }}</p> @endif

    <h3>Daftar Pengajuan Janji Temu Masuk:</h3>
    <table border="1" cellpadding="8">
        <tr>
            <th>Nama Mahasiswa (Konsuli)</th>
            <th>Tanggal Pertemuan</th>
            <th>Keluhan</th>
            <th>Status Saat Ini</th>
            <th>Aksi</th>
        </tr>
        @forelse($appointments as $app)
        <tr>
            <td>{{ $app->konsuli->name }}</td>
            <td>{{ $app->tanggal_temu }}</td>
            <td>{{ $app->keluhan }}</td>
            <td><strong>{{ strtoupper($app->status) }}</strong></td>
            <td>
                @if($app->status == 'pending')
                    <form action="{{ route('konselor.update_status', [$app->id, 'accepted']) }}" method="POST" style="display:inline;">
                        @csrf <button type="submit" style="color:green">Terima</button>
                    </form>
                    <form action="{{ route('konselor.update_status', [$app->id, 'rejected']) }}" method="POST" style="display:inline;">
                        @csrf <button type="submit" style="color:red">Tolak</button>
                    </form>
                @else
                    Sudah Diproses
                @endif
            </td>
        </tr>
        @empty
        <tr><td colspan="5">Belum ada pengajuan janji temu.</td></tr>
        @endforelse
    </table>
    </div>
</body>
</html>