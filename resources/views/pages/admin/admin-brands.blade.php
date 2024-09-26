@extends('layouts.admin-layout')

@section('content')
    <body>
    <div class="container-fluid">
        <div class="row">

            @extends('fixed.admin-navigation')

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="content">
                    <div id="admin-panel" class="col-md-12 mt-5">
                        <h2>Add new brand</h2>
                        <form action="{{ route('admin.brand.store') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <input type="text" class="form-control" name="brandName" id="brandName" placeholder="Enter brand name">
                            </div>
                            <button type="submit" class="btn btn-primary">Add brand</button>
                        </form>
                        @if(session('success'))
                            <div class="alert alert-success" >
                                {{ session('success') }}
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger" >
                                {{ session('error') }}
                            </div>
                        @endif
                        <h2>Brands</h2>
                        <table class='table table-striped table-bordered'>
                            <thead class='thead-dark'>
                            <tr>
                                <th>Id:</th>
                                <th>Brand name</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($brands as $brand)
                                <form action="{{ route('admin.brand.delete') }}" method="POST">
                                 @csrf
                                 @method('POST')
                                    <tr>
                                        <td>{{ $brand->id }}</td>
                                        <td>
                                            <input type="text" class="form-control" hidden value="{{$brand->id}}" name="brand_id" id="brand_id">
                                           {{$brand->brand}}
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-danger">Remove</button>
                                        </td>
                                    </tr>
                                </form>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection

