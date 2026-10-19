<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    // Menampilkan halaman tabel daftar supplier
    public function index()
    {
        $suppliers = Supplier::all();
        return view('suppliers.index', compact('suppliers'));
    }

    // Menampilkan halaman form tambah data
    public function create()
    {
        return view('suppliers.create');
    }

    // Memproses penyimpanan data ke database
    public function store(Request $request)
    {
        // 1. Validasi inputan
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string'
        ]);

        // 2. Simpan ke database
        Supplier::create($validatedData);

        // 3. Redirect kembali ke index dengan notifikasi
        return redirect()->route('suppliers.index')->with('success', 'Data supplier berhasil ditambahkan!');
    }
}