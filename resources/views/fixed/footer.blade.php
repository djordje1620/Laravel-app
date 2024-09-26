<!-- footer -->
<footer>
    <div id="contact" class="footer">
        <div class="container">
            <div class="row pdn-top-30">
                <div class="col-md-12 ">
                    <div class="footer-box">
                        <div class="headinga">
                            @foreach($informations as $information) @endforeach
                            <h3>Address</h3>
                            <span>{{ $information->location }}</span>
                            <p>{{ $information->phone }}
                                <br>{{ $information->email }}</p>
                        </div>
                        <ul class="location_icon">
                            @foreach($socials as $social)
                                @if($social->active==1)
                                    <li> <a href="{{ $social->link }}"><i class="{{ $social->iClass }}"></i></a></li>
                                @endif
                            @endforeach
                        </ul>
                        <div class="menu-bottom">
                            <ul class="link">
                                @foreach($menu as $m)
                                    <li> <a href="{{ route($m->route) }}">{{ $m->name }}</a></li>
                                @endforeach
                                    <li> <a href="{{ route('me') }}">About me</a></li>
                                    <li> <a href="{{ asset('assets/dokumentacija.pdf') }}" class="text-success">Documentation</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- end footer -->
