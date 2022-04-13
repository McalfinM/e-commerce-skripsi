<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory;

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function OrderDetail()
    {
        return $this->hasMany(OrderDetails::class);
    }

    public function lihat_surat()
    {
        if ($this->surat_jalan) {
            return asset('pdf/surat_jalan/' . $this->surat_jalan);
        }
    }
}
