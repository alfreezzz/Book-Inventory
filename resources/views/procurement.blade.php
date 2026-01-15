<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengadaan - Toko Buku</title>
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
                    <a href="/" class="text-gray-300 hover:bg-blue-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium flex items-center">
                        <i class="fas fa-home mr-1"></i>HOME
                    </a>
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-300 hover:bg-blue-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium flex items-center">
                        <i class="fas fa-cog mr-1"></i>ADMIN
                    </a>
                    <a href="/procurement" class="text-white bg-blue-700 px-3 py-2 rounded-md text-sm font-medium flex items-center">
                        <i class="fas fa-clipboard-list mr-1"></i>PENGADAAN
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 mt-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="text-center py-12 bg-gray-100 rounded-xl shadow-md">
                <h1 class="text-4xl font-bold text-yellow-600 mb-3">
                    <i class="fas fa-clipboard-list"></i> Laporan Pengadaan
                </h1>
                <p class="text-lg text-gray-700">Daftar buku yang perlu segera dibeli berdasarkan stok paling sedikit</p>
            </div>
        </div>

        <!-- Success Messages -->
        @if(session('status'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('status') }}
                </div>
                <button onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-800">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-red-500 text-white rounded-lg shadow-md p-6 text-center">
                <i class="fas fa-times-circle text-3xl mb-3"></i>
                <h5 class="text-lg font-semibold">Stok Habis</h5>
                <h3 class="text-2xl font-bold">{{ $books->where('stock', 0)->count() }}</h3>
            </div>
            <div class="bg-yellow-500 text-white rounded-lg shadow-md p-6 text-center">
                <i class="fas fa-exclamation-triangle text-3xl mb-3"></i>
                <h5 class="text-lg font-semibold">Stok Kritis (&lt;=5)</h5>
                <h3 class="text-2xl font-bold">{{ $books->where('stock', '>', 0)->where('stock', '<=', 5)->count() }}</h3>
            </div>
            <div class="bg-blue-500 text-white rounded-lg shadow-md p-6 text-center">
                <i class="fas fa-chart-line text-3xl mb-3"></i>
                <h5 class="text-lg font-semibold">Stok Rendah (&lt;=10)</h5>
                <h3 class="text-2xl font-bold">{{ $books->where('stock', '>', 5)->where('stock', '<=', 10)->count() }}</h3>
            </div>
            <div class="bg-green-500 text-white rounded-lg shadow-md p-6 text-center">
                <i class="fas fa-shopping-cart text-3xl mb-3"></i>
                <h5 class="text-lg font-semibold">Total Perlu Dibeli</h5>
                <h3 class="text-2xl font-bold">{{ $books->where('stock', '<=', 10)->count() }}</h3>
            </div>
        </div>

        <!-- Procurement List -->
        <div class="mb-8">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-yellow-500 text-gray-900 px-6 py-4 flex justify-between items-center">
                    <h5 class="text-xl font-semibold flex items-center">
                        <i class="fas fa-list mr-3"></i>Daftar Prioritas Pengadaan Buku
                    </h5>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Priority</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">ID Buku</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Judul Buku</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Kategori</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Penerbit</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Stok Saat Ini</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Harga</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($books as $index => $book)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($book->stock == 0)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    <i class="fas fa-exclamation mr-1"></i> URGENT
                                                </span>
                                            @elseif($book->stock <= 5)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    <i class="fas fa-exclamation-triangle mr-1"></i> HIGH
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    <i class="fas fa-info-circle mr-1"></i> MEDIUM
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $book->code }}</td>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $book->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                {{ $book->category }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $book->publisher ? $book->publisher->name : '-' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium @if($book->stock == 0) bg-red-100 text-red-800 @elseif($book->stock <= 5) bg-yellow-100 text-yellow-800 @else bg-blue-100 text-blue-800 @endif">
                                                {{ $book->stock }} buah
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp {{ number_format($book->price, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-sm">
                                            @if($book->stock == 0)
                                                <span class="text-red-600 font-medium">
                                                    <i class="fas fa-times mr-1"></i> Habis
                                                </span>
                                            @elseif($book->stock <= 5)
                                                <span class="text-yellow-600 font-medium">
                                                    <i class="fas fa-exclamation-triangle mr-1"></i> Kritis
                                                </span>
                                            @else
                                                <span class="text-blue-600 font-medium">
                                                    <i class="fas fa-exclamation-circle mr-1"></i> Rendah
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="px-6 py-12 text-center">
                                            <i class="fas fa-check-circle text-6xl text-green-500 mb-4"></i>
                                            <h5 class="text-xl font-semibold text-gray-900 mb-2">Semua Stok Aman!</h5>
                                            <p class="text-gray-600">Tidak ada buku yang perlu segera dibeli saat ini.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12 py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h5 class="text-lg font-semibold mb-2">Laporan Pengadaan - Toko Buku</h5>
                    <p class="text-gray-300">Sistem monitoring stok dan pengadaan buku otomatis</p>
                </div>
                <div class="text-right">
                    <p class="text-gray-300">&copy; {{ date('Y') }} Toko Buku. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script>

        // Auto-refresh every 5 minutes to get latest stock data
        setTimeout(() => {
            location.reload();
        }, 300000);
    </script>
</body>
</html>