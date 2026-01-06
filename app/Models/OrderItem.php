<?php

namespace App\Models;

use App\Models\Product; // <-- Pastikan ini ada
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price'
    ];

    /**
     * Mendefinisikan relasi bahwa satu item pesanan (OrderItem)
     * merujuk ke satu produk (Product).
     * Ini adalah method yang hilang.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
