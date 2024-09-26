@extends('layouts.admin-layout')

@section('content')
    <body>
    <div class="container-fluid">
        <div class="row">

            @extends('fixed.admin-navigation')

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="content">
                    <div id="admin-panel" class="col-md-12 mt-5">
                          <h2>Users</h2>
                       <table class='table table-striped table-bordered'>
                           <thead class='thead-dark'>
                           <tr>
                               <th>Id:</th>
                               <th>First name</th>
                               <th>Last name</th>
                               <th>Email</th>
                               <th>Role</th>
                           </tr>
                           </thead>
                           <tbody>
                           @foreach($users as $user)
                               <tr>
                                   <td>{{ $user->id }}</td>
                                   <td>{{ $user->first_name }}</td>
                                   <td>{{ $user->last_name }}</td>
                                   <td>{{ $user->email }}</td>
                                   <td>{{ $user->role->role }}</td>
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

