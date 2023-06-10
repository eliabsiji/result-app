@extends('layouts.master')
@section('content')

     <!-- Start Page title and tab -->
     <div class="section-body">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center ">
                <div class="header-action">
                    <h1 class="page-title">School</h1>
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Student</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Subject Registration</li>
                    </ol>
                </div>
                <ul class="nav nav-tabs page-header-tab">
                    @can('student-list')
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#student">Subject Operations</a></li>
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
                                                 <th>Last Name </th>
                                                 <th></th>
                                                 <th>Gender</th>
                                                 <th>Register Subject</th>

                                            </tr>

                                    </thead>
                                    <tbody>
                                        <?php $sn = 1; ?>
                                     @foreach ($student as $sc)
                                        @if ($sc->cstatus == "CURRENT")


                                     <tr id="sid{{ $sc->id }}">
                                         <td>{{ $sn++ }}</td>
                                         <td>{{ $sc->admissionNo }} </td>
                                         <td>{{ $sc->firstname }} </td>
                                        <td>{{ $sc->lastname }}</td>
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

                                         <td>
                                             <div class="btn-group">
                                                 @can('subject-class-edit')
                                                 <a href="subjectinfo/{{ $sc->id }}/{{ $sc->schoolclassid }}/{{ $sc->sessionid }}/{{ $sc->termid }}" class="btn fa fa-pencil" data-toggle="tooltip" title=" Subject Info for {{ $sc->firstname  }} {{ $sc->lastname }}"> Register Subject</a>
                                                 @endcan
                                                 </div>
                                             <div class="btn-group">

                                     </td>

                                     </tr>
                                     @endif
                                     @endforeach
                                     </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="tab-pane" id="student-add">
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Create Student BioData Info</h3>
                                    <div class="card-options ">
                                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                        <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
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
