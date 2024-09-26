@extends('layouts.layout')

@section('content')

    <div class="container my-5 cart-product card mb-3" id="cart-container">

    </div>

@endsection
<script>
    const baseUrl = "{{url('/')}}"
</script>
@section('scripts')
    <script src="{{ asset('assets/js/cart.js') }}"></script>
@endsection
