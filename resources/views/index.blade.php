<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ulasan Bugis Water Park</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            margin: 0;
            padding: 0;
        }

        h1, h2 {
            text-align: center;
            color: #006994;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            padding: 20px 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        input, select, textarea, button {
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        button {
            background: #00aaff;
            color: white;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #0077aa;
        }

        .success {
            color: green;
            text-align: center;
            font-weight: bold;
        }

        .ulasan {
            margin-top: 20px;
        }

        .card {
            background: #f9fafb;
            padding: 15px;
            margin-bottom: 12px;
            border-radius: 10px;
            border: 1px solid #eee;
        }

        .card strong {
            color: #333;
        }

        .rating {
            color: #ffcc00;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Form Ulasan</h1>

        @if(session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        <form action="/ulasan" method="POST">
            @csrf
            <input type="text" name="nama" placeholder="Nama Anda" required>
            <input type="email" name="email" placeholder="Email (opsional)">
            <select name="rating" required>
                <option value="5">⭐⭐⭐⭐⭐ - Sangat Puas</option>
                <option value="4">⭐⭐⭐⭐ - Puas</option>
                <option value="3">⭐⭐⭐ - Cukup</option>
                <option value="2">⭐⭐ - Kurang</option>
                <option value="1">⭐ - Tidak Puas</option>
            </select>
            <textarea name="komentar" rows="4" placeholder="Tulis komentar Anda..." required></textarea>
            <button type="submit">Kirim Ulasan</button>
        </form>
    </div>

    <div class="container ulasan">
        <h2>Daftar Ulasan</h2>
        @foreach($ulasan as $u)
            <div class="card">
                <p><strong>{{ $u->nama }}</strong></p>
                <p class="rating">
                    {{ str_repeat("⭐", $u->rating) }}
                </p>
                <p>{{ $u->komentar }}</p>
            </div>
        @endforeach
    </div>
</body>
</html>
