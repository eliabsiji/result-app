@extends('layouts.master')
@section('content')
<div class="content">
            <div class="content-header">

                <div class="leftside-content-header">
                    <ul class="breadcrumbs">
                        <li><i class="fa fa-columns" aria-hidden="true"></i><a href="{{ route('users.index') }}">User Management</a></li>
                        <li><a>Add New User</a></li>
                    </ul>
                </div>
            </div>
            @if (count($errors) > 0)
            <div class="row animated fadeInUp">
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
            </div>
               @endif
                <div class="col-sm-12 col-md-8 col-md-offset-2">
                   <span class="float-right">
                    <a class="btn btn-primary" href="{{ route('users.index') }}"> Back to Users</a>
                </span>
                    <div class="panel">
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <form  role="form" id="inline-validation" class="form-horizontal form-stripe" action="{{ route('users.store') }}" method="POST">
                                     @csrf
                                        <div class="form-group">
                                            <label for="name" class="col-sm-3 control-label">Name<span class="required">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="username" class="col-sm-3 control-label">Email<span class="required">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="password" class="col-sm-3 control-label">Password<span class="required">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="cofirmation" class="col-sm-3 control-label">Confirm Password<span class="required">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control" id="cofirmation" name="password_confirmation"  placeholder="Password Confirmation" required>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label for="select2-example-multiple" class="col-sm-3 control-label">Role<span class="required">*</span></label>
                                            <div class="col-sm-9">
                                                <select name ="roles[]" id="select2-example-multiple" class="form-control" multiple="multiple" >
                                                    @foreach ($roles as $role => $name )
                                                     <option value="{{$name}}">{{ $name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-9">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @endsection
