<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Dashboard Admin</h1>

        

        @if(session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        <h2>Rata-rata Rating Per Bulan</h2>
        <ul>
            @foreach($ratingBulanan as $r)
                <li>{{ $r->bulan }}/{{ $r->tahun }} : ⭐ {{ number_format($r->rata_rating,1) }}</li>
            @endforeach
        </ul>

        <h2>Daftar Ulasan</h2>
        @foreach($ulasan as $u)
            <div class="review">
                <p>
                    <strong>{{ $u->nama }}</strong> ({{ $u->rating }}⭐)<br>
                    {{ $u->komentar }}
                </p>

                @if($u->balasan)
                    <p><strong>Balasan Admin:</strong> {{ $u->balasan }}</p>
                @endif

                <!-- Form Balas -->
                <form action="{{ route('admin.reply',$u->id) }}" method="POST">
                    @csrf
                    <textarea name="balasan" placeholder="Tulis balasan..."></textarea>
                    <button type="submit">Balas</button>
                </form>

                <!-- Tombol Hapus -->
                <form action="{{ route('admin.delete',$u->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin hapus ulasan ini?')">Hapus</button>
                </form>
            </div>
        @endforeach
    </div>
</body>
</html>
