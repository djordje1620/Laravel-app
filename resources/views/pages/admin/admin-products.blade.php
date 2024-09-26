@extends('layouts.admin-layout')

@section('content')
    <body>
    <div class="container-fluid">
        <div class="row">

            @extends('fixed.admin-navigation')

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="content">
                    <div id="admin-panel" class="col-md-12 mt-5">
                        <div class="row">
                            @if(request()->is('admin-products'))
                            <div class="col-md-4">
                                <h2>Add new product</h2>
                                @if(session('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <form action="{{ route('admin.add-product') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group">
                                        <label for="product_name">Product name:</label>
                                        <input type="text" class="form-control" id="product_name" name="product_name">
                                    </div>

                                    <div class="form-group">
                                        <label for="brand">Brand:</label>
                                        <select class="custom-select" name="brand">
                                            <option value="0" selected>Select</option>
                                            @foreach($brands as $b)
                                                <option value="{{ $b->id }}">{{ $b->brand }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="screens">Screens:</label>
                                        <select class="custom-select" name="screens">
                                            <option value="0" selected>Select</option>
                                            @foreach($screens as $s)
                                                <option value="{{ $s->id }}">{{ $s->screen }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Choose image:</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image" name="image">
                                            <label class="custom-file-label" for="image">Choose file</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="colors">Colors:</label>
                                        <select class="custom-select" name="colors_product">
                                            <option value="0" selected>Select</option>
                                            @foreach($colors as $c)
                                                <option value="{{ $c->id }}">{{ $c->value }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="ram">Ram memory:</label>
                                        <select class="custom-select" name="ram_memory" id="ram_memory">
                                            <option value="0" selected>Select</option>
                                            @foreach($rams as $r)
                                                <option value="{{ $r->id }}">{{ $r->value }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="internal_memory">Internal memory:</label>
                                        <select class="custom-select" name="internal_memory">
                                            <option value="0" selected>Select</option>
                                            @foreach($internals as $i)
                                                <option value="{{ $i->id }}">{{ $i->value }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="product_price">Price:</label>
                                        <input type="number" class="form-control" id="product_price" name="product_price">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Add product</button>
                                </form>

                            </div>
                            @endif
                            @if(request()->is('admin-products-update/*'))
                            <div class="col-md-4">
                                <h2>Update product</h2>
                                @if(session('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif


                                <form action="{{ route('admin.add-product-store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')

                                    @foreach($products as $product)
                                    <div class="form-group">
                                        <label for="new_product_name">Product name:</label>
                                        <input type="text" class="form-control" id="new_product_name" hidden value="{{ $product->id }} " name="product_id">
                                        <input type="text" class="form-control" id="new_product_name" value="{{ $product->name  }} " name="new_product_name">
                                    </div>

                                    <div class="form-group">
                                        <label for="new_brand">Brand:</label>
                                        <select class="custom-select" name="new_brand">
                                            <option value="0" selected>Select</option>
                                            @foreach($brands as $b)
                                                <option value="{{ $b->id }}" @if($b->id==$product->brand->id) selected @endif>{{ $b->brand }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="new_screens">Screens:</label>
                                        <select class="custom-select" name="new_screens">
                                            <option value="0" selected>Select</option>
                                            @foreach($screens as $s)
                                                <option value="{{ $s->id }}" @if($s->id== $product->screen_id) selected @endif>{{ $s->screen }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="new_image">Choose image:</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="new_image" name="new_image">
                                            <label class="custom-file-label" for="image">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="new_colors">Colors:</label>
                                        <select class="custom-select" name="new_colors">
                                            <option value="0" >Select</option>
                                            @foreach($colors as $c)
                                                      @foreach($product->colors as $color)
                                                         <option value="{{ $c->id }}" @if($c->id== $color->id) selected @endif>{{ $c->value }}</option>
                                                      @endforeach
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="new_ram">Ram memory:</label>
                                        <select class="custom-select" name="new_ram" id="new_ram">
                                            <option value="0" >Select</option>
                                            @foreach($rams as $r)
                                                @foreach($product->rams as $ram)
                                                    <option value="{{ $r->id }}" @if($r->id== $ram->id) selected @endif>{{ $r->value }}</option>
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="new_internal_memory">Internal memory:</label>
                                        <select class="custom-select" name="new_internal_memory">
                                            <option value="0" >Select</option>
                                            @foreach($internals as $i)
                                                @foreach($product->internals as $int)
                                                    <option value="{{ $i->id }}" @if($i->id== $int->id) selected @endif>{{ $i->value }}</option>
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="new_price">Price:</label>
                                        @foreach($product->prices as $price)
                                            @if($price->active==1)
                                                <input type="number" class="form-control" id="new_price" value="{{ $price->price }}"  name="new_price">
                                            @endif
                                        @endforeach
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update product</button>
                                    @endforeach
                                </form>

                            </div>
                            @endif
                        </div>


                        <h2>Products</h2>
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Brand</th>
                                <th>Screen</th>
                                <th>Image</th>
                                <th>Color</th>
                                <th>Internal memory</th>
                                <th>RAM memory</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($products as $p)
                                <tr>
                                    <td>#{{ $p->id }}</td>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ $p->brand->brand }}</td>
                                    <td>{{ $p->screen->screen }}</td>
                                    <td>{{ $p->image }}</td>
                                    <td>
                                        @foreach($p->colors as $color)
                                            {{ $color->value }}
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($p->internals as $internal)
                                            {{ $internal->value }}GB
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($p->rams as $ram)
                                            {{ $ram->value }}GB
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($p->prices as $price)
                                            @if($price->active)
                                                {{ $price->price }}$
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach( $p->discounts as $discount)
                                            @if($discount->active==1)
                                                {{ $discount->amount }} %
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.product.remove',['id'=>$p->id]) }}" class="btn-danger btn">Remove</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.add-update',['id'=>$p->id]) }}" class="btn-success btn">Edit</a>
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

