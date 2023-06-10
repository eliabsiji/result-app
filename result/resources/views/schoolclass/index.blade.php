@extends('layouts.master')
@section('content')

     <!-- Start Page title and tab -->
     <div class="section-body">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center ">
                <div class="header-action">
                    <h1 class="page-title">School</h1>
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Class</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Class</li>
                    </ol>
                </div>
                <ul class="nav nav-tabs page-header-tab">
                    @can('school-class-list')
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#class">List View</a></li>
                    @endcan

                    @can('add-school-class')
                    <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#class-add"></a></li>
                    @endcan

                    @can('school-class-list')
                    <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#class"></a></li>
                @endcan

                @can('add-school-class')
                <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#class-add">Add Class </a></li>
                @endcan

                @can('school-class-list')
                <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#class"></a></li>
            @endcan

            @can('add-school-class')
            <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#class-add"></a></li>
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
        <div class="alert alert-success alert-dismissible">
         <button type="button" class="close" data-dismiss="alert"></button>
             <p>{{ \Session::get('danger') }}</p>
         </div>
     @endif


    </div>
    <div class="section-body mt-4">
        <div class="container-fluid">
            <div class="tab-content">
                <div class="tab-pane active" id="class">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-hover js-basic-example dataTable table-striped table_custom   ">
                                    <thead>
                                        <tr>
                                            <tr>
                                                <th>SN</th>
                                                <th>Class</th>
                                                <th>Arm</th>
                                                <th>Category</th>
                                                <th>Action</th>
                                                <th>Date Registered</th>
                                            </tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $sn = 1; ?>
                                     @foreach ($all_classes as $class)

                                     <tr id="sid{{ $class->id }}">
                                         <td>{{ $sn++ }}</td>
                                         <td>{{ $class->schoolclass }}</td>
                                         <td>{{ $class->arm }}</td>
                                         <td>{{ $class->classcategory }}</td>
                                         <td><div class="btn-group">

                                             @can('edit-school-class')
                                             <a href="{{ route('schoolclass.edit',$class->id) }}" class="btn fa fa-pencil" data-toggle="tooltip" title="Edit Class"></a>
                                             @endcan
                                             @can('delete-school-class')
                                             <a href="javascript:void(0)" class="btn fa fa-trash delete"
                                             data-toggle="tooltip" title="Delete Class " onClick="check({{ $class->id }})"></a>
                                         @endcan
                                         </div></td>
                                         <td>{{ $class->updated_at }}</td>
                                     </tr>
                                     @endforeach
                                     </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="class-add">
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
                        <form  role="form" id="inline-validation" class="form-horizontal form-stripe" action="{{ route('schoolclass.store') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Class Name <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" id="schoolclass" name="schoolclass" placeholder="School class" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Select Class Arm <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <select name ="arm" id="arm"  class="form-control" >
                                        <option value="0">Select Class Arm </option>
                                        @foreach ($arms as $arms => $name )
                                         <option value="{{$name->arm}}">{{ $name->arm }}</option>
                                        @endforeach
                                      </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Select Class Category <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <select name ="classcategoryid" id="classcategoryid"  class="form-control" >
                                        <option value="0">Select Class Category </option>
                                        @foreach ($classcategories as $cat => $name )
                                         <option value="{{$name->id}}">{{ $name->category }}</option>
                                        @endforeach
                                      </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label"></label>
                                <div class="col-md-7">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="submit" class="btn btn-outline-secondary">Cancel</button>
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

                url: 'ajaxclass/'+id,
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
