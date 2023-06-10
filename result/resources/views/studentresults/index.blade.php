@extends('layouts.master')
@section('content')

     <!-- Start Page title and tab -->
     <div class="section-body">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center ">
                <div class="header-action">
                    <h1 class="page-title">School</h1>
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Student Result</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Result</li>
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

                                                <th>View Students</th>

                                            </tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $sn = 1; ?>
                                        @foreach ($all_classes as $aclass)

                                        <tr>
                                            <td>{{ $sn++ }}</td>
                                            <td>{{ $aclass->schoolclass }}</td>
                                            <td>{{ $aclass->arm }}</td>

                                            <td>  <a href="{{ route('studentresults.show',$aclass->id) }}" class="btn btn-outline-success" data-toggle="tooltip"
                                                title="View all Students in  {{  $aclass->schoolclass}}  {{ $aclass->arm  }} ">View Students</a></td>

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



    @endsection
