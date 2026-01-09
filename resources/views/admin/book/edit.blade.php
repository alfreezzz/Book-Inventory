<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku - Admin Panel</title>
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
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-blue-600 text-white px-6 py-4">
                    <h5 class="text-xl font-semibold flex items-center">
                        <i class="fas fa-edit mr-3"></i>Edit Buku
                    </h5>
                </div>
                <div class="p-6">
                    <form action="{{ route('books.update', $book->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="code" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-barcode mr-1"></i> ID Buku
                                </label>
                                <input type="text" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       id="code" name="code" value="{{ old('code', $book->code) }}" placeholder="Masukkan ID buku" required>
                                @error('code')
                                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-tag mr-1"></i> Kategori
                                </label>
                                <select class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        id="category" name="category" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="Keilmuan" {{ old('category', $book->category) == 'Keilmuan' ? 'selected' : '' }}>Keilmuan</option>
                                    <option value="Bisnis" {{ old('category', $book->category) == 'Bisnis' ? 'selected' : '' }}>Bisnis</option>
                                    <option value="Novel" {{ old('category', $book->category) == 'Novel' ? 'selected' : '' }}>Novel</option>
                                </select>
                                @error('category')
                                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-book mr-1"></i> Judul Buku
                            </label>
                            <input type="text" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   id="title" name="title" value="{{ old('title', $book->title) }}" placeholder="Masukkan judul buku" required>
                            @error('title')
                                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-money-bill-wave mr-1"></i> Harga (Rp)
                                </label>
                                <input type="number" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       id="price" name="price" value="{{ old('price', $book->price) }}" placeholder="Masukkan harga" min="0" step="100" required>
                                @error('price')
                                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="stock" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-boxes mr-1"></i> Stok
                                </label>
                                <input type="number" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       id="stock" name="stock" value="{{ old('stock', $book->stock) }}" placeholder="Masukkan jumlah stok" min="0" required>
                                @error('stock')
                                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="publisher_id" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-building mr-1"></i> Penerbit
                            </label>
                            <select class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    id="publisher_id" name="publisher_id" required>
                                <option value="">Pilih Penerbit</option>
                                @foreach($publishers ?? [] as $publisher)
                                    <option value="{{ $publisher->id }}"
                                            {{ old('publisher_id', $book->publisher_id) == $publisher->id ? 'selected' : '' }}>
                                        {{ $publisher->name }} - {{ $publisher->city ?? '' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('publisher_id')
                                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                            <div class="mt-2 text-sm text-gray-600">
                                Belum ada penerbit?
                                <a href="{{ route('publishers.create') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                    <i class="fas fa-plus"></i> Tambah Penerbit Baru
                                </a>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                                <i class="fas fa-arrow-left mr-2"></i> Kembali
                            </a>
                            <div class="space-x-3">
                                <a href="{{ route('books.index') }}" class="inline-flex items-center px-4 py-2 border border-blue-300 rounded-md text-blue-600 bg-blue-50 hover:bg-blue-100 transition-colors">
                                    <i class="fas fa-list mr-2"></i> Daftar Buku
                                </a>
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                                    <i class="fas fa-save mr-2"></i> Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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

    <script>
        // Format harga saat mengetik
        document.getElementById('price').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value) {
                value = parseInt(value);
            }
        });
    </script>
</body>
</html>