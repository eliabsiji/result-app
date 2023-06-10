@extends('layouts.master')
@section('content')

     <!-- Start Page title and tab -->
     <div class="section-body">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center ">
                <div class="header-action">
                    <h1 class="page-title">School</h1>
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">My Result Room</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Scores Sheet</li>
                    </ol>
                </div>
                <ul class="nav nav-tabs page-header-tab">

                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#mysubjects">My Subjects</a></li>



                    <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#classteacher-add"></a></li>


                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#classteacher"></a></li>



                    <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#mysubjectshistory"> My Subject History</a></li>



                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#classteacher"></a></li>



                    <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#classteacher-add"></a></li>

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
<?php
use App\Models\broadsheet;

?>

    </div>
    <div class="section-body mt-4">
        <div class="container-fluid">
            <div class="tab-content">
                <div class="tab-pane active" id="mysubjects">
                    <div class="card">
                        <div class="card-header">

                            <h5 class="card-title">My Subjects Score Sheet for the curent session</h5>


                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-hover js-basic-example dataTable table-striped table_custom   ">
                                    <thead>
                                        <tr>
                                            <tr>
                                                <th>SN</th>
                                                <th>Class</th>
                                                <th>Arm</th>
                                                <th>Subject</th>
                                                <th>Subject Code</th>
                                                <th>Term</th>
                                                <th>Session</th>
                                                <th>Score Sheet</th>

                                            </tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $sn = 1; ?>
                                        @foreach ($mysubjects as $subject)

                                        <tr id="sid{{ $subject->id }}">
                                            <td>{{ $sn++ }}</td>
                                            <td>{{ $subject->schoolclass }}</td>
                                            <td>{{ $subject->arm }}</td>
                                            <td>{{ $subject->subject }}</td>
                                            <td>{{ $subject->subjectcode }}</td>
                                            <td>{{ $subject->term }}</td>
                                            <td>{{ $subject->session }}</td>
                                            <td>

                                               <?php

                            $broadsheetchk = broadsheet::where('staffid',$subject->userid)
                                            ->where('subjectclassid',$subject->subclassid)
                                            ->where('termid',$subject->termid)
                                            ->where('session',$subject->sessionid)->exists();

                                                  ?>
                                            @if ($broadsheetchk)

                                            <a href="subjectscoresheet/{{ $subject->schoolclassid }}/{{ $subject->subclassid }}/{{ $subject->userid }}/{{ $subject->termid }}/{{ $subject->sessionid }}" class="btn btn-outline-success" data-toggle="tooltip" title="Open Score Sheet for {{ $subject->subject }}  {{ $subject->subjectcode }} " >Open Score Sheet</a>

                                            @else
                                            <a href="#" class="btn btn-outline-warning" data-toggle="tooltip" title=" {{ $subject->subject }}  {{ $subject->subjectcode }} has not been registered by any student yet ">No Scoresheet yet</a>
                                            @endif
                                             </td>
                                        </tr>
                                        @endforeach
                                     </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="mysubjectshistory">
                    <div class="card">
                        <div class="card-header">

                            <h3 class="card-title">My Subjects History</h3>


                        </div>

                        <div class="card-body">
                            <div class="table-responsive">



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        history.pushState(null, document.title, location.href);
        history.back();
        history.forward();
        window.onpopstate = function () {
            history.go(1);
        };
    </script>


    <script>

        function check(id){

            var id = id;
            var spinner = $('#loader');

          Swal.fire({
          title: 'Are you sure?',
          text: "Deleting this record will affect other associated records (e.g Any Record where this Class Teacher is featured)",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            spinner.show();
            $.ajax({

                url: 'ajaxclassteacher/'+id,
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
              'This Record is now Deleted. You can Check Other Records to make neccessary Editing!',
              'success'
            )

            var myobj = document.getElementById("sid"+id);
             myobj.remove();

          }
        })

        }
        </script>
    @endsection
