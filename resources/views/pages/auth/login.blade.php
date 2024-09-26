@extends('layouts.layout')

@section('content')
    <div class="brand_color">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Login</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">If you don't have an account, <a href="{{ route('registration') }}">register</a></div>
                    <div class="card-body">
                        <form action="{{ route('logIn') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label for="username">Email:</label>
                                <input type="email" class="form-control" value="{{ old('email') }}" id="email" name="email" >
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" >
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                        @if ($errors->any())
                            <div class="my-3 alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
