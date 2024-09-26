<?php

namespace App\Http\Controllers;

use App\Models\ClientComment;
use App\Models\Discount;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Social;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $slider = Slider::all();
        $socials = Social::all();
        $comments = ClientComment::all()->where('active','=','1');

        $products = Product::whereHas('discounts', function (Builder $query) {
            $query->where('active', 1);
        })
            ->with(['discounts', 'prices','colors','internals','rams'])
            ->get();
        $sortedProducts = $products->sortByDesc(function ($product) {
            return $product->discounts->max('amount');
        });
        $maxDiscountProducts = $sortedProducts->take(3);

        return view('pages.main.home',['socials'=>$socials, 'slider'=>$slider, 'comments'=>$comments, 'products'=>$maxDiscountProducts]);
    }
}
