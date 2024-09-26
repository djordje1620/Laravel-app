@extends('layouts.admin-layout')

@section('content')
    <body>
    <div class="container-fluid">
        <div class="row">

            @extends('fixed.admin-navigation')

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="content">
                    <div id="admin-panel" class="col-md-12 mt-5">
                        <h2>Add new discount</h2>
                        <form action="{{ route('admin.discount.add') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="mb-3" >
                                <div class="col-4">
                                    <input type="text" class="form-control" name="discount_amount" id="discount_amount" placeholder="Enter discount amount">
                                </div>
                                <div class="col-4">
                                    <select class="form-control" name="product_discount" id="product_discount" >
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Add discount</button>
                             </div>
                        </form>
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if(session('success_dicount'))
                            <div class="alert alert-success">
                                {{ session('success_dicount') }}
                            </div>
                        @endif
                        @if(session('error_discount'))
                            <div class="alert alert-danger">
                                {{ session('error_discount') }}
                            </div>
                        @endif
                        <h2>Discount</h2>
                        <table class='table table-striped table-bordered'>
                            <thead class='thead-dark'>
                            <tr>
                                <th>Id:</th>
                                <th>Amount</th>
                                <th>Start date</th>
                                <th>End date</th>
                                <th>Product-ID</th>
                                <th>Active</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($discounts as $d)
                                <tr>
                                    <td>{{ $d->id }}</td>
                                    <td>
                                       {{ $d->amount }} %
                                    </td>
                                    <td>
                                        {{ $d->start_date }}
                                    </td>
                                    <td>
                                        @if($d->end_date==null)
                                           /
                                        @else
                                            {{ $d->end_date }}
                                        @endif
                                    </td>
                                    <td>
                                        <input type="text" hidden name="discount_id" value="{{ $d->id}}"/>

                                        {{ $d->product->name }} - {{ $d->product->id }}
                                    </td>
                                    <td>
                                        @if($d->active==1)
                                            <a href="{{ route('admin.discount.inactive',['discount'=>$d->id, 'product'=>$d->product->id]) }}"  class=" ml-3 btn-danger btn">Inactive discount</a>
                                        @else
                                            <a href="{{ route('admin.discount.active',['discount'=>$d->id, 'product'=>$d->product->id]) }}"  class=" ml-3 btn-success btn">Active discount</a>
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

