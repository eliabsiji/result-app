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
                        <li class="breadcrumb-item active" aria-current="page">Student Profile Resgistration</li>
                    </ol>
                </div>
                <ul class="nav nav-tabs page-header-tab">
                    @can('student-list')
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#student-edit">Edit Student</a></li>
                    @endcan

                    @can('add-subject')
                    <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#student-add"> </a></li>
                    @endcan
                    @can('subject-class-list')
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#classsubject"></a></li>
                    @endcan

                    @can('add-student')
                    <li class="nav-item"><a class="nav-link " id="Library-tab-Boot" data-toggle="tab" href="#student-add"> </a></li>
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
                            <div class="card">
                                <div class="card-header">

                                    @foreach ($students as $st )


                                    <h3 class="card-title">
                                        <?php

                                        if ($st->picture == NULL || $st->picture =="" || !isset($st->picture) ){

                                              // $cimage =  $imageclass;
                                               $image =  'unnamed.png';
                                        }else {

                                           $image =  $st->picture;
                                        }

                                        ?>
                                        <img  class = "avatar avatar-lg" src="{{ asset('images/studentpics/'.$image) }}"/>
                                       Personality Profile info for {{ $st->fname }} {{ $st->lastname }} </h3>
                                    <div class="card-options ">
                                        <a class="btn btn-primary" href="{{ route('myclass.index') }}"> Back to Myclass</a>
                                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                        <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                                    </div>
                                </div>
                                @endforeach

                                <div class="card">
                                    <div class="card-body">

                                        <div class="table-responsive">
                                            <table class="table table-hover table-striped table-vcenter text-nowrap mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Personality Profile</th>
                                                        <th>Remarks</th>
                                                        <th>Value</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                    <form  role="form" id="inline-validation" class="form-horizontal form-stripe" action="/save" method="POST">

                                        <input type="hidden" name="studentid" value="{{ $studentid }}">
                                        <input type="hidden" name="schoolclassid" value="{{ $schoolclassid }}">
                                        <input type="hidden" name="staffid" value="{{ $staffid }}">
                                        <input type="hidden" name="termid" value="{{ $termid }}">
                                        <input type="hidden" name="sessionid" value="{{ $sessionid }}">

                                      <?php
                                      foreach ($studentpp as $key => $s) {

                                       // echo $s->punctuality;
                                      }
                                      ?>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Puntuality</td>
                                                        <td>
                                                            <select class="form-control col-md-8" name="punctuality" required>

                                                                @if ($s->punctuality == "")
                                                                <option value="">Select Remark </option>
                                                                @else
                                                                <option value="{{ $s->punctuality }}">Select  Remark</option>
                                                                @endif
                                                                <option value="Excellent">Excellent</option>
                                                                <option value="Very Good">Very Good</option>
                                                                <option value="Good">Good</option>
                                                                <option value="Fairly">Fairly Good</option>
                                                                <option value="Poor">Poor</option>
                                                            </select>
                                                        </td>
                                                       <td>
                                                           <input type="text" id="" class="form-control" value="{{ $s->punctuality }}" readonly required>
                                                       </td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Neatness</td>
                                                        <td>
                                                            <select class="form-control col-md-8" name="neatness"  required>
                                                                @if ($s->neatness == "")
                                                                <option value="">Select </option>
                                                                @else
                                                                <option value="{{ $s->neatness }}">Select Remarks </option>
                                                                @endif

                                                                <option value="Excellent">Excellent</option>
                                                                <option value="Very Good">Very Good</option>
                                                                <option value="Good">Good</option>
                                                                <option value="Fairly">Fairly Good</option>
                                                                <option value="Poor">Poor</option>
                                                            </select>
                                                        </td>
                                                       <td>
                                                           <input type="text" id="" class="form-control" value="{{$s->neatness }}" readonly required>
                                                       </td>
                                                    </tr>

                                                    <tr>
                                                        <td>3</td>
                                                        <td>Leadership</td>
                                                        <td>
                                                            <select class="form-control col-md-8" name="leadership" required>

                                                                @if ($s->leadership == "")
                                                                <option value="">Select Remark </option>
                                                                @else
                                                                <option value="{{ $s->leadership }}">Select  Remark</option>
                                                                @endif
                                                                <option value="Excellent">Excellent</option>
                                                                <option value="Very Good">Very Good</option>
                                                                <option value="Good">Good</option>
                                                                <option value="Fairly">Fairly Good</option>
                                                                <option value="Poor">Poor</option>
                                                            </select>
                                                        </td>
                                                       <td>
                                                           <input type="text" id="" class="form-control" value="{{ $s->leadership }}" readonly required>
                                                       </td>
                                                    </tr>

                                                    <tr>
                                                        <td>4</td>
                                                        <td>Attitude</td>
                                                        <td>
                                                            <select class="form-control col-md-8" name="attitude" required >

                                                                @if ($s->attitude == "")
                                                                <option value="">Select Remark </option>
                                                                @else
                                                                <option value="{{ $s->attitude }}">Select  Remark</option>
                                                                @endif
                                                                <option value="Excellent">Excellent</option>
                                                                <option value="Very Good">Very Good</option>
                                                                <option value="Good">Good</option>
                                                                <option value="Fairly">Fairly Good</option>
                                                                <option value="Poor">Poor</option>
                                                            </select>
                                                        </td>
                                                       <td>
                                                           <input type="text" id="" class="form-control" value="{{ $s->attitude }}" readonly required>
                                                       </td>
                                                    </tr>

                                                    <tr>
                                                        <td>5</td>
                                                        <td>Reading</td>
                                                        <td>
                                                            <select class="form-control col-md-8" name="reading" required>

                                                                @if ($s->reading == "")
                                                                <option value="">Select Remark </option>
                                                                @else
                                                                <option value="{{ $s->reading }}">Select  Remark</option>
                                                                @endif
                                                                <option value="Excellent">Excellent</option>
                                                                <option value="Very Good">Very Good</option>
                                                                <option value="Good">Good</option>
                                                                <option value="Fairly">Fairly Good</option>
                                                                <option value="Poor">Poor</option>
                                                            </select>
                                                        </td>
                                                       <td>
                                                           <input type="text" id="" class="form-control" value="{{ $s->reading }}" readonly required>
                                                       </td>
                                                    </tr>

                                                    <tr>
                                                        <td>6</td>
                                                        <td>Honesty</td>
                                                        <td>
                                                            <select class="form-control col-md-8" name="honesty" required>

                                                                @if ($s->honesty == "")
                                                                <option value="">Select Remark </option>
                                                                @else
                                                                <option value="{{ $s->honesty }}">Select  Remark</option>
                                                                @endif
                                                                <option value="Excellent">Excellent</option>
                                                                <option value="Very Good">Very Good</option>
                                                                <option value="Good">Good</option>
                                                                <option value="Fairly">Fairly Good</option>
                                                                <option value="Poor">Poor</option>
                                                            </select>
                                                        </td>
                                                       <td>
                                                           <input type="text" id="" class="form-control" value="{{ $s->honesty }}" readonly required>
                                                       </td>
                                                    </tr>

                                                    <tr>
                                                        <td>7</td>
                                                        <td>Coopereation</td>
                                                        <td>
                                                            <select class="form-control col-md-8" name="cooperation" required>

                                                                @if ($s->cooperation  == "")
                                                                <option value="">Select Remark </option>
                                                                @else
                                                                <option value="{{ $s->cooperation }}">Select  Remark</option>
                                                                @endif
                                                                <option value="Excellent">Excellent</option>
                                                                <option value="Very Good">Very Good</option>
                                                                <option value="Good">Good</option>
                                                                <option value="Fairly">Fairly Good</option>
                                                                <option value="Poor">Poor</option>
                                                            </select>
                                                        </td>
                                                       <td>
                                                           <input type="text" id="" class="form-control" value="{{ $s->cooperation }}" readonly required>
                                                       </td>
                                                    </tr>

                                                    <tr>
                                                        <td>8</td>
                                                        <td>Self-control</td>
                                                        <td>
                                                            <select class="form-control col-md-8" name="selfcontrol" required>

                                                                @if ($s->selfcontrol == "")
                                                                <option value="">Select Remark </option>
                                                                @else
                                                                <option value="{{ $s->selfcontrol }}">Select  Remark</option>
                                                                @endif
                                                                <option value="Excellent">Excellent</option>
                                                                <option value="Very Good">Very Good</option>
                                                                <option value="Good">Good</option>
                                                                <option value="Fairly">Fairly Good</option>
                                                                <option value="Poor">Poor</option>
                                                            </select>
                                                        </td>
                                                       <td>
                                                           <input type="text" id="" class="form-control" value="{{ $s->selfcontrol }}" readonly required>
                                                       </td>
                                                    </tr>

                                                    <tr>
                                                        <td>9</td>
                                                        <td>Physical Health</td>
                                                        <td>
                                                            <select class="form-control col-md-8" name="physicalhealth">

                                                                @if ($s->physicalhealth == "")
                                                                <option value="">Select Remark </option>
                                                                @else
                                                                <option value="{{ $s->physicalhealth }}">Select  Remark</option>
                                                                @endif
                                                                <option value="Excellent">Excellent</option>
                                                                <option value="Very Good">Very Good</option>
                                                                <option value="Good">Good</option>
                                                                <option value="Fairly">Fairly Good</option>
                                                                <option value="Poor">Poor</option>
                                                            </select>
                                                        </td>
                                                       <td>
                                                           <input type="text" id="" class="form-control" value="{{ $s->physicalhealth }}" readonly required>
                                                       </td>
                                                    </tr>

                                                    <tr>
                                                        <td>10</td>
                                                        <td>Politeness</td>
                                                        <td>
                                                            <select class="form-control col-md-8" name="politeness">

                                                                @if ($s->politeness == "")
                                                                <option value="">Select Remark </option>
                                                                @else
                                                                <option value="{{ $s->politeness }}">Select  Remark</option>
                                                                @endif
                                                                <option value="Excellent">Excellent</option>
                                                                <option value="Very Good">Very Good</option>
                                                                <option value="Good">Good</option>
                                                                <option value="Fairly">Fairly Good</option>
                                                                <option value="Poor">Poor</option>
                                                            </select>
                                                        </td>
                                                       <td>
                                                           <input type="text" id="" class="form-control" value="{{ $s->politeness}}" readonly required>
                                                       </td>
                                                    </tr>

                                                    <tr>
                                                        <td>11</td>
                                                        <td>Stability</td>
                                                        <td>
                                                            <select class="form-control col-md-8" name="stability" required>

                                                                @if ($s->stability == "")
                                                                <option value="">Select Remark </option>
                                                                @else
                                                                <option value="{{ $s->stability }}">Select  Remark</option>
                                                                @endif
                                                                <option value="Excellent">Excellent</option>
                                                                <option value="Very Good">Very Good</option>
                                                                <option value="Good">Good</option>
                                                                <option value="Fairly">Fairly Good</option>
                                                                <option value="Poor">Poor</option>
                                                            </select>
                                                        </td>
                                                       <td>
                                                           <input type="text" id="" name="" class="form-control" value="{{ $s->stability }}" readonly required>
                                                       </td>
                                                    </tr>

                                                    <tr>
                                                        <td>12</td>
                                                        <td>Games And Sports</td>
                                                        <td>
                                                            <select class="form-control col-md-8" name="gamesandsports" required>

                                                                @if ($s->gamesandsports == "")
                                                                <option value="">Select Remark </option>
                                                                @else
                                                                <option value="{{ $s->gamesandsports }}">Select  Remark</option>
                                                                @endif
                                                                <option value="Excellent">Excellent</option>
                                                                <option value="Very Good">Very Good</option>
                                                                <option value="Good">Good</option>
                                                                <option value="Fairly">Fairly Good</option>
                                                                <option value="Poor">Poor</option>
                                                            </select>
                                                        </td>
                                                       <td>
                                                           <input type="text" id="" name="" class="form-control" value="{{ $s->gamesandsports }}" readonly required>
                                                       </td>
                                                    </tr>


                                                    <tr>
                                                        <td>13</td>
                                                        <td>School Attendance</td>
                                                        <td>
                                                          <input type="numbber" id="attendance" name="attendance" value="{{ $s->attendance }}" class="form-control">

                                                        </td>

                                                    </tr>



                                                    <tr>
                                                        <td>14</td>
                                                        <td>Teacher's Comment</td>
                                                        <td>
                                                          <input type="text" id="" name="classteachercomment" value="{{ $s->classteachercomment }}" class="form-control">

                                                        </td>

                                                    </tr>


                                                    <tr>
                                                        <td>15</td>
                                                        <td>Principal's Comment</td>
                                                        <td>
                                                            <input type="text" id="" name="principalscomment" value="{{ $s->principalscomment }}" class="form-control">
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                           <button class="btn btn-primary">update profile</button>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </form>
                                            </table>
                                        </div>

                                    </div>
                                </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @endsection
