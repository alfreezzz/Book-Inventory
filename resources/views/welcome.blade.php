<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Buku - Beranda</title>
    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-blue-600 shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <a href="/" class="flex items-center text-white font-bold text-xl">
                    <i class="fas fa-book mr-2"></i>Toko Buku
                </a>

                <div class="flex space-x-6">
                    <a href="/" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium flex items-center">
                        <i class="fas fa-home mr-1"></i>HOME
                    </a>
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-300 hover:bg-blue-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium flex items-center">
                        <i class="fas fa-cog mr-1"></i>ADMIN
                    </a>
                    <a href="/procurement" class="text-gray-300 hover:bg-blue-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium flex items-center">
                        <i class="fas fa-clipboard-list mr-1"></i>PENGADAAN
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 mt-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="text-center py-12 bg-gray-100 rounded-xl shadow-md">
                <h1 class="text-4xl font-bold text-blue-600 mb-3">
                    <i class="fas fa-book-open"></i> Toko Buku
                </h1>
                <p class="text-lg text-gray-700">Temukan buku favorit Anda di toko kami</p>
            </div>
        </div>

        <!-- Search Section -->
        <div class="mb-8">
            <div class="max-w-2xl mx-auto">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h5 class="text-lg font-semibold mb-4 flex items-center">
                        <i class="fas fa-search mr-2"></i> Cari Buku
                    </h5>
                    <form method="GET" action="{{ url('/') }}">
                        <div class="flex">
                            <input type="text"
                                   class="flex-1 border border-gray-300 rounded-l-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   name="name"
                                   placeholder="Masukkan nama buku..."
                                   value="{{ request('name') }}">
                            <button class="bg-blue-600 text-white px-6 py-2 rounded-r-md hover:bg-blue-700 transition-colors">
                                <i class="fas fa-search mr-2"></i> Cari
                            </button>
                        </div>
                    </form>
                    @if(request('name'))
                        <div class="mt-3">
                            <span class="text-sm text-gray-600">
                                Menampilkan hasil pencarian untuk: <strong>{{ request('name') }}</strong>
                                <a href="/" class="ml-2 text-blue-600 hover:text-blue-800 text-decoration-none">
                                    <i class="fas fa-times"></i> Hapus
                                </a>
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Books Section -->
        <div class="mb-8">
            <h3 class="text-2xl font-bold mb-6 flex items-center">
                <i class="fas fa-books mr-3"></i> Daftar Buku
                @if(request('name'))
                    <span class="text-sm text-gray-500 ml-2">({{ $books->count() }} hasil ditemukan)</span>
                @endif
            </h3>

            @if($books->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @forelse($books as $book)
                        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                            <div class="p-6 flex flex-col h-full">
                                <h6 class="font-semibold text-blue-600 mb-3">{{ $book->title }}</h6>

                                <div class="text-gray-600 text-sm mb-2">
                                    <i class="fas fa-barcode mr-1"></i> {{ $book->code }}
                                </div>
                                <div class="text-gray-600 text-sm mb-2">
                                    <i class="fas fa-tag mr-1"></i> {{ $book->category }}
                                </div>
                                <div class="text-gray-600 text-sm mb-4">
                                    <i class="fas fa-building mr-1"></i> {{ $book->publisher ? $book->publisher->name : '-' }}
                                </div>

                                <div class="mt-auto">
                                    <div class="flex justify-between items-center mb-3">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Stok: {{ $book->stock }}
                                        </span>
                                        <span class="font-bold text-blue-600">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full">
                            <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-lg text-center">
                                <i class="fas fa-info-circle mr-2"></i> Tidak ada buku yang ditemukan untuk kata kunci "{{ request('name') }}"
                            </div>
                        </div>
                    @endforelse
                </div>
            @else
                <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-lg text-center">
                    <i class="fas fa-info-circle mr-2"></i>
                    @if(request('name'))
                        Tidak ada buku yang ditemukan untuk kata kunci "{{ request('name') }}"
                    @else
                        Belum ada data buku di sistem.
                    @endif
                </div>
            @endif
        </div>

        <!-- Statistics Section -->
        @if(!$books->isEmpty())
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-blue-500 text-white rounded-lg shadow-md p-6 text-center">
                    <i class="fas fa-book text-3xl mb-3"></i>
                    <h5 class="text-lg font-semibold">Total Buku</h5>
                    <h3 class="text-2xl font-bold">{{ $books->count() }}</h3>
                </div>
                <div class="bg-green-500 text-white rounded-lg shadow-md p-6 text-center">
                    <i class="fas fa-check text-3xl mb-3"></i>
                    <h5 class="text-lg font-semibold">Buku Tersedia</h5>
                    <h3 class="text-2xl font-bold">{{ $books->where('stock', '>', 0)->count() }}</h3>
                </div>
                <div class="bg-yellow-500 text-white rounded-lg shadow-md p-6 text-center">
                    <i class="fas fa-exclamation text-3xl mb-3"></i>
                    <h5 class="text-lg font-semibold">Buku Habis</h5>
                    <h3 class="text-2xl font-bold">{{ $books->where('stock', 0)->count() }}</h3>
                </div>
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12 py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h5 class="text-lg font-semibold mb-2">Toko Buku</h5>
                    <p class="text-gray-300">Sistem informasi manajemen toko buku modern</p>
                </div>
                <div class="text-right">
                    <p class="text-gray-300">&copy; {{ date('Y') }} Toko Buku. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Alpine.js untuk interaktivitas (opsional) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>