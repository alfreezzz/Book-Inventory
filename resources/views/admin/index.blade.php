<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Toko Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-blue-600 shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center text-white font-bold text-xl">
                    <i class="fas fa-cogs mr-2"></i>Admin Panel
                </a>

                <div class="flex space-x-6">
                    <a href="/" class="text-gray-300 hover:bg-blue-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium flex items-center">
                        <i class="fas fa-home mr-1"></i>HOME
                    </a>
                    <a href="{{ route('admin.dashboard') }}" class="text-white bg-blue-700 px-3 py-2 rounded-md text-sm font-medium flex items-center">
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
        <!-- Header -->
        <div class="mb-8">
            <div class="text-center py-12 bg-gray-100 rounded-xl shadow-md">
                <h1 class="text-4xl font-bold text-blue-600 mb-3">
                    <i class="fas fa-cogs"></i> Admin Panel
                </h1>
                <p class="text-lg text-gray-700">Kelola data buku dan penerbit</p>
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

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
            <a href="{{ route('books.create') }}" class="bg-blue-600 text-white rounded-lg p-4 text-center hover:bg-blue-700 transition-colors">
                <i class="fas fa-plus text-2xl mb-2"></i>
                <p class="font-semibold">Tambah Buku</p>
            </a>
            <a href="{{ route('publishers.create') }}" class="bg-green-600 text-white rounded-lg p-4 text-center hover:bg-green-700 transition-colors">
                <i class="fas fa-plus text-2xl mb-2"></i>
                <p class="font-semibold">Tambah Penerbit</p>
            </a>
        </div>

        <!-- Statistics Dashboard -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-blue-600 text-white rounded-lg shadow-md p-6 text-center">
                <i class="fas fa-book text-3xl mb-3"></i>
                <h5 class="text-lg font-semibold">Total Buku</h5>
                <h3 class="text-2xl font-bold">{{ App\Models\book::count() }}</h3>
            </div>
            <div class="bg-green-600 text-white rounded-lg shadow-md p-6 text-center">
                <i class="fas fa-building text-3xl mb-3"></i>
                <h5 class="text-lg font-semibold">Total Penerbit</h5>
                <h3 class="text-2xl font-bold">{{ App\Models\publisher::count() }}</h3>
            </div>
            <div class="bg-yellow-600 text-white rounded-lg shadow-md p-6 text-center">
                <i class="fas fa-exclamation-triangle text-3xl mb-3"></i>
                <h5 class="text-lg font-semibold">Stok Menipis</h5>
                <h3 class="text-2xl font-bold">{{ App\Models\book::where('stock', '<=', 5)->where('stock', '>', 0)->count() }}</h3>
            </div>
            <div class="bg-red-600 text-white rounded-lg shadow-md p-6 text-center">
                <i class="fas fa-times text-3xl mb-3"></i>
                <h5 class="text-lg font-semibold">Stok Habis</h5>
                <h3 class="text-2xl font-bold">{{ App\Models\book::where('stock', 0)->count() }}</h3>
            </div>
        </div>

        <!-- Books and Publishers Management -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Recent Books -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-blue-600 text-white px-6 py-4 flex justify-between items-center">
                    <h5 class="text-xl font-semibold flex items-center">
                        <i class="fas fa-book mr-3"></i>Data Buku
                    </h5>
                </div>
                <div class="p-6">
                    @php
                        $recentBooks = App\Models\book::with('publisher')->latest()->get();
                    @endphp
                    @if($recentBooks->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Id Buku</th>
                                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Buku</th>
                                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penerbit</th>
                                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($recentBooks as $book)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-3 py-2 text-sm text-gray-900">{{ $book->code }}</td>
                                            <td class="px-3 py-2 text-sm text-gray-900">{{ $book->category }}</td>
                                            <td class="px-3 py-2 text-sm text-gray-900">{{ Str::limit($book->title, 20) }}</td>
                                            <td class="px-3 py-2 text-sm text-gray-900">{{ $book->price }}</td>
                                            <td class="px-3 py-2">
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium @if($book->stock > 5) bg-green-100 text-green-800 @elseif($book->stock > 0) bg-yellow-100 text-yellow-800 @else bg-red-100 text-red-800 @endif">
                                                    {{ $book->stock }}
                                                </span>
                                            </td>
                                            <td class="px-3 py-2 text-sm text-gray-900">{{ $book->publisher ? Str::limit($book->publisher->name, 15) : '-' }}</td>
                                            <td class="px-3 py-2 text-sm">
                                                <div class="flex space-x-1">
                                                    <a href="{{ route('books.edit', $book->id) }}" class="text-yellow-600 hover:text-yellow-800 transition-colors" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-800 transition-colors" title="Hapus"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-lg text-center">
                            <i class="fas fa-info-circle mr-2"></i> Belum ada data buku
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Publishers -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-green-600 text-white px-6 py-4 flex justify-between items-center">
                    <h5 class="text-xl font-semibold flex items-center">
                        <i class="fas fa-building mr-3"></i>Data Penerbit
                    </h5>
                </div>
                <div class="p-6">
                    @php
                        $recentPublishers = App\Models\publisher::latest()->get();
                    @endphp
                    @if($recentPublishers->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Id Penerbit</th>
                                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Penerbit</th>
                                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat Penerbit</th>
                                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kota</th>
                                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telp</th>
                                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($recentPublishers as $publisher)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-3 py-2 text-sm text-gray-900">{{ $publisher->code }}</td>
                                            <td class="px-3 py-2 text-sm text-gray-900">{{ Str::limit($publisher->name, 20) }}</td>
                                            <td class="px-3 py-2 text-sm text-gray-900">{{ Str::limit($publisher->address, 20) }}</td>
                                            <td class="px-3 py-2 text-sm text-gray-900">{{ $publisher->city }}</td>
                                            <td class="px-3 py-2 text-sm text-gray-900">{{ $publisher->phone }}</td>
                                            <td class="px-3 py-2 text-sm">
                                                <div class="flex space-x-1">
                                                    <a href="{{ route('publishers.edit', $publisher->id) }}" class="text-yellow-600 hover:text-yellow-800 transition-colors" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('publishers.destroy', $publisher->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-800 transition-colors" title="Hapus"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus penerbit ini?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-center">
                            <i class="fas fa-info-circle mr-2"></i> Belum ada data penerbit
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Low Stock Alert -->
        @php
            $lowStockBooks = App\Models\book::with('publisher')->where('stock', '<=', 5)->where('stock', '>', 0)->limit(10)->get();
        @endphp
        @if($lowStockBooks->count() > 0)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                <div class="bg-yellow-500 text-gray-900 px-6 py-4">
                    <h5 class="text-xl font-semibold flex items-center">
                        <i class="fas fa-exclamation-triangle mr-3"></i>Peringatan Stok Menipis
                    </h5>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Buku</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penerbit</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok Saat Ini</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($lowStockBooks as $book)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $book->code }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $book->title }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $book->publisher ? $book->publisher->name : '-' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                {{ $book->stock }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <a href="/procurement" class="inline-flex items-center px-3 py-1 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                                                <i class="fas fa-shopping-cart mr-1"></i> Beli Sekarang
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        <!-- Out of Stock -->
        @php
            $outOfStockBooks = App\Models\book::with('publisher')->where('stock', 0)->limit(10)->get();
        @endphp
        @if($outOfStockBooks->count() > 0)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-red-600 text-white px-6 py-4">
                    <h5 class="text-xl font-semibold flex items-center">
                        <i class="fas fa-times-circle mr-3"></i>Buku Habis Stok
                    </h5>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Buku</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penerbit</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($outOfStockBooks as $book)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $book->code }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $book->title }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $book->publisher ? $book->publisher->name : '-' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                Habis
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <a href="/procurement" class="inline-flex items-center px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors">
                                                <i class="fas fa-exclamation mr-1"></i> Segera Pesan
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12 py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h5 class="text-lg font-semibold mb-2">Admin Panel - Toko Buku</h5>
                    <p class="text-gray-300">Sistem manajemen toko buku terintegrasi</p>
                </div>
                <div class="text-right">
                    <p class="text-gray-300">&copy; {{ date('Y') }} Toko Buku. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>