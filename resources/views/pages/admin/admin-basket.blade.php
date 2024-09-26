@extends('layouts.admin-layout')

@section('content')
    <body>
    <div class="container-fluid">
        <div class="row">

            @extends('fixed.admin-navigation')

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="content">
                    <div id="admin-panel" class="col-md-12 mt-5">
                        <h1>Basket</h1>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-6">
                                    <h3>Sort by date:</h3>
                                    <form action="{{ route("admin.sort-basket") }}" method="POST">
                                        @csrf
                                        <select class="form-control " name="sort">
                                            <option value="asc" @if($sortType=="asc") selected @endif>Asc</option>
                                            <option value="desc" @if($sortType=="desc") selected @endif>Desc</option>
                                        </select>
                                        <input type="submit" class="btn btn-secondary" value="Sort"/>
                                    </form>
                                </div>
                                <div class="col-6">
                                    <h3>Filter by user:</h3>
                                    <form action="{{ route("admin.filter-basket") }}" method="POST">
                                        @csrf
                                        <select class="form-control " name="name_user">
                                            @foreach($users as $u)
                                                <option value="{{ $u->id }}" @if($u->id == $id_user) selected @endif>{{ $u->first_name }}</option>
                                            @endforeach
                                        </select>
                                        <input type="submit" class="btn btn-secondary" value="Filter"/>
                                    </form>
                                </div>
                                <div class="col-6">
                                <a href="{{ route('admin.basket') }}" class="btn btn-info mb-3">See all</a>
                                </div>
                            </div>

                        </div>


                        <table class='table table-striped table-bordered'>
                            <thead class='thead-dark'>
                            <tr>
                                <th>ID</th>
                                <th>First name</th>
                                <th>Basket</th>
                                <th>Date</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total price</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($baskets as $b)
                                <tr>
                                    <td>
                                         {{ $b->id }}
                                    </td>
                                    <td>
                                        {{ $b->basket->user->first_name }}
                                    </td>
                                    <td>
                                        {{ $b->basket->id }}
                                    </td>
                                    <td>
                                        {{ $b->basket->datum}}
                                    </td>
                                    <td>
                                        {{ $b->product->name}}(#{{ $b->product->id }})
                                    </td>
                                    <td>
                                        @if($b->product->discounts->isNotEmpty())
                                            @php
                                                $discountedPrice = $b->price->price;
                                                foreach($b->product->discounts as $discount) {
                                                    if ($discount->active) {
                                                        $discountedPrice = $b->price->price - ($b->price->price * ($discount->amount / 100));
                                                        break;
                                                    }
                                                }
                                            @endphp
                                            {{ $discountedPrice }} $
                                        @else
                                            {{ $b->price->price }} $
                                        @endif
                                    </td>
                                    <td>
                                        {{ $b->quantity}}
                                    </td>
                                    <td>
                                        @if($b->product->discounts->isNotEmpty())
                                            @php
                                                $discountedPrice = $b->price->price;
                                                foreach($b->product->discounts as $discount) {
                                                    if ($discount->active) {
                                                        $discountedPrice = $b->price->price - ($b->price->price * ($discount->amount / 100));
                                                        break;
                                                    }
                                                }
                                                $totalPrice = $discountedPrice * $b->quantity;
                                            @endphp
                                            {{ $totalPrice }} $
                                        @else
                                            {{ $b->price->price * $b->quantity }} $
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection

