@extends('layouts.master')
@section('content')

     <!-- Start Page title and tab -->
     <div class="section-body">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center ">
                <div class="header-action">
                    <?php
                    $subsegstatus="";
                    foreach($studentdata as $s) {
                      $fn =   $s->firstname;
                       $ln =  $s->lastname;
                       $ad = $s->admissionNo;
                    }

                    foreach($classname as $c){
                        $cname = $c->schoolclass;
                        $aname = $c->arm;
                    }
                 ?>
                    <h1 class="page-title">School</h1>
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Student</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Subject  Information for <span class="tag tag-green">{{ $fn }} {{ $ln }} ({{ $ad }})</span></li>
                       | CLASS:  <span class="tag tag-green">{{ $cname }}  ({{ $aname }})</span></li>
                    </ol>
                </div>
                <ul class="nav nav-tabs page-header-tab">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#edit-class">Subject Information</a></li>

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
        <div class="row clearfix">
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="widgets1">
                        <div class="icon">
                            <i class="icon-heart text-success font-30"></i>
                        </div>
                        <div class="details">
                            <h6 class="mb-0 font600">Subject Offered</h6>
                            <span class="mb-0">{{ $totalreg }}</span>
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
                            <h6 class="mb-0 font600">Registered</h6>
                            <span class="mb-0">{{ $reg }}</span>
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
                            <h6 class="mb-0 font600">Not registered</h6>
                            <span class="mb-0">{{ $noreg }}</span>
                        </div>
                    </div>
                </div>
            </div>
         </div>

        </div>
    </div>
    <div class="section-body mt-4">
        <div class="container-fluid">
            <div class="tab-content">
                <div class="tab-pane active" id="edit-arm">
                    <div class="card">
                        <div class="card-header">
                            <a class="btn btn-primary" href="{{ route('subjectoperation.index') }}"> Back to Subject Operations</a>
                            <div class="card-options ">
                                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                            </div>
                        </div>
                        <ul class="nav nav-tabs page-header-tab">
                            @can('school-arm-list')
                                <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#registersubjects">Register Subjects</a></li>
                            @endcan

                            @can('add-school-arm')
                                <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#subjecthistory">Subject History</a></li>
                            @endcan

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="registersubjects">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <div class="card-header">

                                                <h3 class="card-title">Subject Registration for</h3> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <h5> {{ $fn }} {{ $ln }} ({{ $ad }}) </h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <div class="card-options ">
                                                    <a href="#" class="btn btn-outline-secondary btn-sm"> Preview | Print </a>

                                                </div>
                                                </div>

                                                <?php use App\Models\subjectRegistrationStatus;?>

                                                <table class="table table-hover table-striped table-vcenter text-nowrap mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Subject</th>
                                                            <th>Subject Code</th>
                                                            <th>Subject Techer</th>
                                                            <th></th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $sn = 1; ?>
                                                        @foreach ($subjectclass as $sc)
                                                        <tr id="sid{{ $sc->id }}">
                                                            <td>{{ $sn++ }}</td>
                                                            <td>{{ $sc->subject }} </td>
                                                            <td>{{ $sc->subjectcode }} </td>
                                                            <td>{{ $sc->title }} {{ $sc->name }} </td>


                                                             <?php

                                                            if ($sc->picture == NULL || $sc->picture =="" || !isset($sc->picture) ){

                                                                  // $cimage =  $imageclass;
                                                                   $image =  'unnamed.png';
                                                            }else {

                                                               $image =  $sc->picture;
                                                            }

                                                            ?>
                                                            <td><img  class = "avatar avatar-xm" src="{{ asset('images/staffpics/'.$image) }}"/></td>




                                                            <td>

                                                              <?php
                                                              $subRegStatuschk = subjectRegistrationStatus::where('studentid',$student)

                                                                ->where('sessionid',$sc->sessionid)
                                                                ->where('termid',$sc->termid)
                                                                ->where('subjectclassid',$sc->subjectclassid)
                                                                ->where('staffid',$sc->staffid)
                                                                ->where('Status',1)
                                                                ->exists();


                                                               $subRegStatus = subjectRegistrationStatus::where('studentid',$student)

                                                                            ->where('sessionid',$sc->sessionid)
                                                                            ->where('termid',$sc->termid)
                                                                            ->where('subjectclassid',$sc->subjectclassid)
                                                                             ->where('staffid',$sc->staffid)
                                                                            ->where('Status',1)
                                                                            ->get();

                                                                            foreach ($subRegStatus as $value) {
                                                                                # code...
                                                                                $subregid = $value->id;
                                                                                $broadsheetid = $value->broadsheetid;
                                                                                $subregstatus = $value->Status;

                                                                               // echo $subregid;
                                                                            }


                                                                 ?>
                                                @if ($subRegStatuschk)

                                                @if ($subregstatus == 1)
                                                @can('delete-subject-operation')

                                                <span class="tag tag-green">Registered</span>
                                                {!! Form::open(['method' => 'DELETE','route' => ['subjectoperation.destroy', $broadsheetid],'style'=>'display:inline']) !!}
                                                <button type="submit" class="btn btn-icon btn-bitbucket" data-toggle="tooltip" title="Unregister Subject"><i class="fa fa-bitbucket"></i></button>
                                                {!! Form::close() !!}
                                                @endcan
                                                @else

                                                <form  role="form" id="inline-validation" class="form-horizontal form-stripe" action="{{ route('subjectoperation.store') }}" method="POST">
                                                @csrf

                                                <input type="hidden" class="form-control"  name="studentid" value="{{ $student }}">
                                                <input type="hidden" class="form-control"  name="subjectclassid" value="{{ $sc->subjectclassid }}">
                                                <input type="hidden" class="form-control"  name="staffid" value="{{ $sc->staffid }}">
                                                <input type="hidden" class="form-control"  name="termid" value="{{ $sc->termid }}">
                                                <input type="hidden" class="form-control"  name="sessionid" value="{{ $sc->sessionid }}">
                                                <button type="submit" class="btn btn-warning " data-toggle="tooltip" title="Register {{ $sc->subject }} {{ $sc->subjectcode }} Subject">Not Registered</button>

                                                </form>

                                                @endif

                                                @else

                                                <form  role="form" id="inline-validation" class="form-horizontal form-stripe" action="{{ route('subjectoperation.store') }}" method="POST">
                                                @csrf

                                                <input type="hidden" class="form-control"  name="studentid" value="{{ $student }}">
                                                <input type="hidden" class="form-control"  name="subjectclassid" value="{{ $sc->subjectclassid }}">
                                                <input type="hidden" class="form-control"  name="staffid" value="{{ $sc->staffid }}">
                                                <input type="hidden" class="form-control"  name="termid" value="{{ $sc->termid }}">
                                                <input type="hidden" class="form-control"  name="sessionid" value="{{ $sc->sessionid }}">
                                                <button type="submit" class="btn btn-warning " data-toggle="tooltip" title="Register {{ $sc->subject }}  {{ $sc->subjectcode }} Subject">Not Registered</button>

                                                </form>
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

                            <div class="tab-pane" id="subjecthistory">


                                gggg
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
          text: "You want to unregister this subject",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            spinner.show();
            $.ajax({

                url: 'ajaxsession/'+id,
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
              'This Session Record Has Been Deleted!',
              'success'
            )

            var myobj = document.getElementById("sid"+id);
             myobj.remove();

          }
        })

        }
        </script>
    @endsection
