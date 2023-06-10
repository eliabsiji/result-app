@extends('layouts.master')
@section('content')

     <!-- Start Page title and tab -->
     <div class="section-body">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center ">
                <div class="header-action">
                    <h1 class="page-title">School</h1>
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">My Subject Score Sheet</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Score Sheet</li>
                    </ol>
                </div>

                <ul class="nav nav-tabs page-header-tab">

                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#mysubjectscoresheet">My Subject Score Sheet</a></li>



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


    </div>
    <div class="section-body mt-4">
        <div class="container-fluid">
            <div class="tab-content">



                 <div style="display:flex; justify-content:flex-end; width:100%; padding:0;">
                    <a href="{{ route('myresultroom.index') }}" class="btn btn-outline-success" style="margin-right: auto; display: block;"  data-toggle="tooltip" > < Back</a>


                     <a href="/export" class="btn btn-outline-info" style="float: right;" data-toggle="tooltip" ><i class="fe fe-download mr-2"></i>Download Excel </a>&nbsp;&nbsp;
                     @if (\Session::has('schoolclassid') || \Session::has('subjectclassid') || \Session::has('stafid') || \Session::has('termid') || \Session::has('sessionid'))
                         <a href="/importform/{{ \Session::get('schoolclassid') }}/{{ \Session::get('subjectclassid') }}/{{ \Session::get('staffid') }}/{{ \Session::get('termid')}}/{{ \Session::get('sessionid') }}" class="btn btn-outline-warning" style="float: right;" data-toggle="tooltip" ><i class="fe fe-upload mr-2"></i>Batch Excel Upload</a>
                     @else
                     @endif


                            </div>

                <div class="tab-pane active" id="mysubjectscoresheet">
                    <div class="card">
                        <div class="card-header">
                            <?php
                                foreach($broadsheets as $b){
                                    $b->subject;
                                    $b->subjectcode;
                                    $b->schoolclass;
                                    $b->arm;
                                }
                                ?>
                            <h5 class="card-title">{{ $b->subject }}  {{ $b->subjectcode }} ScoreSheet for {{ $b->schoolclass }} {{ $b->arm }} for  {{ $b->term }} {{ $b->session }} session</h5>


                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-striped table_custom   ">
                                    <thead>
                                        <tr>
                                            <tr>
                                                <th>SN</th>
                                                <th>Adm No</th>
                                                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                <th>Name</th>
                                                <th>CA 1</th>
                                                <th>CA 2</th>
                                                <th>Exam</th>
                                                <th>Total</th>
                                                <th>Grade</th>
                                                <th>Position</th>
                                                <th>Action</th>

                                            </tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $sn = 1; ?>
                                        @foreach ($broadsheets as $broadsheet)

                                        <tr id="sid{{ $broadsheet->id }}">
                                            <td>{{ $sn++ }}</td>
                                            <td>{{ $broadsheet->admissionno }}</td>

                                            <?php

                                            if ($broadsheet->picture == NULL || $broadsheet->picture =="" || !isset($broadsheet->picture) ){

                                                  // $cimage =  $imageclass;
                                                   $image =  'unnamed.png';
                                            }else {

                                               $image =  $broadsheet->picture;
                                            }

                                            ?>
                                            <td><img  class = "avatar avatar-lg" src="{{ asset('images/studentpics/'.$image) }}"/></td>
                                            <td>{{ $broadsheet->fname }} {{ $broadsheet->lname }}</td>
                                            <td>{{ $broadsheet->ca1 }}</td>
                                            <td>{{ $broadsheet->ca2}}</td>
                                            <td>{{ $broadsheet->exam }}</td>
                                            @if ($broadsheet->total <= 29)
                                            <td style="color:red;">{{ $broadsheet->total }}</td>
                                            @else
                                            <td>{{ $broadsheet->total }}</td>
                                            @endif
                                           @if ($broadsheet->grade == "F")
                                           <td style="color:red;">{{ $broadsheet->grade}}</td>
                                           @else
                                           <td>{{ $broadsheet->grade}}</td>
                                           @endif

                                           <td>{{ $broadsheet->position }}</td>
                                            <td>  <a href="{{ route('subjectscoresheet.edit',$broadsheet->id) }}" class="btn btn-outline-success" data-toggle="tooltip"
                                                title="Open Score Sheet for {{ $broadsheet->fname }}  {{ $broadsheet->lname }} ">Edit Score</a></td>
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
    </div onload="alwaysRefresh()">


    <script>
function alwaysRefresh(){

    Swal.fire({
          title: 'Are you sure?',
          text: "Deleting this record will affect other associated records (e.g Any Record where this Class Teacher is featured)",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        })

}
        </script>
    @endsection
