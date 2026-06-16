<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Konsuli</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
     <div class="container">
    <h2>Selamat Datang, {{ Auth::user()->name }} (Konsuli)</h2>
    <form action="{{ route('logout') }}" method="POST">@csrf <button type="submit" class="btn-danger">Logout</button></form>
    
    @if(session('success')) 
        <p style="color:green; background-color: #e6ffe6; padding: 10px; border: 1px solid green;">
            {{ session('success') }}
        </p> 
    @endif

    <h3>Konselor tersedia:</h3>
    <table border="1" cellpadding="5" style="border-collapse: collapse; width: 50%;">
        <tr style="background-color: #f2f2f2;">
            <th>Nama Konselor</th>
            <th>Aksi</th>
        </tr>
        @foreach($konselor as $k)
        <tr>
            <td>{{ $k->name }}</td>
            <td>
                <a href="{{ route('konsuli.booking', $k->id) }}" class="btn">Pilih & Atur Janji</a>
            </td>
        </tr>
        @endforeach
    </table>

    <br><hr><br>

    <h3>Daftar Pengajuan Janji Temu Anda:</h3>
    <table border="1" cellpadding="8" style="border-collapse: collapse; width: 100%;">
        <tr style="background-color: #f2f2f2;">
            <th>Nama Konselor</th>
            <th>Tanggal Pertemuan</th>
            <th>Keluhan Anda</th>
            <th>Status Respon Dosen</th>
            <th>Aksi</th> 
        </tr>
        @forelse($riwayat_booking as $b)
        <tr>
            <td>{{ $b->konselor->name }}</td>
            <td>{{ $b->tanggal_temu }}</td>
            <td>{{ $b->keluhan }}</td>
            <td>
                @if($b->status == 'pending')
                    <span style="color: #d69e2e; font-weight: bold;">Menunggu</span>
                @elseif($b->status == 'accepted')
                    <span style="color: #38a169; font-weight: bold;">Disetujui</span>
                @elseif($b->status == 'rejected')
                    <span style="color: #e53e3e; font-weight: bold;">Ditolak</span>
                @endif
            </td>
            <td>
                @if($b->status == 'pending')
                    <form action="{{ route('konsuli.booking.destroy', $b->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE') 
                        <button type="submit" class="btn-danger" style="padding: 5px 10px; font-size: 12px;" onclick="return confirm('Yakin ingin membatalkan pengajuan ini?')">Batal</button>
                    </form>
                @else
                    <span style="color: gray;">-</span>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" style="text-align: center; color: gray;">Anda belum pernah membuat janji temu.</td>
        </tr>
        @endforelse
    </table>
</div>
</body>
</html>