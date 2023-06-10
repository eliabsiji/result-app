@extends('layouts.master')
@section('content')

     <!-- Start Page title and tab -->
     <div class="section-body">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center ">
                <div class="header-action">
                    <h1 class="page-title">School</h1>
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">My Class</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Student</li>
                    </ol>
                </div>
                <ul class="nav nav-tabs page-header-tab">
                    @can('view-student-list')
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#student">List View</a></li>
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
     <hr>
     <a class="btn btn-primary" href="{{ route('myclass.index') }}"> Back </a>
     <hr>
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
    <div class="row clearfix">
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="widgets1">
                    <div class="icon">
                        <i class="icon-heart text-success font-30"></i>
                    </div>
                    <div class="details">
                        <h6 class="mb-0 font600">Total</h6>
                        <span class="mb-0">{{ $studentcount }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="widgets1">
                    <div class="icon">
                        <i class="icon-user text-success font-30"></i>
                    </div>
                    <div class="details">
                        <h6 class="mb-0 font600">Male</h6>
                        <span class="mb-0">{{ $male }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="widgets1">
                    <div class="icon">
                        <i class="icon-user text-success font-30"></i>
                    </div>
                    <div class="details">
                        <h6 class="mb-0 font600">Female</h6>
                        <span class="mb-0">{{ $female }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="widgets1">
                    <div class="icon">
                        <i class="icon-user text-success font-30"></i>
                    </div>
                    <div class="details">
                        <h6 class="mb-0 font600">Attendance</h6>
                        <span class="mb-0">{{ $female }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div role="tabpanel" class="tab-pane vivify fadeIn active" id="All" aria-expanded="false">
        <div class="table-responsive">
            <table class="table table-hover card-table table_custom">
                <tbody>
                    <tr class="" >
                        <?php
                       // $session = "";
                       // $term = "";
                     foreach($session as $s){
                        $session =  $s->session;
                    }

                    foreach($term as $s){
                        $term =  $s->term;
                    }

                    foreach($schoolclass as $s){
                        $schoolclass =  $s->schoolclass;
                        $schoolarm = $s->arm;
                    }
                    ?>
                        <td>

                            <h6>Class Record for <b>{{ $schoolclass }}  ({{ $schoolarm }})  {{ $term }} {{ $session }}</b></h6>

                        </td>
                        <td>
                            <span class="badge badge-success"><i class="fa fa-eye"></i> {{$studentcount}}</span>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
    </div>
    <div class="tab-content mt-3">

    <div class="section-body mt-4">
        <div class="container-fluid">
            <div class="tab-content">



                <div class="tab-pane active" id="student">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-striped table_custom">
                                    <thead>

                                            <tr>
                                                <th>SN</th>
                                                <th>Admin NO.</th>
                                                <th>First Name</th>
                                                <th>Last name</th>
                                                <th></th>
                                                <th>Gender</th>
                                                <th>Action</th>

                                            </tr>

                                    </thead>
                                    <tbody>
                                        <?php $sn = 1; ?>
                                     @foreach ($allstudents as $sc)
                                     <tr id="sid{{ $sc->id }}">
                                         <td>{{ $sn++ }}</td>
                                         <td>{{ $sc->admissionno }} </td>
                                         <td>{{ $sc->firstname }} </td>
                                         <td> {{ $sc->lastname }} {{ $sc->othername }}</td>

                                          <?php

                                         if ($sc->picture == NULL || $sc->picture =="" || !isset($sc->picture) ){

                                               // $cimage =  $imageclass;
                                                $image =  'unnamed.png';
                                         }else {

                                            $image =  $sc->picture;
                                         }

                                         ?>
                                         <td><img  class = "avatar avatar-xm" src="{{ asset('images/studentpics/'.$image) }}"/></td>


                                         <td>{{ $sc->gender }}</td>
                                         <td><a href="/studentpersonalityprofile/{{ $sc->stid }}/{{ $schoolclassid }}/{{ $termid }}/{{ $sessionid }}"
                                             class="btn fa fa-eye" data-toggle="tooltip"
                                              title="Input Student's  Personality Profile">Personality Profile Edit</a>
                                        </td>


                                     </tr>

                                     @endforeach
                                     </tbody>
                                </table>
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

                url: 'ajaxsubclass/'+id,
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
