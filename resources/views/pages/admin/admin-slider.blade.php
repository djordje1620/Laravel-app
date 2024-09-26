@extends('layouts.admin-layout')

@section('content')
    <body>
    <div class="container-fluid">
        <div class="row">

            @extends('fixed.admin-navigation')

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="content">
                    <h2 class="mb-4">Edit slider</h2>

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
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Subtitle</th>
                            <th>Description</th>
                            <th>Active slide</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($sliders as $s)
                            <form action="{{ route("admin.slider.store") }}" method="POST">
                                @csrf
                                @method('POST')
                                <tr>
                                    <td>#{{ $s->id }}
                                        <input type="text" name="id_slide" hidden value="{{ $s->id }}">
                                    </td>

                                    <td><input type="text" name="title" value="{{ $s->title }}"></td>
                                    <td><input type="text" name="subtitle" value="{{ $s->subtitle }}"></td>
                                    <td>
                                        <textarea name="description" cols="40" rows="10">{{ $s->description }}</textarea>
                                    </td>
                                    <td>
                                        @if($s->activeClass==0)
                                            <a href="{{ route('admin.slider.activate',['id'=>$s->id]) }}" class="btn btn-info">Activate</a>
                                        @else
                                            <input type="button" disabled class="btn btn-info" value="Activate">
                                        @endif
                                    </td>
                                    <td>
                                        <input type="submit" class="btn btn-success" value="Update">
                                    </td>
                                </tr>
                            </form>

                        @endforeach

                        </tbody>
                    </table>

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
