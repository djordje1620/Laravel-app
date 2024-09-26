@extends('layouts.admin-layout')

@section('content')
<body>
<div class="container-fluid">
    <div class="row">

        @extends('fixed.admin-navigation')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="content">
                <h2>Dashboard</h2>
                <p>Welcome to the admin panel.</p>
                <hr/>

                <div id="admin-panel" class="col-md-12 mt-5">
                    <h2>Messages</h2>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Message
                            <th>Ip address</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($messages as $m)
                            <tr>
                                <td>{{ $m->name}}</td>
                                <td>{{ $m->email}}</td>
                                <td>{{ $m->phone}}</td>
                                <td>{{ $m->message}}</td>
                                <td>{{ $m->ip_address}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>


                    <h2>User Actions</h2>
                    <form action="{{ route('admin.panel-sort') }}" method="POST">
                        @csrf
                        <div class="col-4">
                            <label for="sort">Sort user activity by date:</label>
                            <select class="form-control" name="sort" id="sort">
                                <option value="asc" @if($sortType=="asc") selected @endif>ASC</option>
                                <option value="desc" @if($sortType=="desc") selected @endif>DESC</option>
                            </select>
                            <input type="submit" class="btn btn-secondary" value="Sort"/>

                        </div>
                    </form>

                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>User</th>
                                <th>Email</th>
                                <th>Action</th>
                                <th>Action Time</th>
                                <th>IP Address</th>
                                <th>Device Type</th>
                                <th>Browser</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($actions as $action)
                                <tr>
                                    <td>{{ $action->user->first_name }}</td>
                                    <td>{{ $action->user->email }}</td>
                                    <td>{{ $action->action }}</td>
                                    <td>{{ $action->action_time }}</td>
                                    <td>{{ $action->ip_address }}</td>
                                    <td>{{ $action->device_type }}</td>
                                    <td>{{ $action->browser }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                </div>
                <a href="" class="btn btn-info" id="showChart">Show statistics</a>
                <div class="col-md-4 mt-5" id="chart">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection

