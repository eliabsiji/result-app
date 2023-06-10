@extends('layouts.master')
@section('content')
  
       <div class="content">
            <div class="content-header">
            
                <div class="leftside-content-header">
                    <ul class="breadcrumbs">
                        <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">User Management</a></li>
                        <li><a>Role Management</a></li>
                       
                    </ul>
                </div>
            </div>
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
                       
                        @can('role-create')
                    <span class="float-right">
                        <a class="btn btn-primary" href="{{ route('roles.create') }}">New Role</a>
                    </span>
                     @endcan
                            <table id="responsive-table" class="data-table table table-striped table-hover responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                   <th>#</th>
                                    <th>Name</th>
                                    <th width="280px">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                 
                                   @foreach ($data as $key => $role)
                                 <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <a class="btn btn-success" href="{{ route('roles.show',$role->id) }}">Show</a>
                                    @can('role-edit')
                                        <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                                    @endcan
                                    @can('role-delete')
                                        {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
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