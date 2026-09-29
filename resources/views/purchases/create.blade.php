<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Pembelian</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100">

    <div class="p-6 max-w-5xl mx-auto">

        <div class="flex justify-between items-center mb-6">

            <h1 class="text-2xl font-bold">
                Tambah Pembelian
            </h1>

            <a href="{{ route('purchases.index') }}"
                class="text-gray-600 hover:underline">
                Kembali
            </a>

        </div>

        @if ($errors->any())

            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-md">

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('purchases.store') }}"
            method="POST"
            class="bg-white p-6 rounded-lg shadow">

            @csrf

            <div class="grid grid-cols-2 gap-4 mb-6">

                <div>

                    <label class="block font-medium mb-1">
                        Supplier
                    </label>

                    <select name="supplier_id"
                        class="w-full border rounded-md p-2"
                        required>

                        <option value="">
                            Pilih Supplier
                        </option>

                        @foreach ($suppliers as $supplier)

                            <option value="{{ $supplier->id }}"
                                {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>

                                {{ $supplier->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div>

                    <label class="block font-medium mb-1">
                        Tanggal Pembelian
                    </label>

                    <input type="date"
                        name="date"
                        value="{{ old('date', date('Y-m-d')) }}"
                        class="w-full border rounded-md p-2"
                        required>

                </div>

            </div>

            <h2 class="text-lg font-semibold mb-3">
                Produk yang Dibeli
            </h2>

            <div id="product-container">

                <div class="product-row grid grid-cols-12 gap-3 mb-3">

                    <div class="col-span-4">

                        <select name="product_id[]"
                            class="w-full border rounded-md p-2 product-select"
                            required>

                            <option value="">
                                Pilih Produk
                            </option>

                            @foreach ($products as $product)

                                <option value="{{ $product->id }}"
                                    data-price="{{ $product->price }}">

                                    {{ $product->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-span-3">

                        <input type="number"
                            name="buy_price[]"
                            placeholder="Harga Beli"
                            class="w-full border rounded-md p-2 buy-price"
                            min="0"
                            required>

                    </div>

                    <div class="col-span-2">

                        <input type="number"
                            name="quantity[]"
                            placeholder="Jumlah"
                            class="w-full border rounded-md p-2"
                            min="1"
                            required>

                    </div>

                    <div class="col-span-2">

                        <input type="text"
                            class="w-full border rounded-md p-2 subtotal"
                            placeholder="Subtotal"
                            readonly>

                    </div>

                    <div class="col-span-1">

                        <button type="button"
                            onclick="removeRow(this)"
                            class="bg-red-500 text-white px-3 py-2 rounded-md">

                            X

                        </button>

                    </div>

                </div>

            </div>

            <button type="button"
                onclick="addProduct()"
                class="bg-green-600 text-white px-4 py-2 rounded-md mb-6">

                + Tambah Produk

            </button>

            <div class="border-t pt-4 flex justify-between items-center">

                <strong class="text-lg">
                    Total Pembelian
                </strong>

                <strong id="total"
                    class="text-xl">

                    Rp 0

                </strong>

            </div>

            <button type="submit"
                class="mt-6 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-md">

                Simpan Pembelian

            </button>

        </form>

    </div>

    <script>

        function updateTotal() {

            let total = 0;

            document.querySelectorAll('.product-row').forEach(row => {

                const price = parseInt(
                    row.querySelector('.buy-price').value
                ) || 0;

                const quantity = parseInt(
                    row.querySelector('input[name="quantity[]"]').value
                ) || 0;

                const subtotal = price * quantity;

                row.querySelector('.subtotal').value =
                    'Rp ' + subtotal.toLocaleString('id-ID');

                total += subtotal;

            });

            document.getElementById('total').innerText =
                'Rp ' + total.toLocaleString('id-ID');
        }


        function addProduct() {

            const container =
                document.getElementById('product-container');

            const firstRow =
                document.querySelector('.product-row');

            const newRow =
                firstRow.cloneNode(true);

            newRow.querySelectorAll('input').forEach(input => {
                input.value = '';
            });

            newRow.querySelector('select').selectedIndex = 0;

            container.appendChild(newRow);

            updateEvents();
        }


        function removeRow(button) {

            const rows =
                document.querySelectorAll('.product-row');

            if (rows.length > 1) {

                button.closest('.product-row').remove();

                updateTotal();

            }

        }


        function updateEvents() {

            document.querySelectorAll(
                '.buy-price, input[name="quantity[]"]'
            ).forEach(input => {

                input.oninput = updateTotal;

            });

        }


        document.addEventListener('change', function(e) {

            if (e.target.classList.contains('product-select')) {

                const row =
                    e.target.closest('.product-row');

                const option =
                    e.target.options[e.target.selectedIndex];

                const price =
                    option.getAttribute('data-price');

                row.querySelector('.buy-price').value =
                    price || '';

                updateTotal();

            }

        });


        updateEvents();

    </script>

</body>

</html>