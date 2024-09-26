<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'amount', 'start_date', 'active', 'end_date'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
