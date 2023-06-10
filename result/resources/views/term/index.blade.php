@extends('layouts.master')
@section('content')

     <!-- Start Page title and tab -->
     <div class="section-body">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center ">
                <div class="header-action">
                    <h1 class="page-title">School</h1>
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Term</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Term</li>
                    </ol>
                </div>
                <ul class="nav nav-tabs page-header-tab">
                    @can('term-list')
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#term">List View</a></li>
                    @endcan

                    @can('add-term')
                    <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#term-add"></a></li>
                    @endcan
                    @can('term-list')
                    <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#term"></a></li>
                @endcan

                @can('add-term')
                <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#term-add">Add Term</a></li>
                @endcan
                @can('term-list')
                <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#term"></a></li>
            @endcan

            @can('add-term')
            <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#term-add"></a></li>
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
                <div class="tab-pane active" id="term">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-striped table_custom   ">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Term</th>
                                            <th>Date Registered</th>
                                            <th>Date Edited</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $sn = 1; ?>
                                     @foreach ($terms as $term)

                                     <tr id="sid{{ $term->id }}">
                                         <td>{{ $sn++ }}</td>
                                         <td>{{ $term->term }}</td>
                                         <td>{{ $term->created_at }}</td>
                                         <td>{{ $term->updated_at }}</td>
                                         <td><div class="btn-group">

                                             @can('edit-term')
                                             <a href="{{ route('term.edit',$term->id) }}" class="btn fa fa-pencil" data-toggle="tooltip" title="Edit School Term"></a>
                                             @endcan
                                             @can('delete-term')
                                             {!! Form::open(['method' => 'DELETE','route' => ['term.destroy', $term->id],]) !!}
                                             <button  class="btn fa fa-trash" data-toggle="tooltip"
                                             title="Delete School Term" ></button>
                                             {!! Form::close() !!}
                                         @endcan
                                         </div></td>
                                     </tr>
                                     @endforeach
                                     </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="term-add">
                    <div class="card">

                        <div class="card-header">

                            <h3 class="card-title">Add Term</h3>

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
                        <form  ole="form" id="inline-validation" class="form-horizontal form-stripe" action="{{ route('term.store') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Term Name <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" id="term" name="term" placeholder="Session" required>
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
          text: "Deleting this record will affect other associated records (e.g Any Record where this Term is featured)",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            spinner.show();
            $.ajax({

                url: 'ajaxterm/'+id,
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
              'This Term Record Has Been Deleted!',
              'success'
            )

            var myobj = document.getElementById("sid"+id);
             myobj.remove();

          }
        })

        }
        </script>
    @endsection
