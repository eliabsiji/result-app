@extends('layouts.master')
@section('content')

     <!-- Start Page title and tab -->
     <div class="section-body">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center ">
                <div class="header-action">
                    <h1 class="page-title">School</h1>
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Class Subject </a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Class Subject </li>
                    </ol>
                </div>
                <ul class="nav nav-tabs page-header-tab">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#edit-class">Edit Class Subject </a></li>

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
                            <a class="btn btn-primary" href="{{ route('subjectclass.index') }}"> Back to Class Subject</a>
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
                                foreach ($subjectclasses as $subjectclass ){
                                    $subjectclass->scid;

                                }
                                ?>
                        {!! Form::model($subjectclasses, ['route' => ['subjectclass.update', $subjectclass->scid], 'method'=>'PATCH','class'=>'form-horizontal form-stripe']) !!}
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Select Class & Arm <span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <select name ="schoolclassid" id="schoolclassid"  class="form-control" >

                                    @if ($subjectclass->sclassid == "")
                                    <option value="">Select Class and Arm </option>
                                    @else
                                        <option value="{{ $subjectclass->sclassid }}" selected>Select  class $ Arm </option>
                                    @endif


                                    @foreach ($schoolclasses as $schoolclass => $name )
                                     <option value="{{$name->id}}">{{ $name->schoolclass }} &nbsp; {{ $name->arm }}</option>
                                    @endforeach
                                </select>[  {{ $subjectclass->schoolclass }} &nbsp;&nbsp;  {{ $subjectclass->arm }} ]
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Select Subject<span class="text-danger">*</span></label>
                            <div class="col-md-7">

                                <select name ="subjectteacherid" id="subjectteacherid"  class="form-control">

                                    @if ($subjectclass->subteacherid == "")
                                    <option value="">Select Subject and Teacher</option>
                                    @else
                                        <option value="{{ $subjectclass->subteacherid }}" selected>Select Subject and Teacher</option>
                                    @endif
s
                                    @foreach ($subjectteachers as $subject => $name )
                                     <option value="{{$name->id}}">{{ $name->subject}} &nbsp; &nbsp;&nbsp; {{ $name ->subjectcode}}
                                         &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( {{ $name->title }} {{ $name->teachername }})</option>
                                    @endforeach
                                    </select>[  {{ $subjectclass->subject }} &nbsp;&nbsp;  {{ $subjectclass->subjectcode }} &nbsp; &nbsp;&nbsp;
                                     {{ $subjectclass->title }} {{ $subjectclass->teachername }} ]

                            </div>
                        </div>



                            <div class="form-group row">
                                <label class="col-md-3 col-form-label"></label>
                                <div class="col-md-7">
                                    <button type="submit" class="btn btn-primary">Update Class Subject</button>

                                </div>
                            </div>
                            {!! Form::close() !!}
                    </div>
                </div>


            </div>
        </div>
    </div>
    @endsection
