<div class="col-md-4 mt-3">
    <div class="phone-box text-md-center">
        <a href="{{ $productUrl }}"> <img class="mb-2 phone-img" src="{{ asset('assets/images/'.$productImage) }}" alt="{{ $productName }}"></a>
        <p>{{ $productBrand }} {{ $productName }}</p>
        <p>
                @foreach($productMemory as $memory)
                    {{ $memory->value }}GB
                @endforeach
                -
                @foreach($productColor as $color)
                    {{ $color->value }}
                @endforeach
        </p>

        @foreach($productPrices as $price)
            @if($price->active == 1)
                @php
                    $discountedPrice = null;
                    foreach ($productDiscount as $d) {
                        if ($d->active == 1) {
                            $discountedPrice = $price->price - ($price->price * ($d->amount / 100));
                            break;
                        }
                    }
                @endphp
                @if ($discountedPrice !== null)
                    <span>$<strong>{{ number_format($discountedPrice, 2) }} </strong> </span>
                    <del>${{ number_format($price->price, 2) }}</del>
                @else
                    <span>$ <strong>{{ number_format($price->price, 2) }}</strong></span>
                @endif
            @endif
        @endforeach


        @if(Auth::check() && Auth::user()->role_id==2)
            <div class="col-md-12">
                <a href="{{ route('admin.add-update',['id'=>$productId]) }}" class="read-more">Edit product</a>
            </div>
        @endif
    </div>
</div>
