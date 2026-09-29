<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="p-6">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">
                Data Produk
            </h1>

            <a href="{{ route('products.create') }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md">
                + Tambah Produk
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow overflow-hidden">

            <table class="w-full border-collapse">

                <thead>
                    <tr class="bg-gray-100">
                        <th class="border p-3 text-left">No</th>
                        <th class="border p-3 text-left">Kode Produk</th>
                        <th class="border p-3 text-left">Nama Produk</th>
                        <th class="border p-3 text-left">Satuan</th>
                        <th class="border p-3 text-left">Harga</th>
                        <th class="border p-3 text-left">Stok</th>
                        <th class="border p-3 text-left">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($products as $product)

                        <tr class="hover:bg-gray-50">

                            <td class="border p-3">
                                {{ $products->firstItem() + $loop->index }}
                            </td>

                            <td class="border p-3">
                                {{ $product->code }}
                            </td>

                            <td class="border p-3">
                                {{ $product->name }}
                            </td>

                            <td class="border p-3">
                                {{ $product->unit }}
                            </td>

                            <td class="border p-3">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </td>

                            <td class="border p-3">
                                {{ $product->stock }}
                            </td>

                            <td class="border p-3">

                                <a href="{{ route('products.edit', $product) }}"
                                   class="text-blue-600 hover:underline">
                                    Edit
                                </a>

                                <form action="{{ route('products.destroy', $product) }}"
                                      method="POST"
                                      class="inline">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="text-red-600 hover:underline ml-2"
                                            onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                        Hapus
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7"
                                class="border p-6 text-center text-gray-500">
                                Belum ada data produk.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-4">
            {{ $products->links() }}
        </div>

    </div>

</body>
</html>