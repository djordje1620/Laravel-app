<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInternalMemory extends Model
{
    use HasFactory;
    protected $table = 'product_internal';
    public $timestamps = false;
    protected $fillable = ['product_id', 'internal_id', 'start_date'];
}
