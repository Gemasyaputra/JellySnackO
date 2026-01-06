<?php

namespace App\Models;

use App\Models\User; // <-- Pastikan ini ada
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price',
        'shipping_address',
        'phone_number',
        'status'
    ];

    /**
     * Mendefinisikan relasi bahwa satu pesanan (Order) dimiliki oleh satu pengguna (User).
     * Ini adalah method yang hilang.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Order Items
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Relasi ke Payment
     */
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
