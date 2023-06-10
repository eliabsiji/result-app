@extends('layouts.master')
@section('content')
<div class="content">
            <div class="content-header">

                <div class="leftside-content-header">
                    <ul class="breadcrumbs">
                        <li><i class="fa fa-columns" aria-hidden="true"></i><a href="{{ route('schoolarm.index') }}">School Arm Management</a></li>
                        <li><a>Edit Arm</a></li>
                    </ul>
                </div>
            </div>
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
        @endif
                <div class="col-sm-12 col-md-8 col-md-offset-2">
                   <span class="float-right">
                    <a class="btn btn-primary" href="{{ route('schoolarm.index') }}"> Back to School Arm Management</a>
                </span>
                    <div class="panel">
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! Form::model($sarm, ['route' => ['schoolarm.update', $sarm->id], 'method'=>'PATCH','class'=>'form-horizontal form-stripe']) !!}


                                        <div class="form-group">
                                            <label for="username" class="col-sm-3 control-label">Class Arm<span class="required">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="arm" name="arm" placeholder="Class Arm" value="{{ $sarm->arm }}" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="password" class="col-sm-3 control-label">Remark<span class="required">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="description" name="description" placeholder="Remark" value="{{ $sarm->description }}" required>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-9">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @endsection
