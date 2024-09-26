@extends('layouts.layout')

@section('content')

    <section class="slider_section">
        <div id="myCarousel" class="carousel slide banner-main" data-ride="carousel">
            <div class="carousel-inner">
                @foreach($slider as $s)
                    <div class="carousel-item @if($s->activeClass==1) active @endif">
                        <img class="first-slide" src="{{ asset('assets/images/'.$s->image) }}" alt="{{ $s->title }}">
                        <div class="container">
                            <div class="carousel-caption relative">
                                <span>{{ $s->title }}</span>
                                <h1>{{ $s->subtitle }}</h1>
                                <p>
                                    {{ $s->description }}
                                </p>
                                <a class="buynow" href="{{ route('products') }}">Buy Now</a>
                                <ul class="social_icon">
                                    @foreach($socials as $social)
                                        @if($social->active==1)
                                            <li> <a href="{{ $social->link }}"><i class="{{ $social->iClass }}"></i></a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                <i class='fa fa-angle-left'></i>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                <i class='fa fa-angle-right'></i>
            </a>
        </div>
    </section>


    <!-- brand -->
    <div class="brand">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Special offer</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class="container">
                <div class="row">
                    @foreach($products as $product)
{{--                        @dd($product)--}}
                        <div class="col-md-4">
                            <div class="phone-box text-md-center">
                                <div class="img-disc">
                                    <a href="products/{{ $product->id }}">
                                        <img class="mb-2 phone-img" src="{{ asset('assets/images/' . $product->image) }}" alt="{{ $product->name }}">
                                        @foreach($product->discounts as $d)
                                            <span id="discount">
                                                @if($d->active)
                                                    {{ $d->amount }}%
                                                @endif
                                            </span>
                                        @endforeach
                                    </a>
                                <p>{{ $product->brand->brand }} {{ $product->name }}</p>
                                <p>
                                    @foreach($product->internals as $internals)
                                        {{ $internals->value }}GB
                                    @endforeach
                                    -
                                    @foreach($product->colors as $colors)
                                        {{ $colors->value }}</p>
                                    @endforeach
                                @foreach($product->prices as $p)
                                    @foreach($product->discounts as $d)
                                        @if($d->active==1)
                                                @php
                                                    $discountedPrice = $p->price - ($d->amount / 100 * $p->price);
                                                @endphp
                                                <span>$<strong>{{ number_format($discountedPrice, 2) }}</strong></span>
                                        @endif
                                    @endforeach
                                        <br/> <del>${{ $p->price }}</del>
                                @endforeach
                                </div>

                            </div>
                        </div>
                    @endforeach
                    @if(Auth::check() && Auth::user()->role_id==2)
                            <div class="col-md-12">
                                <a href="{{ route('admin.discount') }}" class="read-more">Edit discounts</a>
                            </div>
                    @else
                            <div class="col-md-12">
                                <a href="{{ route('products') }}" class="read-more">See More</a>
                            </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- end brand -->
    <!-- clients -->
    <div class="clients brand-bg mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>what say our clients</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clients_red">
        <div class="container">
            <div id="testimonial_slider" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ul class="carousel-indicators">
                    <li data-target="#testimonial_slider" data-slide-to="0" class=""></li>
                    <li data-target="#testimonial_slider" data-slide-to="1" class="active"></li>
                    <li data-target="#testimonial_slider" data-slide-to="2" class=""></li>
                </ul>
                <!-- The slideshow -->
                <div class="carousel-inner">
                    @foreach($comments as $comment)
                        <div class="carousel-item @if($comment->activeClass==1) active @endif">
                            <div class="testomonial_section">
                                <div class="full center">
                                </div>
                                <div class="full testimonial_cont text_align_center cross_layout">
                                    <div class="cross_inner">
                                        <h3>{{ $comment->name }}</h3>
                                        <p>"{{ $comment->content }}"</i>
                                        </p>
                                        <div class="full text_align_center margin_top_30">
                                            <img src="{{ asset('assets/icon/testimonial_qoute.png') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>

            </div>

        </div>
    </div>
    <!-- end clients -->

@endsection
