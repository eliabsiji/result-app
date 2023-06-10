@extends('layouts.master')
@section('content')

     <!-- Start Page title and tab -->
     <div class="section-body">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center ">
                <div class="header-action">
                    <h1 class="page-title">School</h1>
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Subject</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Subject</li>
                    </ol>
                </div>
                <ul class="nav nav-tabs page-header-tab">
                    @can('subject-list')
                    <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#subject">List View</a></li>
                    @endcan
                    @can('add-subject')
                    <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#add-subject"> </a></li>
                    @endcan
                    @can('subject-list')
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#subject"></a></li>
                     @endcan
                    @can('add-subject')
                    <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#add-subject">Add Subject </a></li>
                    @endcan
                    @can('subject-list')
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#subject"></a></li>
                    @endcan

            @can('add-subject')
            <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#add-subject"> </a></li>
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
     <div class="alert alert-danger alert-dismissible">
         <button type="button" class="close" data-dismiss="alert"></button>
         <strong>Opps!</strong> Something went wrong, please check below errors.<br><br>
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
                <div class="tab-pane active" id="subject">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-striped table_custom">
                                    <thead>

                                            <tr>
                                                <th>SN</th>
                                                <th>Subject</th>
                                                <th>Subject Code</th>
                                                <th>Remark</th>
                                                <th>Action</th>
                                                <th>Date Registered</th>
                                            </tr>

                                    </thead>
                                    <tbody>
                                        <?php $sn = 1; ?>
                                     @foreach ($allSubjects as $subject)

                                     <tr id="sid{{ $subject->id }}">
                                         <td>{{ $sn++ }}</td>
                                         <td>{{ $subject->subject }}</td>
                                         <td>{{ $subject->subject_code }}</td>
                                         <td>{{ $subject->remark }}</td>
                                         <td><div class="btn-group">

                                             @can('edit-subject')
                                             <a href="{{ route('subject.edit',$subject->id) }}" class="btn fa fa-pencil" data-toggle="tooltip" title="Edit Subject"></a>
                                             @endcan
                                             @can('delete-subject')
                                             <a href="javascript:void(0)" class="btn fa fa-trash delete"
                                             data-toggle="tooltip" title="Delete Class " onClick="check({{ $subject->id }})"></a>
                                             @endcan
                                         </div></td>
                                         <td>{{ $subject->updated_at }}</td>
                                     </tr>
                                     @endforeach
                                     </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="add-subject">
                    <div class="card">

                        <div class="card-header">

                            <h3 class="card-title">Add  Subject</h3>


                            <div class="card-options ">
                                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                            </div>
                        </div>
                        <form  role="form" id="inline-validation" class="form-horizontal form-stripe" action="{{ route('subject.store') }}" method="POST">
                            @csrf

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Subject Name <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="subject" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label"> Subject Code <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" id="subject_code" name="subject_code" placeholder="Subject Code" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label"> Remark <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" id="remark" name="remark" placeholder="Remark" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label"></label>
                                <div class="col-md-7">
                                    <button type="submit" class="btn btn-primary">Add Subject</button>

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
          text: "Deleting this record will affect other associated records (e.g Any Record where this Subject is featured)",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            spinner.show();
            $.ajax({

                url: 'ajaxsubject/'+id,
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
