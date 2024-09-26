<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RamMemory extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['value'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_ram', 'ram_id', 'product_id');
    }
}
