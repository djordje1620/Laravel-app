<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternalMemory extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['value'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_internal', 'internal_id', 'product_id');
    }
}
