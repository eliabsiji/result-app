@extends('layouts.master')
@section('content')

     <!-- Start Page title and tab -->
     <div class="section-body">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center ">
                <div class="header-action">
                    <h1 class="page-title">School</h1>
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Class Subject</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Class Subject</li>
                    </ol>
                </div>
                <ul class="nav nav-tabs page-header-tab">
                    @can('subject-class-list')
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#classsubject">List View</a></li>
                    @endcan

                    @can('assign-subject-class')
                    <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#classsubject-add"> </a></li>
                    @endcan
                    @can('subject-class-list')
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#classsubject"></a></li>
                    @endcan

                    @can('assign-subject-class')
                    <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#classsubject-add">Add Class Subject </a></li>
                    @endcan
                    @can('subject-class-list')
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#classsubject"></a></li>
                    @endcan

                    @can('assign-subject-class')
                    <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#classsubject-add"> </a></li>
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
         <strong>Opps!</strong> Something went wrong, please check where a want add data .<br><br>
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
                <div class="tab-pane active" id="classsubject">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-striped table_custom">
                                    <thead>

                                            <tr>
                                                <th>SN</th>
                                                <th>Class</th>
                                                <th>Arm</th>

                                                <th>Subject</th>
                                                <th>Subject Teacher</th>
                                                <th></Picture></th>
                                                <th>Action</th>
                                                <th>Date Registered</th>
                                            </tr>

                                    </thead>
                                    <tbody>
                                        <?php $sn = 1; ?>
                                     @foreach ($subjectclasses as $sc)
                                     <tr id="sid{{ $sc->scid }}">
                                         <td>{{ $sn++ }}</td>
                                         <td>{{ $sc->sclass }} </td>
                                         <td>{{ $sc->sarm }}</td>

                                         <td>{{ $sc->subjectname }} <h6 class="text-xs color-warning">({{ $sc->subjectcode }})</h6></td>
                                         <td>{{ $sc->teachername }}</td>
                                         <?php

                                         if ($sc->picture == NULL || $sc->picture =="" || !isset($sc->picture) ){

                                               // $cimage =  $imageclass;
                                                $image =  'unnamed.png';
                                         }else {

                                            $image =  $sc->picture;
                                         }

                                         ?>
                                         <td><img  class = "avatar avatar-lg" src="{{ asset('images/staffpics/'.$image) }}"/></td>

                                         <td>
                                             <div class="btn-group">
                                                 @can('subject-class-edit')
                                                 <a href="{{ route('subjectclass.edit',$sc->scid) }}" class="btn fa fa-pencil" data-toggle="tooltip" title="Edit Subject Class"></a>
                                                 @endcan
                                                 </div>
                                             <div class="btn-group">
                                             @can('subject-class-delete')
                                             <a href="javascript:void(0)" class="btn fa fa-trash delete"
                                                 data-toggle="tooltip" title="Delete subject Class" onClick="check({{ $sc->scid }})"></a>
                                               @endcan
                                         </div>
                                     </td>
                                         <td>{{ $sc->updated_at }}</td>
                                     </tr>

                                     @endforeach
                                     </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="classsubject-add">
                    <div class="card">

                        <div class="card-header">

                            <h3 class="card-title">Add Class Subject</h3>


                            <div class="card-options ">
                                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                            </div>
                        </div>
                        <form  ole="form" id="inline-validation" class="form-horizontal form-stripe" action="{{ route('subjectclass.store') }}" method="POST">
                            @csrf

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Select Class and Arm <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <select name ="schoolclassid" id="schoolclassid"  class="form-control" >
                                        <option value="" selected>Select Class & Arm</option>
                                        @foreach ($schoolclasses as $schoolclass => $name )
                                         <option value="{{$name->id}}">{{ $name->schoolclass }} &nbsp; {{ $name->arm }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Select Subject <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <select name ="subjectid" id="subjectid"  class="form-control" required="required">
                                        <option value="" selected>Select Subject </option>
                                        @foreach ($subjectteacher as $subject => $name )
                                         <option value="{{$name->id}}">{{ $name->subject}} &nbsp; &nbsp;&nbsp; {{ $name ->subjectcode}}
                                            .................................( {{ $name->title }} {{ $name->teachername }})</option>

                                        @endforeach

                                    </select>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-md-3 col-form-label"></label>
                                <div class="col-md-7">
                                    <button type="submit" class="btn btn-primary">Assign Subject to Class</button>

                                </div>
                            </div>
                        </form>
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
