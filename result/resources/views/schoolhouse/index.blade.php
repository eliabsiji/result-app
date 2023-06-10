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
                    @can('schoolhouse-list')
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#schoolhouses">List View</a></li>
                    @endcan

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
        <a class="btn btn-primary" href="{{ route('student.index') }}"> Back to Students</a>
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



                <div class="tab-pane active" id="schoolhouse">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-striped table_custom">
                                    <thead>

                                            <tr>
                                                <th>SN</th>

                                                <th>House</th>
                                                 <th>colour</th>
                                                 <th>Housemaster</th>
                                                 <th> </th>
                                                 <th>Term</th>
                                                 <th>Session</th>
                                                <th>Action</th>

                                            </tr>

                                    </thead>
                                    <tbody>
                                        <?php $sn = 1;
                                        $image = "";
                                        $cimage="";
                                        $imageclass = "avatar avatar-lg";
                                        $noimageclass = "avatar avatar-blue"
                                        ?>

                                     @foreach ($schoolhouses as $sc)
                                     <tr id="sid{{ $sc->id }}">
                                         <td>{{ $sn++ }}</td>
                                         <td>{{ $sc->house }}</td>
                                          <td>{{ $sc->housecolour }}</td>
                                          <td>{{ $sc->housemaster }}</td>
                                          <?php

                                         if ($sc->pic == NULL || $sc->pic =="" || !isset($sc->pic) ){

                                               // $cimage =  $imageclass;
                                                $image =  'unnamed.png';
                                         }else {

                                            $image =  $sc->pic;
                                         }

                                         ?>
                                         <td><img  class = "avatar avatar-lg" src="{{ asset('images/staffpics/'.$image) }}"/></td>

                                         <td>{{ $sc->term }}</td>
                                         <td>{{ $sc->session }}</td>
                                         <td>
                                            <div class="btn-group">

                                                @can('schoolhouse-edit')
                                                <a href="{{ route('schoolhouse.edit',$sc->id) }}" class="btn fa fa-pencil" data-toggle="tooltip" title="Edit School house"></a>
                                                @endcan
                                                @can('schoolhouse-delete')
                                                <a href="javascript:void(0)" class="btn fa fa-trash delete"
                                                data-toggle="tooltip" title="Delete School House " onClick="check({{ $sc->id }})"></a>
                                            @endcan
                                                </div>
                                            <div class="btn-group">

                                           </div>
                                     </td>
                                    </tr>

                                     @endforeach
                                     </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="tab-pane" id="schoolhouse-add">
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12">


                             <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Create School House</h3>
                                    <div class="card-options ">
                                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                        <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                                    </div>
                                </div>


                                <div class="card">
                                    <div class="card-body">
                            <form  role="form" id="inline-validation" class="form-horizontal form-stripe" action="{{ route('schoolhouse.store') }}"  method="POST">
                                @csrf
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">House Name <span class="text-danger">*</span></label>
                                            <div class="col-md-7">
                                               <input type="text" name="house" id="house" class="form-control" placeholder="House Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">House Colour <span class="text-danger">*</span></label>
                                            <div class="col-md-7">
                                               <input type="text" name="housecolour" id="housecolour" class="form-control"  placeholder="House Colour" required>
                                            </div>
                                        </div>

                                       <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Select house master <span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <select name ="housemasterid" id="housemasterid"  class="form-control" required>
                                                        <option value="" selected>Select House master</option>
                                                           @foreach ($staff as $st => $name )
                                                         <option value="{{$name->userid}}">{{ $name->name }}  </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Select Term <span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <select name ="termid" id="termid"  class="form-control" required>
                                                        <option value="" selected>Select Term </option>
                                                        @foreach ($schoolterm as $term => $name )
                                                         <option value="{{$name->id}}">{{ $name->term}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Select Current Session <span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <select name ="sessionid" id="sessiionid"  class="form-control" required>
                                                        <option value="" selected>Select Session </option>
                                                        @foreach ($schoolsession as $schoolsession => $name )
                                                         <option value="{{$name->id}}">{{ $name->session}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label"></label>
                                                <div class="col-md-7">
                                                    <button type="submit" class="btn btn-primary">Submit Data</button>

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


    <script>


        function check(id){

            var id = id;
            var spinner = $('#loader');

          Swal.fire({
          title: 'Are you sure?',
          text: "Deleting this record will affect other associated records (e.g Any Record where student is featured)",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            spinner.show();
            $.ajax({

                url: 'ajaxschoolhousedelete/'+id,
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
