<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Penerbit - Admin Panel</title>
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
                <div class="bg-green-600 text-white px-6 py-4">
                    <h5 class="text-xl font-semibold flex items-center">
                        <i class="fas fa-edit mr-3"></i>Edit Penerbit
                    </h5>
                </div>
                <div class="p-6">
                    <form action="{{ route('publishers.update', $publisher->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="code" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-barcode mr-1"></i> ID Penerbit
                                </label>
                                <input type="text" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                       id="code" name="code" value="{{ old('code', $publisher->code) }}" placeholder="Masukkan ID penerbit" required>
                                @error('code')
                                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-phone mr-1"></i> Telepon
                                </label>
                                <input type="text" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                       id="phone" name="phone" value="{{ old('phone', $publisher->phone) }}" placeholder="Masukkan nomor telepon" required>
                                @error('phone')
                                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-building mr-1"></i> Nama Penerbit
                            </label>
                            <input type="text" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   id="name" name="name" value="{{ old('name', $publisher->name) }}" placeholder="Masukkan nama penerbit" required>
                            @error('name')
                                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-map-marker-alt mr-1"></i> Kota
                            </label>
                            <input type="text" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   id="city" name="city" value="{{ old('city', $publisher->city) }}" placeholder="Masukkan kota" required>
                            @error('city')
                                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                            <div class="mt-2">
                                <select class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                        onchange="document.getElementById('city').value = this.value;">
                                    <option value="">Pilih kota umum:</option>
                                    <option value="Jakarta">Jakarta</option>
                                    <option value="Surabaya">Surabaya</option>
                                    <option value="Bandung">Bandung</option>
                                    <option value="Medan">Medan</option>
                                    <option value="Semarang">Semarang</option>
                                    <option value="Makassar">Makassar</option>
                                    <option value="Palembang">Palembang</option>
                                    <option value="Tangerang">Tangerang</option>
                                    <option value="Depok">Depok</option>
                                    <option value="Bekasi">Bekasi</option>
                                    <option value="Bogor">Bogor</option>
                                    <option value="Batam">Batam</option>
                                    <option value="Pekanbaru">Pekanbaru</option>
                                    <option value="Bandar Lampung">Bandar Lampung</option>
                                    <option value="Malang">Malang</option>
                                    <option value="Yogyakarta">Yogyakarta</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-home mr-1"></i> Alamat Lengkap
                            </label>
                            <textarea class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                      id="address" name="address" rows="3" placeholder="Masukkan alamat lengkap" required>{{ old('address', $publisher->address) }}</textarea>
                            @error('address')
                                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="flex justify-between items-center">
                            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                                <i class="fas fa-arrow-left mr-2"></i> Kembali
                            </a>
                            <div class="space-x-3">
                                {{-- <a href="{{ route('publishers.index') }}" class="inline-flex items-center px-4 py-2 border border-blue-300 rounded-md text-blue-600 bg-blue-50 hover:bg-blue-100 transition-colors">
                                    <i class="fas fa-list mr-2"></i> Daftar Penerbit
                                </a> --}}
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
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
        // Format phone number (allow dashes)
        document.getElementById('phone').addEventListener('input', function(e) {
            let value = e.target.value;
            // Allow digits, dashes, and spaces
            value = value.replace(/[^\d\s-]/g, '');
            // Prevent consecutive dashes
            value = value.replace(/-{2,}/g, '-');
            // Prevent dash at start
            value = value.replace(/^-+/, '');
            e.target.value = value;
        });

        // Generate unique code based on publisher name
        document.getElementById('name').addEventListener('blur', function(e) {
            const name = e.target.value;
            if (name && !document.getElementById('code').value) {
                const code = name.toUpperCase()
                    .replace(/[^A-Z]/g, '')
                    .substring(0, 3);
                document.getElementById('code').value = code;
            }
        });
    </script>
</body>
</html>