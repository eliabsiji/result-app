@extends('layouts.master')
@section('content')

     <!-- Start Page title and tab -->
     <div class="section-body">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center ">
                <div class="header-action">
                    <h1 class="page-title">School</h1>
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Session </a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Session </li>
                    </ol>
                </div>
                <ul class="nav nav-tabs page-header-tab">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#edit-session">Edit Session </a></li>

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
                <div class="tab-pane active" id="edit-seesion">
                    <div class="card">
                        <div class="card-header">
                            <a class="btn btn-primary" href="{{ route('session.index') }}"> Back to School Session</a>
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

                        {!! Form::model($session, ['route' => ['session.update', $session->id], 'method'=>'PATCH','class'=>'form-horizontal form-stripe']) !!}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Session Name <span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" id="session" name="session" placeholder="session"  value="{{ $session->session }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label"> Session Status<span class="text-danger">*</span></label>
                            <div class="col-md-7">

                                <select name ="status" id="status"  class="form-control"  required>
                                    <option value="" selected>Select Session</option>
                                    <option value="Current">Current</option>
                                    <option value="Past">Past</option>
                                     </select>[  {{ $session->status }} ]

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
