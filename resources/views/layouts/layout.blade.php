<!DOCTYPE html>
<html lang="en">

@include('fixed.head')

<body class="main-layout @yield('body-class')">

<!-- Navigation -->
@include('fixed.navigation')

<!-- Page Content -->
@yield('content')

<!-- Footer -->
@include('fixed.footer')

<!-- Bootstrap core JavaScript -->
@include('fixed.scripts')

</body>

</html>

