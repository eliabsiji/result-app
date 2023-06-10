@extends('layouts.master')
@section('content')

     <!-- Start Page title and tab -->
     <div class="section-body">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center ">
                <div class="header-action">
                    <h1 class="page-title">School</h1>
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">School House</a></li>
                        <li class="breadcrumb-item active" aria-current="page">School House</li>
                    </ol>
                </div>
                <ul class="nav nav-tabs page-header-tab">

                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#schoolhouses"></a></li>


                    @can('add-subject')
                    <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#student-add"> </a></li>
                    @endcan
                    @can('subject-class-list')
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#classsubject"></a></li>
                    @endcan

                    @can('add-student')
                    <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#schoolhouse-add">New School House </a></li>
                    @endcan
                    @can('subject-class-list')
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#classsubject"></a></li>
                    @endcan

                    @can('assign-subject-class')
                    <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#student-add"> </a></li>
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
        @if (\Session::has('danger'))
        <div class="alert alert-danger alert-dismissible">
         <button type="button" class="close" data-dismiss="alert"></button>
             <p>{{ \Session::get('danger') }}</p>
         </div>
     @endif

     @if (count($errors) > 0)

     <div class="alert alert-success alert-dismissible">
         <button type="button" class="close" data-dismiss="alert"></button>
         <strong>Opps!</strong> Something went wrong, please check where you  add data .<br><br>
         <ul>
             @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
             @endforeach
         </ul>
     </div>
 @endif
    </div>
    <div class="section-body mt-4">
        <div class="container-fluid">
            <div class="tab-content">


                <div class="tab-pane active" id="student-edit">
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12">


                            <a class="btn btn-primary" href="{{ route('schoolhouse.index') }}"> Back to school house</a>

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Edit School House Info</h3>
                                    <div class="card-options ">
                                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                        <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                                    </div>
                                </div>


                                <div class="card">
                                    <div class="card-body">
                                        <?php
                                        foreach ($schoolhouses as $key => $value) {
                                            # code...
                                             $value->shid;
                                        }
                                        ?>
                                        {!! Form::model($schoolhouses, ['route' => ['schoolhouse.update', $value->shid], 'method'=>'PATCH','class'=>'form-horizontal form-stripe']) !!}
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">House Name <span class="text-danger">*</span></label>
                                            <div class="col-md-7">
                                               <input type="text" name="house" id="house" class="form-control" value="{{ $value->house }}" placeholder="House Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">House Colour <span class="text-danger">*</span></label>
                                            <div class="col-md-7">
                                               <input type="text" name="housecolour" id="housecolour" class="form-control"  value="{{ $value->housecolour }}" placeholder="House Colour" required>
                                            </div>
                                        </div>

                                         <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Select House Master <span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <select name ="housemasterid" id="housemasterid"  class="form-control" >
                                                        @if ($value->userid == "")
                                                        <option value="">Select House Master</option>
                                                        @else
                                                            <option value="{{ $value->userid }}" selected>Select  House Master</option>
                                                        @endif
                                                           @foreach ($staff as $s => $name )
                                                         <option value="{{$name->userid}}">{{ $name->name }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $name->arm}} </option>
                                                        @endforeach
                                                    </select> [ Previously Selected: <span style="color: blue ">   {{ $value->housemaster }} </span>]
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Select Term <span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <select name ="termid" id="termid"  class="form-control" >
                                                        @if ($value->term == "")
                                                        <option value="">Select Term</option>
                                                        @else
                                                            <option value="{{ $value->termid }}" selected>Select  Term </option>
                                                        @endif
                                                        @foreach ($schoolterm as $term => $name )
                                                         <option value="{{$name->id}}">{{ $name->term}}</option>
                                                        @endforeach
                                                    </select>[ Previously Selected: <span style="color: blue ">  {{  $value->term }}  </span> ]
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Select Current Session <span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <select name ="sessionid" id="sessiionid"  class="form-control" >
                                                        @if ($value->sessionid == "")
                                                        <option value="">Select Session</option>
                                                        @else
                                                            <option value="{{ $value->sessionid }}" selected>Select  Session </option>
                                                        @endif
                                                        @foreach ($schoolsession as $schoolsession => $name )
                                                         <option value="{{$name->id}}">{{ $name->session}}</option>
                                                        @endforeach
                                                    </select>[ Previously Selected: <span style="color: blue ">  {{  $value->session  }} </span> ]
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label"></label>
                                                <div class="col-md-7">
                                                    <button type="submit" class="btn btn-primary">Update Data</button>

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
        </div>
    </div>


    <script>




        function check(id){

            var id = id;
            var spinner = $('#loader');

          Swal.fire({
          title: 'Are you sure?',
          text: "Deleting this record will affect other associated records (e.g Any Record where this Class Subject is featured)",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            spinner.show();
            $.ajax({

                url: 'ajaxschoolhouse/'+id,
                async: false,
                type: "DELETE",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}',
                   id: id
                },
                dataType: 'JSON',

            }).done(function(resp) {
          spinner.hide();

            });
            Swal.fire(
              'Deleted!',
              'This Record is now  Deleted. You can Check Other Records to make neccessary Editing!',
              'success'
            )

            var myobj = document.getElementById("sid"+id);
             myobj.remove();

          }
        })

  }
        </script>
    @endsection
