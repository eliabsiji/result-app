@extends('layouts.master')
@section('content')
<div class="content">
@if (\Session::has('success'))
            <div class="alert alert-success">
                <p>{{ \Session::get('success') }}</p>
            </div>
        @endif
            <div class="content-header">
                <div class="leftside-content-header">
                    <ul class="breadcrumbs">
                        <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Tables</a></li>
                        <li><a>Responsive</a></li>
                          
                    </ul>
                    
            </div>
            <div class="row animated fadeInRight">
                <div class="col-sm-12">
                    <div class="panel">
                        <div class="panel-content">
                            <div class="alert alert-warning m-none">
                               
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
            <div class="card-header">Users
                <span class="float-right">
                    <a class="btn btn-primary" href="{{ route('users.create') }}">New User</a>
                </span>
            </div>
                <div class="col-sm-12">
                    <h4 class="section-subtitle"><b>Bootstrap</b> responsive</h4>
                    <p class="section-text">Wrap any <span class="code">.table</span> in <span class="code">.table-responsive</span> to make them scroll horizontally on small devices </p>
                    <div class="panel">
                        <div class="panel-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
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
                {{ $data->render() }}
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
@endsection