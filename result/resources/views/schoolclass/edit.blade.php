@extends('layouts.master')
@section('content')

     <!-- Start Page title and tab -->
     <div class="section-body">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center ">
                <div class="header-action">
                    <h1 class="page-title">School</h1>
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Class </a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Class </li>
                    </ol>
                </div>
                <ul class="nav nav-tabs page-header-tab">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#edit-class">Edit Class </a></li>

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
                <div class="tab-pane active" id="edit-arm">
                    <div class="card">
                        <div class="card-header">
                            <a class="btn btn-primary" href="{{ route('schoolclass.index') }}"> Back to Class Teacher</a>
                            @if (count($errors) > 0)
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"></button>
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
                        <?php

                        foreach ($all_classes as $sclass) {
                            # code...
                           //echo  $sclass->categoryid;
                        }
                        ?>
                        {!! Form::model($sclass, ['route' => ['schoolclass.update', $sclass->id], 'method'=>'PATCH','class'=>'form-horizontal form-stripe']) !!}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Class <span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" id="schoolclass" name="schoolclass" placeholder="School Class"  value="{{ $sclass->schoolclass }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label"> Class Arm<span class="text-danger">*</span></label>
                            <div class="col-md-7">

                                <select name ="arm" id="arm"  class="form-control" required>
                                    @if ($sclass->arm == "")
                                    <option value="">Select Class Arm</option>
                                    @else
                                        <option value="{{ $sclass->arm }}" selected>Select Class Arm</option>
                                    @endif

                                    @foreach ($arms as $arm => $name )
                                     <option value="{{$name->arm}}">{{ $name->arm }} </option>
                                    @endforeach
                                </select>[ {{ $sclass->arm }} ]

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Class Category<span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <select name ="classcategoryid" id="classcategoryid"  class="form-control" required>
                                    @if ($sclass->categoryid == "")
                                    <option value="">Select Class Category</option>
                                    @else
                                        <option value="{{ $sclass->categoryid }}" selected>Select Class Category</option>
                                    @endif

                                    @foreach ($classcategories  as $arm => $name )
                                     <option value="{{$name->id}}">{{ $name->category }} </option>
                                    @endforeach
                                </select>[ {{ $sclass->classcategory }} ]
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
