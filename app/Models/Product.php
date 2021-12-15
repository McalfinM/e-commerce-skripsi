<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, Sluggable;
    protected $fillable = ['name', 'description', 'image', 'price', 'stock', 'slug'];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function getImage()
    {
        if ($this->image) {
            return asset('image/product/' . $this->image);
        } else {
            return asset('image/product/image.jpg');
        }
    }

    function rupiah()
    {
        $hasil_rupiah = "Rp " . number_format($this->price, 2, ',', '.');
        return $hasil_rupiah;
    }

    public function order_deatil()
    {
        return $this->hasMany(OrderDetails::class);
    }
}
