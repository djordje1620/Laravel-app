<!DOCTYPE html>
<html lang="en">

@include('fixed.head')

<body class="main-layout @yield('body-class')">
<!-- Navigation -->
@include('fixed.admin-navigation')

<!-- Page Content -->
@yield('content')

<!-- Bootstrap core JavaScript -->
@include('fixed.scripts')

</body>

</html>
