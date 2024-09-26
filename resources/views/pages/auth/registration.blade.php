@extends('layouts.layout')

@section('content')
    <div class="brand_color">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Registration</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Register</div>
                    <div class="card-body">
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label for="first_name">First name:</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" />
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last name:</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" />
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" />
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" />
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password:</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" />
                            </div>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </form>
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
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
