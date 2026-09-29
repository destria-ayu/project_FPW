<?php
 
namespace App\Http\Requests;
 
use Illuminate\Foundation\Http\FormRequest;
 
class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->role === 'admin';
    }
 
   public function rules(): array
{
    return [
        'category_id' => 'required|exists:categories,id',
        'code'        => 'required|string|max:20|unique:products,code',
        'name'        => 'required|string|max:150',
        'unit'        => 'required|string|max:20',
        'price'       => 'required|integer|gt:0', // <-- Menggunakan gt:0 (harus > 0)
        'stock'       => 'required|integer|min:0',
    ];
}

public function messages(): array
{
    return [
        'code.unique' => 'Kode produk sudah digunakan, gunakan kode lain.',
        'price.gt'    => 'Harga produk tidak boleh 0 atau bernilai negatif.', 
    ];
}
}

