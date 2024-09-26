@extends('layouts.layout')

@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5 ">
                <div class="card mt-5 mb-5">
                    <div class="row no-gutters m-5">

                            @csrf
                        <div class="col-md-4">
                            <img src="{{ asset('assets/images/'.$product->image) }}"  class="card-img" alt="{{ $product->name }}">

                        </div>
                        <div class="col-md-6 ml-5">
                            <form action="" method="POST" id="cart_form">
                                <h2 class="card-title">
                                    <strong>{{ $product->brand->brand }} {{ $product->name }}
                                        <input type="hidden" id="image" name="image" value="{{ $product->image }}" />
                                        <input type="hidden" id="name" name="name" value="{{  $product->name}}">
                                        <input type="hidden" id="brand" name="brand" value="{{  $product->brand->brand }}">
                                        @foreach($product->internals as $internals)
                                            {{ $internals->value }}
                                        @endforeach -
                                        @foreach($product->colors as $colors)
                                            {{ $colors->value }}
                                        @endforeach


                                    </strong>
                                </h2>

                                <p class="card-text">
                                    <strong>
                                        <label for="internal_memory">Internal memory:</label>
                                    </strong>
                                    <span id="internal_memory">
                                @foreach($product->internals as $internals)
                                            {{ $internals->value }}GB
                                        @endforeach
                                 </span>
                                </p>

                                <p class="card-text">
                                    <strong>
                                        <label for="color">Color:</label>
                                    </strong>
                                    <span id="color">
                                    @foreach($product->colors as $colors)
                                            {{ $colors->value }}
                                            <span class="dot" style="background-color: {{ $colors->hex }}; border: 1px solid black"></span>
                                        @endforeach
                                    </span>
                                </p>

                                <p class="card-text">
                                    <strong>
                                        <label for="price">Price:</label>
                                    </strong>
                                    @foreach($product->prices as $p)
                                        @php
                                            $discountedPrice = $p->price;
                                            $activeDiscountPrice = null;
                                            foreach($product->discounts as $d) {
                                                if($d->amount && $d->active == 1){
                                                    $activeDiscountPrice = $p->price - ($d->amount / 100 * $p->price);
                                                }
                                            }
                                        @endphp
                                        @if ($activeDiscountPrice && $discountedPrice)
                                            <span>$<strong>{{ number_format($activeDiscountPrice, 2) }}</strong> <del>${{$discountedPrice}}</del></span>
                                            <input type="hidden" id="active_price" name="active_price" value="{{ $activeDiscountPrice }}">
                                        @else
                                            <span>$<strong>{{ number_format($p->price, 2) }}</strong></span>
                                            <input type="hidden" id="active_price" name="active_price" value="{{ $p->price }}">
                                        @endif
                                    @endforeach
                                </p>

                                <p class="card-text">
                                    <strong>
                                        <label for="screen_type">Screen type:</label>
                                    </strong>
                                   <span id="screen_type">
                                         {{ optional($product->screen)->screen }}
                                </span>
                                </p>

                                <p class="card-text">
                                    <strong>
                                        <label for="ram">RAM:</label>
                                    </strong>
                                    <span id="ram">
                                        @foreach($product->rams as $rams)
                                                 {{ $rams->value }}
                                       @endforeach
                                     </span>
                                </p>

                                <p class="card-text">
                                    <strong>
                                        <label for="quantity">Quantity:</label>
                                    </strong>
                                    <input type="number" id="quantity" name="quantity" min="1" max="5" value="1"/>
                                </p>

                                <input type="hidden" id="product_id" name="product_id" value="{{ $product->id }}">
                                @if(Auth::check() && Auth::user()->role_id==2)
                                    <button type="button" id="add_to_cart" disabled class="btn btn-primary mt-2">
                                        Add to Cart
                                    </button>
                                @else
                                <button type="button" id="add_to_cart" class="btn btn-primary mt-2">
                                    Add to Cart
                                </button>
                                @endif
                                <div id="message"></div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('assets/js/main.js') }}"></script>
@endsection
