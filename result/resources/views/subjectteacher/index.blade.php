@extends('layouts.master')
@section('content')

     <!-- Start Page title and tab -->
     <div class="section-body">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center ">
                <div class="header-action">
                    <h1 class="page-title">School</h1>
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Subject Teacher</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Subject Teacher</li>
                    </ol>
                </div>
                <ul class="nav nav-tabs page-header-tab">
                    @can('subject-teacher-list')
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#subjectteacher">List View</a></li>
                    @endcan

                    @can('assign-subject-teacher')
                    <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#subjectteacher-add"></a></li>
                    @endcan
                    @can('subject-teacher-list')
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#subjectteacher"></a></li>
                    @endcan

                    @can('assign-subject-teacher')
                    <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#subjectteacher-add">Add Subject Teacher</a></li>
                    @endcan
                    @can('subject-teacher-list')
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#subjectteacher"></a></li>
                    @endcan

                    @can('assign-subject-teacher')
                    <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#subjectteacher-add"></a></li>
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
                <div class="tab-pane active" id="subjectteacher">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-striped table_custom">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Staff</th>
                                            <th>Subject</th>
                                            <th>Subject Code</th>
                                            <th>Term</th>
                                            <th>Session</th>
                                            <th>Date Registered</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $sn = 1; ?>
                                     @foreach ($subjectteacher as $sc)
                                     <tr id="sid{{$sc->id  }}">
                                         <td>{{ $sn++ }}</td>
                                         <td>{{ $sc->staffname }}</td>
                                         <td>{{ $sc->subjectname }}</td>
                                         <td>{{ $sc->subjectcode }}</td>
                                         <td>{{ $sc->termname }}</td>
                                         <td>{{ $sc->sessionname }}</td>
                                         <td>{{ $sc->date}}</td>
                                         <td>
                                             <div class="btn-group">
                                             @can('edit-class-teacher')
                                             <a href="{{ route('subjectteacher.edit',$sc->id) }}" class="btn fa fa-pencil" data-toggle="tooltip" title="Edit Class Teacher"></a>
                                             @endcan
                                             </div>
                                             <div class="btn-group">
                                             @can('subject-teacher-delete')
                                             <a href="javascript:void(0)" class="btn fa fa-trash delete"
                                                 data-toggle="tooltip" title="Delete subject Teacher" onClick="check({{ $sc->id }})"></a>
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

                <div class="tab-pane" id="subjectteacher-add">
                    <div class="card">

                        <div class="card-header">

                            <h3 class="card-title">Add Subject Teacher</h3>

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
                        <form  role="form" id="inline-validation" class="form-horizontal form-stripe" action="{{ route('subjectteacher.store') }}" method="POST">
                            @csrf

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Select Teacher <span class="text-danger">*</span></label>
                                <div class="col-md-7">

                                    <select name ="staffid" id="staffid"  class="form-control" required>
                                        <option value="" selected>Select staff</option>
                                        @foreach ($staffs as $staff => $name )
                                         <option value="{{$name->userid}}">{{ $name->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Select Subject <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <select name ="subjectid" id="subjectid"  class="form-control" >
                                        <option value="" selected>Select Subject</option>
                                        @foreach ($subjects as $subject => $name )
                                         <option value="{{$name->id}}">{{ $name->subject }} ............................. {{ $name->subject_code }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Select Term<span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                  <select name ="termid" id="termid"  class="form-control" >
                                      <option value="" selected>Select Term </option>
                                       @foreach ($terms as $term => $name )
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
          text: "Deleting this record will affect other associated records (e.g Class Subject Records )",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            spinner.show();
            $.ajax({

                url: 'ajaxsubteacher/'+id,
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
