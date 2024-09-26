@extends('layouts.layout')

@section('content')
    @php
        $minPrice = \App\Models\Price::min('price');
        $maxPrice = \App\Models\Price::max('price');
    @endphp
         <div id="content"></div>
    <!-- brand -->
    <div class="brand">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Products</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container my-5">
            <div class="row">
                <div class="col-md-3">
                    <div class="search-panel">
                        <h2 >Filter</h2>

                        <form action="" id="filter">
                            @csrf
                            {{--PRETRAGA--}}
                            <h5>Search</h5>
                            <div>
                                <input type="text" class="mb-3" id="searchInput" name="searchInput" />
                            </div>

                            {{--BRENDOVI--}}
                            <h5>Brands</h5>
                            @foreach($brands as $brand)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="{{ $brand->id }}" name="brands[]" value="{{ $brand->id }}">
                                    <label class="form-check-label" for="{{ $brand->id }}">{{ $brand->brand }}</label>
                                </div>
                            @endforeach

                            {{--CENA--}}
                            <h5 class="mt-3">Price</h5>
                            <div class="form-group">
                                <input type="range"  id="priceRange" name="price" min="{{ $minPrice-1 }}" max="{{ $maxPrice }}" step="10" value="0">
                                <div class="d-flex">
                                    <span id="minPrice" class="mr-5">{{ $minPrice-1 }}</span>
                                    <span id="maxPrice" class="ml-4">{{ $maxPrice }}</span>
                                </div>
                            </div>

                            {{--EKRAN--}}
                            <h5 class="mt-3">Screens</h5>
                            @foreach($screens as $screen)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="screen_type" id="screen_size_{{ $screen->id }}" value="{{ $screen->screen}}">
                                    <label class="form-check-label" for="screen_size_{{ $screen->id }}">
                                        {{ $screen->screen }}
                                    </label>
                                </div>
                            @endforeach
                            <button type="button" class="btn btn-secondary mt-3" id="resetFiltersBtn" style="display: none;">Reset Filters</button>
                        </form>

                    </div>

                </div>
                <div class="col-md-9">

                    <div class="row" id="products" >
                     @foreach($products as $product)
                            <x-card
                                :productId="$product->id"
                                :productUrl="route('product', $product->id)"
                                :productImage="$product->image"
                                :productBrand="$product->brand->brand"
                                :productName="$product->name"
                                :productMemory="$product->internals"
                                :productColor="$product->colors"
                                :productPrices="$product->prices"
                                :productDiscount="$product->discounts"
                            />

                     @endforeach

                    </div>
                    <div class="mt-5" id="pagination">

                        {{ $products->links("pagination::bootstrap-4") }}
                    </div>


                </div>


        </div>


       </div>



    <!-- end brand -->
@endsection

@section('scripts')
    <script>
        const baseUrl = "{{url('/')}}"
    </script>
    <script src="{{asset('assets/js/products.js')}}"></script>
    <script>
        // Dohvatimo elemente
        const priceRange = document.getElementById('priceRange');
        const minPrice = document.getElementById('minPrice');
        const maxPrice = document.getElementById('maxPrice');

        // Event listener za promenu vrednosti klizača
        priceRange.addEventListener('input', function() {
            minPrice.textContent = priceRange.value;
        });

        // Inicijalno postavljanje vrednosti za minimalnu i maksimalnu cenu
        minPrice.textContent = priceRange.min;
        maxPrice.textContent = priceRange.max;
    </script>

@endsection
