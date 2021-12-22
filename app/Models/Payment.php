<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public function rupiah()
    {
        return  "Rp " . number_format($this->total_price, 2, ',', '.');
    }
}
