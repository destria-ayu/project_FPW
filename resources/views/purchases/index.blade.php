<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Pembelian</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="p-6">

        <div class="flex justify-between items-center mb-6">

            <h1 class="text-2xl font-bold">
                Data Pembelian (Purchase)
            </h1>

            <a href="{{ route('purchases.create') }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md">
                + Tambah Pembelian
            </a>

        </div>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow overflow-hidden">

            <div class="p-6">

                <h2 class="text-xl font-semibold mb-4">
                    Daftar Pembelian Supplier
                </h2>

                <table class="w-full border-collapse">

                    <thead>

                        <tr class="bg-gray-100">

                            <th class="border p-3 text-left">
                                No
                            </th>

                            <th class="border p-3 text-left">
                                No Nota / Supplier
                            </th>

                            <th class="border p-3 text-left">
                                Tanggal
                            </th>

                            <th class="border p-3 text-left">
                                Total
                            </th>

                            <th class="border p-3 text-left">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($purchases as $purchase)

                            <tr class="hover:bg-gray-50">

                                <td class="border p-3">
                                    {{ $purchases->firstItem() + $loop->index }}
                                </td>

                                <td class="border p-3">
                                    {{ $purchase->supplier->name ?? '-' }}
                                </td>

                                <td class="border p-3">
                                    {{ $purchase->date }}
                                </td>

                                <td class="border p-3">
                                    Rp {{ number_format($purchase->total_amount, 0, ',', '.') }}
                                </td>

                                <td class="border p-3">

                                    <a href="{{ route('purchases.show', $purchase) }}"
                                        class="text-blue-600 hover:underline">
                                        Detail
                                    </a>

                                    <form action="{{ route('purchases.destroy', $purchase) }}"
                                        method="POST"
                                        class="inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="text-red-600 hover:underline ml-3"
                                            onclick="return confirm('Yakin ingin menghapus pembelian ini?')">
                                            Hapus
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5"
                                    class="border p-6 text-center text-gray-500">

                                    Belum ada data transaksi pembelian.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

                <div class="mt-4">
                    {{ $purchases->links() }}
                </div>

            </div>

        </div>

    </div>

</body>

</html>