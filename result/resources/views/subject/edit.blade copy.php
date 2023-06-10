@extends('layouts.master')
@section('content')
<div class="content">
            <div class="content-header">

                <div class="leftside-content-header">
                    <ul class="breadcrumbs">
                        <li><i class="fa fa-columns" aria-hidden="true"></i><a href="{{ route('subject.index') }}">Subject Management</a></li>
                        <li><a>Edit Subject</a></li>
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
                    <a class="btn btn-primary" href="{{ route('subject.index') }}"> Back to Subject Management</a>
                </span>
                    <div class="panel">
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! Form::model($subject, ['route' => ['subject.update', $subject->id], 'method'=>'PATCH','class'=>'form-horizontal form-stripe']) !!}

                                        <div class="form-group">
                                            <label for="name" class="col-sm-3 control-label">Subject<span class="required">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="subject" name="subject" placeholder="subject"  value="{{ $subject->subject }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="username" class="col-sm-3 control-label">Subject Code<span class="required">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="subject_code" name="subject_code" placeholder="Subject Code" value="{{ $subject->subject_code }}" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="password" class="col-sm-3 control-label">Remark<span class="required">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="remark" name="remark" placeholder="Remark" value="{{ $subject->remark }}" required>
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
