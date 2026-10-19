<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-semibold text-gray-800">
                Tambah Produk Baru
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Lengkapi informasi produk yang akan ditambahkan ke toko.
            </p>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gray-100 px-6 py-10 lg:px-9">

        @if ($errors->any())
            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
                <p class="mb-2 font-semibold">Periksa kembali data berikut:</p>
                <ul class="list-inside list-disc space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="w-full rounded-xl border border-gray-200 bg-white p-6 shadow-sm sm:p-8">
            <form action="{{ route('products.store') }}" method="POST">
                @csrf

                <div class="mb-7 border-b border-gray-100 pb-5">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Informasi Produk
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Masukkan kategori, identitas, harga, dan stok produk.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-x-8 gap-y-6 md:grid-cols-2">
                    {{-- Kategori --}}
                    <div>
                        <label for="category_id" class="mb-2 block text-sm font-medium text-gray-700">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <select name="category_id" id="category_id" required class="block w-full rounded-lg border-gray-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Pilih kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    {{-- Kode Produk --}}
                    <div>
                        <label for="code" class="mb-2 block text-sm font-medium text-gray-700">
                            Kode Produk <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="code" id="code" value="{{ old('code') }}" placeholder="Contoh: PRD001" required class="block w-full rounded-lg border-gray-300 px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('code') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    {{-- Nama Produk --}}
                    <div class="md:col-span-2">
                        <label for="name" class="mb-2 block text-sm font-medium text-gray-700">
                            Nama Produk <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Contoh: Minyak Goreng 1L" required class="block w-full rounded-lg border-gray-300 px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    {{-- Satuan --}}
                    <div>
                        <label for="unit" class="mb-2 block text-sm font-medium text-gray-700">
                            Satuan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="unit" id="unit" value="{{ old('unit', 'pcs') }}" placeholder="Contoh: pcs, kg, botol" required class="block w-full rounded-lg border-gray-300 px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('unit') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    {{-- Harga --}}
                    <div>
                        <label for="price" class="mb-2 block text-sm font-medium text-gray-700">
                            Harga (Rp) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="price" id="price" value="{{ old('price') }}" placeholder="Contoh: 15000" min="0" step="1" required class="block w-full rounded-lg border-gray-300 px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('price') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    {{-- Stok Awal --}}
                    <div>
                        <label for="stock" class="mb-2 block text-sm font-medium text-gray-700">
                            Stok Awal <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="stock" id="stock" value="{{ old('stock', 0) }}" placeholder="Masukkan jumlah stok" min="0" step="1" required class="block w-full rounded-lg border-gray-300 px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('stock') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="mt-8 flex flex-wrap items-center justify-end gap-3 border-t border-gray-100 pt-6">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-3 text-sm font-medium text-gray-700 transition hover:bg-gray-50">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>