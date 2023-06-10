@extends('layouts.master')
@section('content')

     <!-- Start Page title and tab -->
     <div class="section-body">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center ">
                <div class="header-action">
                    <h1 class="page-title">School</h1>
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Subject Teacher</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Subject Teacher </li>
                    </ol>
                </div>
                <ul class="nav nav-tabs page-header-tab">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#edit-subjectteacher">Edit Subject Teacher</a></li>

                </ul>
            </div>
        </div>

            @if (\Session::has('success'))
           <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"></button>
                <p>{{ \Session::get('success') }}</p>
            </div>
           @endif
           @if (\Session::has('danger'))
           <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"></button>
                <p>{{ \Session::get('danger') }}</p>
            </div>
           @endif

    </div>
    <div class="section-body mt-4">
        <div class="container-fluid">
            <div class="tab-content">
                <div class="tab-pane active" id="edit-subjectteacher">
                    <div class="card">
                        <div class="card-header">
                            <a class="btn btn-primary" href="{{ route('subjectteacher.index') }}"> Back to Subject Teacher</a>
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
                                    foreach($subjectteachers as $steachers) {
                                        $steachers->id;
                                        $steachers->staffname;
                                        $steachers->subjectname;
                                        $steachers->termname;
                                        $steachers->sessionname;

                                    }

                                    ?>
                         {!! Form::model($subjectteachers, ['route' => ['subjectteacher.update', $steachers->id], 'method'=>'PATCH','class'=>'form-horizontal form-stripe']) !!}
                         @csrf
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Select Teacher <span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <select name ="staffid" id="staffid"  class="form-control">

                                    @if ($steachers->userid == "")
                                    <option value="">Select Staff </option>
                                    @else
                                        <option value="{{ $steachers->userid }}" selected>Select  Staff </option>
                                    @endif


                                    @foreach ($staffs as $staff => $name )
                                     <option value="{{$name->userid}}">{{ $name->name }} </option>
                                    @endforeach
                                </select>[  {{ $steachers->staffname }} ]
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Select Subject<span class="text-danger">*</span></label>
                            <div class="col-md-7">

                                <select name ="subjectid" id="subjectid"  class="form-control" >

                                    @if ($steachers->subid == "")
                                    <option value="">Select Subject </option>
                                    @else
                                        <option value="{{ $steachers->subid }}" selected>Select  Subject </option>
                                    @endif

                                    @foreach ($subjects as $subject => $name )
                                     <option value="{{$name->id}}">{{ $name->subject }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $name->subject_code }} </option>
                                    @endforeach
                                </select>[  {{ $steachers->subjectname }} ]
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Select Term<span class="text-danger">*</span></label>
                            <div class="col-md-7">

                              <select name ="termid" id="termid"  class="form-control" >

                                @if ($steachers->termid == "")
                                    <option value="">Select Term </option>
                                    @else
                                        <option value="{{ $steachers->termid }}" selected>Select  Term</option>
                                    @endif

                                    @foreach ($terms as $term => $name )
                                    <option value="{{$name->id}}">{{ $name->term}}</option>
                                    @endforeach
                                </select>[  {{ $steachers->termname }} ]
                           </div>
                         </div>


                         <div class="form-group row">
                            <label class="col-md-3 col-form-label">Select Session<span class="text-danger">*</span></label>
                            <div class="col-md-7">
                         <select name ="sessionid" id="sessiionid"  class="form-control" >
                            @if ($steachers->sessionid == "")
                                    <option value="">Select Session </option>
                                    @else
                                        <option value="{{ $steachers->sessionid }}" selected>Select Session </option>
                                    @endif

                            @foreach ($schoolsessions as $schoolsession => $name )
                             <option value="{{$name->id}}">{{ $name->session}}</option>
                            @endforeach
                        </select>[  {{ $steachers->sessionname }} ]
                        </div>
                      </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label"></label>
                                <div class="col-md-7">
                                    <button type="submit" class="btn btn-primary">Update Subject Teacher</button>

                                </div>
                            </div>
                            {!! Form::close() !!}
                    </div>
                </div>


            </div>
        </div>
    </div>
    @endsection
