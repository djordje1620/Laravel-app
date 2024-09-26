@php use Illuminate\Support\Facades\Auth; @endphp
    <!-- loader  -->
<div class="loader_bg">
    <div class="loader"><img src="{{ asset('assets/images/loading.gif') }}" alt="#"/></div>
</div>
<!-- end loader -->
<!-- header -->
<header>
    <!-- header inner -->
    <div class="header">

        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                    <div class="full">
                        <div class="center-desk">
                            <div class="logo">
                                <a href="index.html"><img src="{{ asset('assets/images/logo.png') }}" alt="#"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                    <div class="menu-area">
                        <div class="limit-box">
                            <nav class="main-menu">
                                <ul class="menu-area-main">
                                    @foreach($menu as $link)
                                        <li class="@if(request()->routeIs($link->route)) active @endif">
                                            <a href="{{ route($link->route) }}">{{ $link->name }}</a>
                                        </li>
                                    @endforeach
                                        @if(Auth::check() && Auth::user()->role_id==2)
                                            <li><a href="{{ route('admin.panel') }}" class="text-info">Admin panel</a></li>
                                        @else
                                            <li class="@if(request()->routeIs($link->route)) active @endif">
                                                <a href="{{ route('cart.show') }}">Cart</a>
                                            </li>
                                        @endif

                                    @if(!Auth::check())
                                        | <li><a href="{{ route('login') }}">Log in</a></li>
                                    @else
                                            | <li>
                                                <form action="{{route('logout')}}" method="POST" id="logoutForm">
                                                    @csrf
                                                    <a
                                                        href="#"
                                                        onclick="event.preventDefault(); document.getElementById('logoutForm').submit();"
                                                    >
                                                         Log out
                                                    </a>
                                                </form>
                                            </li>
                                    @endif

                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 offset-md-6">
                    <div class="location_icon_bottum">
                        <ul>
                            @foreach($informations as $information )
                                <li><img src="{{ asset('assets/icon/loc.png') }}"/>{{ $information->location }}</li>
                                <li><img src="{{ asset('assets/icon/call.png') }}"/>{{ $information->phone }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end header inner -->
</header>
<!-- end header -->
