@extends('layouts.admin-layout')

@section('content')
    <body>
    <div class="container-fluid">
        <div class="row">

            @extends('fixed.admin-navigation')

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="content">
                    <h2 class="mb-4">Enter a new internal memory</h2>
                    <form action="{{ route('internal-add')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="internal_value" class="form-label">Value:</label>
                            <input type="text" class="form-control" name="internal_value" placeholder="Enter internal memory">
                        </div>
                        <button type="submit" class="btn btn-success">Add internal memory</button>
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
                    <a href="" class="btn-primary btn" id="internal"> Show internal memory</a>

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
