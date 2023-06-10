@extends('layouts.master')
@section('content')

       <div class="content">
            <div class="content-header">

                <div class="leftside-content-header">
                    <ul class="breadcrumbs">
                        <li><i class="fa fa-table" aria-hidden="true"></i><a href="{{ route('users.index') }}">User Management</a></li>
                        <li><a>Users</a></li>

                    </ul>
                </div>
            </div>
             @if (\Session::has('status'))
           <div class="alert alert-warning fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
                <p>{{ \Session::get('status') }}</p>
            </div>
        @endif
            @if (\Session::has('success'))
           <div class="alert alert-warning fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
                <p>{{ \Session::get('success') }}</p>
            </div>
        @endif
            <div class="row animated fadeInRight">

                <div class="card">

                <div class="col-sm-12">

                    <div class="panel">
                        <div class="panel-content">
                        <a class="btn btn-primary" href="{{ route('users.create') }}">New User</a>
                            <table id="responsive-table" class="data-table table table-striped table-hover responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                   <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th width="280px">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                   @foreach ($data as $key => $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @if(!empty($user->getRoleNames()))
                                                        @foreach($user->getRoleNames() as $val)
                                                            <label class="badge badge-dark">{{ $val }}</label>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-success" href="{{ route('users.show',$user->id) }}">Show</a>
                                                    @can('user-edit')
                                                        <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                                                    @endcan
                                                    @can('user-delete')
                                                        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                        {!! Form::close() !!}
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
