<!-- Javascript files-->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.0.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin.js') }}"></script>
    <!-- sidebar -->
    <script src="{{ asset('assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/admin.js') }}"></script>

    <!-- javascript -->
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    @yield('scripts')
    <script>
        var isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
        var isAdmin = {{ Auth::check() && Auth::user()->role_id == 2 ? 'true' : 'false' }};
    </script>
    <script>

    $(document).ready(function() {
        $(".fancybox").fancybox({
                    openEffect: "none",
                    closeEffect: "none"
                });

                $(".zoom").hover(function() {

                    $(this).addClass('transition');
                }, function() {

                    $(this).removeClass('transition');
                });
            });


        </script>
