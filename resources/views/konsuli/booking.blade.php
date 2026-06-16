<!DOCTYPE html>
<html>
<head><title>Form Janji Temu</title>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
     <div class="container">
    <h2>Buat Janji Temu dengan: {{ $konselor->name }}</h2>
    <a href="{{ route('konsuli.dashboard') }}">Kembali</a>

    @if ($errors->any())
        <div style="background-color: #ffe6e6; color: red; border: 1px solid red; padding: 10px; margin-bottom: 15px;">
            <strong>Pengajuan Gagal:</strong>
            <ul style="margin-top: 5px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('konsuli.booking.store') }}" method="POST">
        @csrf
        <input type="hidden" name="konselor_id" value="{{ $konselor->id }}">

        <div style="margin-top: 10px;">
            <label>Pilih Tanggal:</label>
            <input type="date" name="tanggal_temu" required>
        </div>
        <div style="margin-top: 10px;">
            <label>Isi Keluhan:</label>
            <textarea name="keluhan" required></textarea>
        </div>
        <button type="submit" style="margin-top: 10px;">Kirim Pengajuan</button>
    </form>
    </div>
</body>
</html>