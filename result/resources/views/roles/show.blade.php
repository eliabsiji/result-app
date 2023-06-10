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
                        <li class="breadcrumb-item active" aria-current="page">Roles</li>
                    </ol>
                </div>
                <ul class="nav nav-tabs page-header-tab">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#edit-user">Show Roles</a></li>

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
           <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"></button>
                <p>{{ \Session::get('success') }}</p>
            </div>
        @endif

    </div>
    <div class="section-body mt-4">
        <div class="container-fluid">
            <div class="tab-content">
                <div class="tab-pane active" id="edit-user">
                     @can('role-create')
                    <span class="float-left">
                        <a class="btn btn-primary" href="{{ route('roles.index') }}">Back</a>
                    </span>
                @endcan
                    <div class="card">
                        <div class="lead">
                            <strong>Name:</strong>
                            {{ $role->name }}
                        </div>
                        <div class="lead">
                            <strong>Permissions:</strong>
                            @if(!empty($rolePermissions))
                                @foreach($rolePermissions as $permission)
                                    <label class="badge badge-success">{{ $permission->name }}</label>
                                @endforeach
                            @endif
                        </div>
                    </div>

                </div>

                <div class="tab-pane" id="Library-add-Boot">

                </div>
            </div>
        </div>
    </div>
    @endsection
