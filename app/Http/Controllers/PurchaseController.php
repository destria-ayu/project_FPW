<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Supplier;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Menampilkan daftar pembelian
     */
    public function index()
    {
        $purchases = Purchase::with('supplier')
            ->latest()
            ->paginate(10);

        return view('purchases.index', compact('purchases'));
    }

    /**
     * Menampilkan form tambah pembelian
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::all();

        return view('purchases.create', compact('suppliers', 'products'));
    }

    /**
     * Menyimpan pembelian
     */
    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'date' => 'required|date',

            'product_id' => 'required|array',
            'product_id.*' => 'required|exists:products,id',

            'quantity' => 'required|array',
            'quantity.*' => 'required|integer|min:1',

            'buy_price' => 'required|array',
            'buy_price.*' => 'required|integer|min:0',
        ]);

        DB::transaction(function () use ($request) {

            $total = 0;

            // Buat data pembelian terlebih dahulu
            $purchase = Purchase::create([
                'supplier_id' => $request->supplier_id,
                'date' => $request->date,
                'total_amount' => 0,
            ]);

            // Simpan detail pembelian
            foreach ($request->product_id as $i => $productId) {

                $quantity = $request->quantity[$i];
                $buyPrice = $request->buy_price[$i];

                $subtotal = $quantity * $buyPrice;

                $total += $subtotal;

                PurchaseDetail::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'buy_price' => $buyPrice,
                ]);

                // Tambahkan stok produk
                Product::where('id', $productId)
                    ->increment('stock', $quantity);
            }

            // Update total pembelian
            $purchase->update([
                'total_amount' => $total,
            ]);
        });

        return redirect()
            ->route('purchases.index')
            ->with('success', 'Pembelian berhasil disimpan dan stok produk telah diperbarui.');
    }

    /**
     * Menampilkan detail pembelian
     */
    public function show(Purchase $purchase)
    {
        $purchase->load('supplier', 'details.product');

        return view('purchases.show', compact('purchase'));
    }

    /**
     * Form edit pembelian
     */
    public function edit(Purchase $purchase)
    {
        $suppliers = Supplier::all();
        $products = Product::all();

        $purchase->load('details.product');

        return view('purchases.edit', compact(
            'purchase',
            'suppliers',
            'products'
        ));
    }

    /**
     * Update pembelian
     */
    public function update(Request $request, Purchase $purchase)
    {
        // Untuk sementara
        // fitur edit bisa dibuat setelah fitur tambah berhasil.

        return redirect()
            ->route('purchases.index')
            ->with('success', 'Fitur edit pembelian belum digunakan.');
    }

    /**
     * Hapus pembelian
     */
    public function destroy(Purchase $purchase)
    {
        $purchase->load('details');

        DB::transaction(function () use ($purchase) {

            // Kembalikan stok sebelum pembelian dihapus
            foreach ($purchase->details as $detail) {
                Product::where('id', $detail->product_id)
                    ->decrement('stock', $detail->quantity);
            }

            $purchase->delete();
        });

        return redirect()
            ->route('purchases.index')
            ->with('success', 'Pembelian berhasil dihapus.');
    }
}