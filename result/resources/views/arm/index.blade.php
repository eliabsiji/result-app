@extends('layouts.master')
@section('content')

     <!-- Start Page title and tab -->
     <div class="section-body">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center ">
                <div class="header-action">
                    <h1 class="page-title">School</h1>
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Arm</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Arm</li>
                    </ol>
                </div>
                <ul class="nav nav-tabs page-header-tab">
                    @can('school-arm-list')
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#arm">List View</a></li>
                    @endcan
                    @can('add-school-arm')
                    <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#arm-add"></a></li>
                    @endcan
                    @can('school-arm-list')
                    <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#arm"></a></li>
                    @endcan
                    @can('add-school-arm')
                        <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#arm-add">Add Arm</a></li>
                        @endcan
                        @can('school-arm-list')
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#arm"></a></li>
                    @endcan
                    @can('add-school-arm')
                    <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#arm-add"></a></li>
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
                <div class="tab-pane active" id="arm">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-striped table_custom   ">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Arm</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                            <th>Date Registered</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $sn = 1; ?>
                                        @foreach ($all_arms as $arm)

                                        <tr id="sid{{ $arm->id }}">
                                            <td>{{ $sn++ }}</td>
                                            <td>{{ $arm->arm }}</td>
                                            <td>{{ $arm->description }}</td>
                                            <td><div class="btn-group">

                                                @can('edit-school-arm')
                                                <a href="{{ route('schoolarm.edit',$arm->id) }}" class="btn fa fa-pencil" data-toggle="tooltip" title="Edit Arm"></a>
                                                @endcan
                                                @can('delete-school-arm')
                                                <a href="javascript:void(0)" class="btn fa fa-trash delete"
                                                data-toggle="tooltip" title="Delete Arm" onClick="check({{ $arm->id }})"></a>
                                            @endcan
                                            </div></td>
                                            <td>{{ $arm->updated_at }}</td>
                                        </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="arm-add">
                    <div class="card">

                        <div class="card-header">

                            <h3 class="card-title">Add Arm</h3>

                            @if (count($errors) > 0)
                            <div class="alert alert-warning fade in">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
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
                        <form  role="form" id="inline-validation" class="form-horizontal form-stripe" action="{{ route('schoolarm.store') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Arm <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" id="arm" name="arm" placeholder="Arm" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Remark <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" id="remark" name="remark" placeholder="Remark" required>
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


            Swal.fire({
          title: 'Are you sure?',
          text: "Deleting this record will affect other associated records",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {

            $.ajax({
                url: 'ajaxarm/'+id,
                type: "DELETE",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}',
                   id: id
                },
                dataType: 'JSON',
                success: function(dataResult){
                    var dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode==200){
                       //console.log("svssdvsdvs");
                    }
                }
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
