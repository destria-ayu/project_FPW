<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Data Produk
            </h2>
            <a href="{{ route('products.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm transition shadow-sm">
                + Tambah Produk
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">

                    @if (session('success'))
                        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-md text-sm border border-green-200">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="w-full border-collapse">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <!-- Kolom 1: Kode (Rata Kiri) -->
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="text-align: left;">Kode</th>
                                
                                <!-- Kolom 2: Nama Produk (Rata Kiri) -->
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="text-align: left;">Nama Produk</th>
                                
                                <!-- Kolom 3: Kategori (Rata Kiri) -->
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="text-align: left;">Kategori</th>
                                
                                <!-- Kolom 4: Harga (Rata Kanan) -->
                                <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider" style="text-align: right;">Harga</th>
                                
                                <!-- Kolom 5: Stok (Rata Tengah) -->
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" style="text-align: center;">Stok</th>
                                
                                <!-- Kolom 6: Aksi (Rata Tengah) -->
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" style="text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($products as $product)
                                <tr class="@if ($product->stock == 0) bg-red-50 @elseif ($product->stock < 10) bg-yellow-50 @endif border-b border-gray-100 transition"
                                    style="@if($product->stock == 0) background-color: #fef2f2; @elseif($product->stock < 10) background-color: #fefce8; @endif">
                                    
                                    <!-- Data 1: Kode (Rata Kiri) -->
                                    <td class="px-6 py-4 text-sm text-gray-900" style="text-align: left;">{{ $product->code }}</td>
                                    
                                    <!-- Data 2: Nama Produk (Rata Kiri) -->
                                    <td class="px-6 py-4 text-sm text-gray-900" style="text-align: left;">{{ $product->name }}</td>
                                    
                                    <!-- Data 3: Kategori (Rata Kiri) -->
                                    <td class="px-6 py-4 text-sm text-gray-900" style="text-align: left;">{{ $product->category->name }}</td>
                                    
                                    <!-- Data 4: Harga (Rata Kanan) -->
                                    <td class="px-6 py-4 text-sm text-gray-900" style="text-align: right;">
                                        Rp{{ number_format($product->price, 0, ',', '.') }}
                                    </td>
                                    
                                    <!-- Data 5: Stok (Rata Tengah) -->
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900" style="text-align: center;">
                                        {{ $product->stock }}
                                        
                                        @if ($product->stock == 0)
                                            <span class="text-red-600 text-xs block font-normal mt-0.5">Habis</span>
                                        @elseif ($product->stock < 10)
                                            <span class="text-yellow-600 text-xs block font-normal mt-0.5">Menipis</span>
                                        @endif
                                    </td>
                                    
                                    <!-- Data 6: Aksi (Rata Tengah) -->
                                    <td class="px-6 py-4 text-sm" style="text-align: center;">
                                        <a href="{{ route('products.edit', $product->id) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Ubah</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-gray-500" style="text-align: center;">
                                        Belum ada data produk.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>