@extends('layouts.master')
@section('content')

     <!-- Start Page title and tab -->
     <div class="section-body">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center ">
                <div class="header-action">
                    <h1 class="page-title">Admin</h1>
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Roles</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Role</li>
                    </ol>
                </div>
                <ul class="nav nav-tabs page-header-tab">
                    @can('role-list')
                         <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#roles">List View</a></li>
                    @endcan

                    @can('role-create')
                         <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#role-add"></a></li>
                    @endcan
                    @can('role-list')
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#roles"></a></li>
               @endcan

               @can('role-create')
                    <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#role-add">Add</a></li>
               @endcan
               @can('role-list')
               <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#roles"></a></li>
          @endcan

          @can('role-create')
               <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#role-add"></a></li>
          @endcan

                </ul>
            </div>
        </div>
        @if (\Session::has('status'))
           <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"></button>
                <p>{{ \Session::get('status') }}</p>
            </div>
        @endif
            @if (\Session::has('success'))
           <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"></button>
                <p>{{ \Session::get('success') }}</p>
            </div>
        @endif

    </div>
    <div class="section-body mt-4">
        <div class="container-fluid">
            <div class="tab-content">
                <div class="tab-pane active" id="roles">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-striped table_custom   ">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Action</th>
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

                <div class="tab-pane" id="role-add">
                    <div class="card">
                        <div class="card-header">
                            @can('role-create')
                            <h3 class="card-title">Add Role</h3>
                            @endcan
                            @if (count($errors) > 0)
                            <div class="alert alert-warning fade in">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                                <strong>Opps!</strong> Something went wrong, please check below errors.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                            <div class="card-options ">
                                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                            </div>
                        </div>
                        {!! Form::open(array('route' => 'roles.store','method'=>'POST','class'=>'form-horizontal form-stripe')) !!}
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Name <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Permissions <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    @foreach($permission as $value)
                            <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                            {{ $value->name }}</label>
                        <br/>
                        @endforeach
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label"></label>
                                <div class="col-md-7">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="submit" class="btn btn-outline-secondary">Cancel</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
