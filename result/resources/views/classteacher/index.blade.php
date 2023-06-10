@extends('layouts.master')
@section('content')

     <!-- Start Page title and tab -->
     <div class="section-body">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center ">
                <div class="header-action">
                    <h1 class="page-title">School</h1>
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Class Teacher</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Class Teacher</li>
                    </ol>
                </div>
                <ul class="nav nav-tabs page-header-tab">
                    @can('class-teacher-list')
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#classteacher">List View</a></li>
                    @endcan

                    @can('add-class-teacher')
                    <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#classteacher-add"></a></li>
                    @endcan

                    @can('class-teacher-list')
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#classteacher"></a></li>
                    @endcan

                    @can('add-class-teacher')
                    <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#classteacher-add">Add Class Teacher</a></li>
                    @endcan

                    @can('class-teacher-list')
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#classteacher"></a></li>
                    @endcan

                    @can('add-class-teacher')
                    <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#classteacher-add"></a></li>
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


    </div>
    <div class="section-body mt-4">
        <div class="container-fluid">
            <div class="tab-content">
                <div class="tab-pane active" id="classteacher">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-striped table_custom   ">
                                    <thead>
                                        <tr>
                                            <tr>
                                                <th>SN</th>
                                                <th>Class </th>
                                                <th>Arm</th>
                                                <th>Category</th>
                                                <th>Staff</th>
                                                <th>Term</th>
                                                <th>Session</th>
                                                <th>Date Registered</th>
                                                <th>Actions</th>
                                            </tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $sn = 1; ?>
                                     @foreach ($classteachers as $classteacher)

                                     <tr id="sid{{ $classteacher->id }}">
                                         <td>{{ $sn++ }}</td>
                                         <td>{{ $classteacher->schoolclass }}</td>
                                         <td>{{ $classteacher->schoolarm }}</td>
                                         <td>{{ $classteacher->classcategory}}</td>
                                         <td>{{ $classteacher->staffname }}</td>
                                         <td>{{ $classteacher->term }}</td>
                                         <td>{{ $classteacher->session }}</td>
                                         <td>{{ $classteacher->updated_at }}</td>
                                         <td><div class="btn-group">
                                             @can('edit-class-teacher')
                                             <a href="{{ route('classteacher.edit',$classteacher->id) }}" class="btn fa fa-pencil" data-toggle="tooltip" title="Edit Class Teacher"></a>
                                             @endcan
                                             </div>
                                         <div class="btn-group">
                                             @can('delete-class-teacher')
                                             <a href="javascript:void(0)" class="btn fa fa-trash delete"
                                                 data-toggle="tooltip" title="Delete Class Teacher" onClick="check({{ $classteacher->id }})"></a>
                                               @endcan
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

                <div class="tab-pane" id="classteacher-add">
                    <div class="card">

                        <div class="card-header">

                            <h3 class="card-title">Add Class Teacher</h3>

                            @if (count($errors) > 0)
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"></button>
                                <strong>Opps!</strong> Something went wrong, please check below errors.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                            <div class="card-options ">
                                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                            </div>
                        </div>
                        <form  role="form" id="inline-validation" class="form-horizontal form-stripe" action="{{ route('classteacher.store') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Select Staff <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <select name ="staffid" id="staffid"  class="form-control" required>
                                        <option value="" selected>Select staff</option>
                                        @foreach ($subjectteachers as $staff => $name )
                                         <option value="{{$name->userid}}">{{ $name->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Select Class <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <select name ="schoolclassid" id="schoolclassid"  class="form-control" >
                                        <option value="" selected>Select Class</option>
                                        @foreach ($schoolclass as $class => $name )
                                         <option value="{{$name->id}}">{{ $name->schoolclass }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $name->arm}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Select Term <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <select name ="termid" id="termid"  class="form-control" >
                                        <option value="" selected>Select Term </option>
                                        @foreach ($schoolterms as $term => $name )
                                         <option value="{{$name->id}}">{{ $name->term}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Select Session <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <select name ="sessionid" id="sessiionid"  class="form-control" >
                                        <option value="" selected>Select Session </option>
                                        @foreach ($schoolsessions as $schoolsession => $name )
                                         <option value="{{$name->id}}">{{ $name->session}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label"></label>
                                <div class="col-md-7">
                                    <button type="submit" class="btn btn-primary">Submit</button>

                                </div>
                            </div>
                            {!! Form::close() !!}
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
