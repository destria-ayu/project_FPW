<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Supplier - PosKita</title>
    <!-- Script Tailwind (Hanya untuk merapikan tampilan sementara) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Memanggil menu navigator yang kamu punya -->
    <!-- Jika nama file-nya navigation.blade.php, ganti tulisan navigator di bawah menjadi navigation -->
    @include('layouts.navigation')

    <div class="container mx-auto mt-8 px-4">
        <h1 class="text-2xl font-bold mb-4">Daftar Supplier</h1>
        
        <a href="{{ route('suppliers.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
            + Tambah Supplier
        </a>

        <div class="bg-white shadow-md rounded my-6 overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">No</th>
                        <th class="py-3 px-6 text-left">Nama</th>
                        <th class="py-3 px-6 text-left">Telepon</th>
                        <th class="py-3 px-6 text-left">Alamat</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse($suppliers as $supplier)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">{{ $loop->iteration }}</td>
                        <td class="py-3 px-6 text-left">{{ $supplier->name }}</td>
                        <td class="py-3 px-6 text-left">{{ $supplier->phone }}</td>
                        <td class="py-3 px-6 text-left">{{ $supplier->address }}</td>
                        <td class="py-3 px-6 text-center">
                            <button class="text-blue-500 hover:text-blue-700 mx-2">Edit</button>
                            <button class="text-red-500 hover:text-red-700 mx-2">Hapus</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-3 px-6 text-center text-gray-500 font-bold">Belum ada data supplier.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>