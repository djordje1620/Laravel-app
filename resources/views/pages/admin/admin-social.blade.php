@extends('layouts.admin-layout')

@section('content')
    <body>
    <div class="container-fluid">
        <div class="row">

            @extends('fixed.admin-navigation')

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="content">
                    <h2 class="mb-4">Enter a new social network</h2>
                    <form action="{{ route('admin.socials.add') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <label for="socialName" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter social network name">
                        </div>
                        <div class="mb-3">
                            <label for="socialLink" class="form-label">Link</label>
                            <input type="text" class="form-control" id="link" name="link" placeholder="Enter social network link">
                        </div>
                        <div class="mb-3">
                            <label for="socialIcon" class="form-label">Icon</label>
                            <input type="text" class="form-control" id="icon" name="icon" placeholder="Enter social network icon">
                        </div>
                        <button type="submit" class="btn btn-success">Add social network</button>
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
                    <a href="" class="btn-primary btn" id="social"> Show socials network</a>
                    <div id="admin-panel" class="col-md-12 mt-5">
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection

