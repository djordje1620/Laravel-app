<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRamMemory extends Model
{
    use HasFactory;
    protected $table = 'product_ram';
    public $timestamps = false;
    protected $fillable = ['product_id', 'ram_id', 'start_date'];
}
