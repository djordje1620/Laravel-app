<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasketProduct extends Model
{
    use HasFactory;
    public function basket(){
        return $this->belongsTo(Basket::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function price(){
        return $this->belongsTo(Price::class);
    }
}
