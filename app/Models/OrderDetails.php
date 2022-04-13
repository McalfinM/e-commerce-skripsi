<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'notes', 'product_id', 'quantity', 'total_price', 'volume', 'previous_price', 'previous_quantity', 'previous_voulme'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function rupiah()
    {
        $hasil_rupiah = "Rp " . number_format($this->total_price, 2, ',', '.');
        return $hasil_rupiah;
    }

    public function Order()
    {
        return $this->belongsTo(Order::class);
    }
}
