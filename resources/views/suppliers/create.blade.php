<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Supplier - PosKita</title>
    <!-- Script Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Memanggil menu navigator -->
    @include('layouts.navigation')

    <div class="container mx-auto mt-8 px-4 max-w-2xl">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Tambah Supplier Baru</h1>
            <a href="{{ route('suppliers.index') }}" class="text-gray-500 hover:text-gray-700 underline">
                Kembali
            </a>
        </div>

        <!-- Menampilkan pesan error validasi jika ada -->
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <!-- Form input data, menggunakan method POST dan @csrf -->
            <form action="{{ route('suppliers.store') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Nama Supplier
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                           id="name" name="name" type="text" placeholder="Masukkan nama..." value="{{ old('name') }}" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
                        No. Telepon
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                           id="phone" name="phone" type="text" placeholder="Contoh: 08123456789" value="{{ old('phone') }}" required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="address">
                        Alamat
                    </label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                              id="address" name="address" rows="3" placeholder="Alamat lengkap supplier..." required>{{ old('address') }}</textarea>
                </div>

                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>