
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="text-2xl font-semibold text-gray-800">
                Daftar Kategori
            </h2>

            <a href="{{ route('categories.create') }}"
                class="inline-flex items-center rounded-lg bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700">
                + Tambah Kategori
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gray-100 px-6 py-10 lg:px-9">

        @if (session('success'))
            <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-5 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="w-full overflow-hidden rounded-xl border border-gray-200 bg-white p-5 shadow-sm sm:p-7">
            <div class="w-full overflow-x-auto">
                <table class="w-full min-w-[500px] table-fixed border-collapse">
                    <colgroup>
                        <col style="width: 18%">
                        <col style="width: 82%">
                    </colgroup>

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-5 py-4 text-left text-sm font-semibold text-gray-500">
                                No
                            </th>
                            <th class="px-5 py-4 text-left text-sm font-semibold text-gray-500">
                                Nama Kategori
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($categories as $category)
                            <tr class="border-b border-gray-100 transition hover:bg-gray-50">
                                <td class="px-5 py-4 text-sm text-gray-700">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-5 py-4 text-sm font-medium text-gray-900">
                                    {{ $category->name }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="px-5 py-12 text-center text-sm text-gray-500">
                                    Belum ada data kategori.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
