@extends('layouts.admin-layout')

@section('content')
    <body>
    <div class="container-fluid">
        <div class="row">

            @extends('fixed.admin-navigation')

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="content">
                    <h2 class="mb-4">Enter a new color</h2>
                    <form action="{{ route('color-add') }}" method="POST">
                        @csrf
                        @method("POST")
                        <div class="mb-3">
                            <label for="color" class="form-label">Color name</label>
                            <input type="text" class="form-control" name="color_name" placeholder="Enter color name">
                        </div>
                        <div class="mb-3">
                            <label for="hex" class="form-label">Title</label>
                            <input type="text" class="form-control" name="hex" placeholder="Enter color HEX">
                        </div>
                        <button type="submit" class="btn btn-success">Add color</button>
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
                    <a href="" class="btn-primary btn" id="color"> Show colors</a>
                    <div id="admin-panel" class="col-md-12 mt-5">

                    </div>
                </div>
            </main>
        </div>
    </div>
    @endsection
    @section('scripts')
        <script>
            const baseUrl = "{{url('/')}}"
        </script>
@endsection
