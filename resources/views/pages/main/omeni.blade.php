@extends('layouts.layout')

@section('content')
    <div class="brand_color">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>About me</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about -->
    <div class="">
        <div class="container">
            <div class="row">
                    <div class="container-lg pt-5 my-5">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="{{asset('assets/images/ja.jpg')}}" class="img-fluid" alt="djm1620">
                            </div>
                            <div class="col-md-6">
                                <h4 data-aos="fade-up" data-aos-duration="1000"><span class="text-success">About me</span></h4>
                                <p class="text-justify py-2 text-secondary" data-aos="fade-up" data-aos-duration="2000">
                                    I'm Đorđe Marković, I'm a student at ICT college, focused on web programming. I was born and raised in Užice, a city that is especially dear to my heart. I've had a passion for technology and computing since I was little, and I'm especially fascinated by the world of programming.
                                </p>
                                <p class="text-justify py-2 text-secondary" data-aos="fade-up" data-aos-duration="2000">
                                    In addition to my passion for technology, I am also an avid sportsman. I do sports regularly to maintain a balance between mind and body. Workouts help me stay focused and energetic during long hours spent at the computer.
                                </p>
                                <p class="text-justify py-2 text-secondary" data-aos="fade-up" data-aos-duration="2000">
                                    My desire to learn and improve inspires me to take on different challenges and projects. I believe in the importance of teamwork and open thinking, and I am always ready to cooperate and contribute to the team's success.
                                </p>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- end about -->
@endsection
