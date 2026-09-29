<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Pembelian</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-6xl mx-auto p-6">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">

            <h1 class="text-3xl font-bold">
                Detail Pembelian
            </h1>

            <a href="{{ route('purchases.index') }}"
               class="text-gray-600 hover:text-indigo-600">
                Kembali
            </a>

        </div>


        {{-- Informasi Pembelian --}}
        <div class="bg-white rounded-lg shadow p-6 mb-6">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div>
                    <p class="text-sm text-gray-500">
                        Supplier
                    </p>

                    <p class="text-lg font-semibold">
                        {{ $purchase->supplier->name }}
                    </p>
                </div>


                <div>
                    <p class="text-sm text-gray-500">
                        Tanggal Pembelian
                    </p>

                    <p class="text-lg font-semibold">
                        {{ $purchase->date }}
                    </p>
                </div>


                <div>
                    <p class="text-sm text-gray-500">
                        Total Pembelian
                    </p>

                    <p class="text-lg font-semibold">
                        Rp {{ number_format($purchase->total_amount, 0, ',', '.') }}
                    </p>
                </div>

            </div>

        </div>


        {{-- Detail Produk --}}
        <div class="bg-white rounded-lg shadow overflow-hidden">

            <div class="p-6">
                <h2 class="text-xl font-bold">
                    Produk yang Dibeli
                </h2>
            </div>


            <table class="w-full border-collapse">

                <thead>

                    <tr class="bg-gray-100">

                        <th class="border p-3 text-left">
                            No
                        </th>

                        <th class="border p-3 text-left">
                            Produk
                        </th>

                        <th class="border p-3 text-left">
                            Harga Beli
                        </th>

                        <th class="border p-3 text-left">
                            Jumlah
                        </th>

                        <th class="border p-3 text-left">
                            Subtotal
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($purchase->details as $detail)

                        <tr>

                            <td class="border p-3">
                                {{ $loop->iteration }}
                            </td>

                            <td class="border p-3">
                                {{ $detail->product->name }}
                            </td>

                            <td class="border p-3">
                                Rp {{ number_format($detail->buy_price, 0, ',', '.') }}
                            </td>

                            <td class="border p-3">
                                {{ $detail->quantity }}
                            </td>

                            <td class="border p-3">
                                Rp {{ number_format($detail->buy_price * $detail->quantity, 0, ',', '.') }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5"
                                class="border p-6 text-center text-gray-500">

                                Tidak ada detail produk.

                            </td>

                        </tr>

                    @endforelse

                </tbody>


                <tfoot>

                    <tr class="bg-gray-50">

                        <td colspan="4"
                            class="border p-3 text-right font-bold">

                            Total Pembelian

                        </td>

                        <td class="border p-3 font-bold">

                            Rp {{ number_format($purchase->total_amount, 0, ',', '.') }}

                        </td>

                    </tr>

                </tfoot>

            </table>

        </div>

    </div>

</body>

</html>