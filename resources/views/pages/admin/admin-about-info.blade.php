@extends('layouts.admin-layout')

@section('content')
    <body>
    <div class="container-fluid">
        <div class="row">

            @extends('fixed.admin-navigation')

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="content">
                    <div id="admin-panel" class="col-md-12 mt-5">
                        <h2>About information</h2>
                        @if(session('success'))
                            <div class="alert alert-success" >
                                {{ session('success') }}
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-error" >
                                {{ session('error') }}
                            </div>
                        @endif
                        <table class='table table-striped table-bordered'>
                            <thead class='thead-dark'>
                            <tr>
                                <th>Id:</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                                    @foreach($aboutInfo as $ai)
                                        <form action="{{ route('admin.about-info-store') }}" method="POST">
                                            @csrf
                                            @method('POST')
                                        <tr>
                                            <td>{{ $ai->id }}</td>
                                            <td>
                                                <input type="text" class="form-control" hidden id="info_id" name="info_id" value="{{ $ai->id }}" />
                                                <input type="text" class="form-control" id="info_title" name="info_title" value="{{ $ai->title }}" />
                                            </td>
                                            <td>
                                                <textarea class="form-control" name="info_description" id="info_description" cols="30" rows="10">{{ $ai->description }}</textarea>
                                            </td>
                                            <td>
                                                <input type="submit" value="Update" class="btn-danger btn" />
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

