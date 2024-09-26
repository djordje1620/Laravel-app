<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{

    public $productId;
    public $productUrl;
    public $productImage;
    public $productName;
    public $productBrand;
    public $productMemory;
    public $productColor;
    public $productPrices;
    public $productDiscount;
    /**
     * Create a new component instance.
     */


    public function __construct($productId, $productUrl, $productImage, $productName, $productBrand, $productMemory, $productColor, $productPrices, $productDiscount)
    {
        $this->productId = $productId;
        $this->productUrl = $productUrl;
        $this->productImage = $productImage;
        $this->productName = $productName;
        $this->productBrand = $productBrand;
        $this->productMemory = $productMemory;
        $this->productColor = $productColor;
        $this->productPrices = $productPrices;
        $this->productDiscount = $productDiscount;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card');
    }
}
