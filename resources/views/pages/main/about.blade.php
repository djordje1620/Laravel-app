@extends('layouts.layout')

@section('content')
    <div class="brand_color">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>About</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about -->
    <div class="about">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-5 co-sm-l2">
                    <div class="about_img">
                        <figure><img src="{{ asset('assets/images/about.png') }}" alt="img" /></figure>
                    </div>
                </div>
                @foreach($aboutInfo as $i)
                    <div class="col-xl-7 col-lg-7 col-md-7 co-sm-l2">
                        <div class="about_box">
                            <span>{{ $i->title }}</span>
                            <p>{{ $i->description }} </p>

                        </div>
                    </div>
                @endforeach
                <div class="col-xl-5 col-lg-5 col-md-5 co-sm-l2">
                    <div class="about_img">
                        <figure><img src="{{ asset('assets/images/about.png') }}" alt="img" /></figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- end about -->
@endsection
