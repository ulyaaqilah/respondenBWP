<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Pengelolaan Ulasan</title>
    <!-- Memuat Tailwind CSS untuk styling modern dan responsif -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Menggunakan font Inter dan warna latar belakang yang lembut, mirip dengan halaman login */
        body {
            font-family: 'Inter', sans-serif;
            /* Warna latar belakang gradien teal lembut */
            background: #e0f2f1;
            background-image: linear-gradient(135deg, #e0f2f1 0%, #b2dfdb 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            padding: 2rem 1rem;
        }
    </style>
    <script>
        // Konfigurasi Tailwind untuk mendefinisikan warna aksen
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'accent': '#14b8a6', /* Teal 600 */
                    }
                }
            }
        }
    </script>
</head>
<body>
    <!-- Kontainer utama dashboard: di tengah, lebar maksimum 4xl, latar belakang putih/transparan -->
    <div class="w-full max-w-4xl bg-white/95 backdrop-blur-sm p-6 md:p-10 rounded-2xl shadow-2xl">
        
        <!-- Header Dashboard -->
        <header class="mb-8 pb-4 border-b border-gray-200">
            <h1 class="text-3xl font-extrabold text-teal-800 tracking-tight">
                Dashboard Admin
            </h1>
            <p class="text-gray-500 mt-1">Pengelolaan Ulasan Pengunjung</p>
        </header>

        <!-- Pesan Sukses (Menggunakan sintaks Blade) -->
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg" role="alert">
                <p class="font-bold">Berhasil!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif
        
        <!-- Statistik Rating -->
        <section class="mb-10">
            <h2 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Rata-rata Rating Per Bulan</h2>
            
            <!-- Mengubah daftar <ul> menjadi layout grid card yang responsif -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($ratingBulanan as $r)
                    <div class="bg-teal-50 p-4 rounded-xl shadow-md text-center hover:shadow-lg transition duration-200">
                        <p class="text-sm text-gray-500 font-medium">{{ $r->bulan }}/{{ $r->tahun }}</p>
                        <p class="text-2xl font-bold text-teal-600 mt-1">
                             ⭐ {{ number_format($r->rata_rating,1) }}
                        </p>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Daftar Ulasan -->
        <section>
            <h2 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Daftar Ulasan</h2>
            
            @foreach($ulasan as $u)
                <!-- Card Ulasan Utama -->
                <div class="p-5 bg-gray-50 rounded-xl shadow-lg mb-6 
                    @if($u->balasan) border-l-4 border-teal-600 @else border-l-4 border-gray-300 @endif">

                    <div class="flex justify-between items-start mb-3">
                        <!-- Nama & Rating -->
                        <p class="font-bold text-gray-800 text-lg">
                            {{ $u->nama }} 
                            <span class="
                                @if($u->rating >= 4) text-teal-600 
                                @elseif($u->rating == 3) text-orange-500 
                                @else text-red-500 @endif
                                font-normal
                            ">({{ $u->rating }}⭐)</span>
                        </p>
                        <!-- Tambahkan Tanggal Ulasan jika ada field-nya di $u->tanggal -->
                        <!-- <span class="text-sm text-gray-400">{{ $u->tanggal }}</span> -->
                    </div>
                    
                    <!-- Komentar Pengguna -->
                    <p class="text-gray-600 mb-4 italic p-2 border-l-2 border-gray-200">
                        {{ $u->komentar }}
                    </p>

                    <!-- Balasan Admin (Ditampilkan jika sudah ada) -->
                    @if($u->balasan)
                        <div class="bg-teal-100 p-3 rounded-lg mt-4 mb-4 border-l-4 border-teal-500">
                            <p class="font-semibold text-teal-800 mb-1">Balasan Admin:</p>
                            <p class="text-teal-700">{{ $u->balasan }}</p>
                        </div>
                    @endif

                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-end gap-3">
                        
                        <!-- Form Balas (Ditampilkan jika belum ada balasan, atau jika ingin mengedit balasan) -->
                        <form action="{{ route('admin.reply',$u->id) }}" method="POST" class="w-full sm:w-2/3">
                            @csrf
                            <textarea name="balasan" 
                                      placeholder="{{ $u->balasan ? 'Ubah balasan admin...' : 'Tulis balasan admin...' }}"
                                      rows="2"
                                      class="w-full p-3 border border-gray-300 rounded-lg focus:ring-accent focus:border-accent resize-none transition duration-150 text-sm">{{ $u->balasan }}</textarea>
                            <button type="submit" 
                                    class="mt-2 px-4 py-2 bg-teal-600 text-white font-semibold rounded-lg text-sm hover:bg-teal-700 transition duration-300 shadow-md shadow-teal-300">
                                {{ $u->balasan ? 'Perbarui Balasan' : 'Balas Ulasan' }}
                            </button>
                        </form>

                        <!-- Tombol Hapus -->
                        <form action="{{ route('admin.delete',$u->id) }}" method="POST" class="sm:w-auto">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-full sm:w-auto mt-2 px-4 py-2 bg-red-100 text-red-600 font-semibold rounded-lg text-sm hover:bg-red-200 transition duration-300"
                                    onclick="return confirm('Yakin hapus ulasan ini?')">
                                Hapus Ulasan
                            </button>
                        </form>
                    </div>

                </div>
            @endforeach
            
        </section>
        
    </div>
</body>
</html>
