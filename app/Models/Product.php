<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Mockery\Exception;


class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'brand', 'screen', 'color', 'image', 'internal_memory', 'ram'];

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function screen(){
        return $this->belongsTo(Screen::class);
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }
    public function colors() {
         return $this->belongsToMany(Color::class, 'product_color', 'product_id', 'color_id');
    }

    public function internals() {
        return $this->belongsToMany(InternalMemory::class, 'product_internal', 'product_id', 'internal_id');
    }
    public function rams() {
        return $this->belongsToMany(RamMemory::class, 'product_ram', 'product_id', 'ram_id');
    }
    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }
    public function basketProducts(){
        return $this->hasMany(BasketProduct::class);
    }
    public function activePrice()
    {
        return $this->prices()->where('active', true);
    }

    public function scopeFilterByPrice($query, $minPrice, $maxPrice)
    {
        return $query->whereHas('prices', function ($query) use ($minPrice, $maxPrice) {
            $query->whereBetween('price', [$minPrice, $maxPrice]);
        });
    }

    public function getFilteredProducts(Request $request)
    {
//        SELECT
        $query= DB::table('products');
//      JOIN
        $query = $query->join("brands", "products.brand_id", "=", "brands.id")
                        ->join('screens','products.screen_id','=','screens.id')
                        ->join('prices', 'products.id', '=', 'prices.product_id')
        ->join('product_color', 'products.id', '=', 'product_color.product_id')
        ->join('colors', 'product_color.color_id', '=', 'colors.id')
        ->join('product_internal', 'products.id', '=', 'product_internal.product_id')
        ->join('internal_memories', 'product_internal.internal_id', '=', 'internal_memories.id')
        ->join('product_ram', 'products.id', '=', 'product_ram.product_id')
        ->join('ram_memories', 'product_ram.ram_id', '=', 'ram_memories.id')
        ->where('prices.active','=',1);


        if ($request->has('searchInput')) {
            $keyword = $request->get('searchInput');
            $query->where(function ($q) use ($keyword) {
                $q->where('products.name', 'like', '%' . $keyword . '%')
                    ->orWhere('brands.brand', 'like', '%' . $keyword . '%');
            });
        }

        if ($request->has('brands')) {
            $brands = $request->get('brands');
            $query->whereIn('brand_id', $brands);
        }

        if ($request->has('price')) {
            $minPrice = $request->get('price');
            $query->where('price', '>' , $minPrice);
        }

        if ($request->has('screen_type')) {
            $screenType = $request->get('screen_type');
            $query->where('screen', '=' , $screenType);
        }

        $query = $query->select("products.*","prices.*", "brands.*", "screens.*", "colors.value as color_value", "internal_memories.value as internal_value", "ram_memories.value as ram_value");

        $perPage = 6;
        if($request->has("perPage")) {
            $perPage = $request->get("perPage");
        }

        return $query->paginate($perPage)->withQueryString();
        }
}
