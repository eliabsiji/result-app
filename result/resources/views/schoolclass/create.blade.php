@extends('layouts.master')
@section('content')
  <div class="content">
            <div class="content-header">

                <div class="leftside-content-header">
                    <ul class="breadcrumbs">
                        <li><i class="fa fa-columns" aria-hidden="true"></i><a href="{{ route('schoolclass.index') }}">School Class Management</a></li>
                        <li><a>Add New School Class</a></li>
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
            <div class="alert alert-success fade in">
             <a href="#" class="close" data-dismiss="alert">&times;</a>
                 <p>{{ \Session::get('success') }}</p>
             </div>
            @endif

            @if (\Session::has('danger'))
            <div class="alert alert-danger fade in">
             <a href="#" class="close" data-dismiss="alert">&times;</a>
                 <p>{{ \Session::get('danger') }}</p>
             </div>
            @endif
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
                    <a class="btn btn-primary" href="{{ route('schoolclass.index') }}"> Back to School Class Management</a>
                </span>
                    <div class="panel">
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <form  role="form" id="inline-validation" class="form-horizontal form-stripe" action="{{ route('schoolclass.store') }}" method="POST">
                                     @csrf
                                        <div class="form-group">
                                            <label for="name" class="col-sm-3 control-label">Class<span class="required">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="schoolclass" name="schoolclass" placeholder="School class" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="col-sm-3 control-label">Select Class Arm<span class="required">*</span></label>
                                            <div class="col-sm-9">
                                         <select name ="arm" id="arm"  class="form-control" >
                                            <option value="0">Select Class Arm </option>
                                            @foreach ($arms as $arms => $name )
                                             <option value="{{$name->arm}}">{{ $name->arm }}</option>
                                            @endforeach
                                          </select>
                                            </div>
                                     </div>
                                        <div class="form-group">
                                            <label for="password" class="col-sm-3 control-label">Remark<span class="required">*</span></label>
                                            <div class="col-sm-9">
                                                <select name ="remark" id="remark"  class="form-control" >
                                                    <option value="0">Select Class Category</option>
                                                     <option>Junior School</option>
                                                     <option>Senior School</option>
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
