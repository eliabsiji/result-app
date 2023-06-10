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
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#myclass">My Class</a></li>
                    @endcan

                    @can('add-class-teacher')
                    <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#classteacher-add"></a></li>
                    @endcan

                    @can('class-teacher-list')
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#classteacher"></a></li>
                    @endcan

                    @can('add-class-teacher')
                    <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#myclasshistory"> My Class History</a></li>
                    @endcan

                    @can('class-teacher-list')
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#classteacher"></a></li>
                    @endcan

                    @can('add-class-teacher')
                    <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#classteacher-add"></a></li>
                    @endcan

                    @can('add-classsettings')
                    <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#myclasssettings"> My Class Settings</a></li>
                    @endcan

                    @can('class-teacher-list')
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#classteacher"></a></li>
                    @endcan


                    <li class="nav-item"><a class="nav-link" id="Library-tab-Boot" data-toggle="tab" href="#classteacher-add"></a></li>

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
                <div class="tab-pane active" id="myclass">
                    <div class="card">
                        <div class="card-header">

                            <h5 class="card-title">My Classes for curent session</h5>


                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-striped table_custom">
                                    <thead>

                                            <tr>
                                                <th>SN</th>
                                                <th>Class</th>
                                                <th>Arm</th>
                                                <th>Term</th>
                                                <th>Session</th>
                                               <th>Action</th>

                                            </tr>

                                    </thead>
                                    <tbody>
                                        <?php $sn = 1; ?>
                                     @foreach ($myclass as $sc)
                                     <tr id="sid{{ $sc->id }}">
                                         <td>{{ $sn++ }}</td>
                                         <td>{{ $sc->schoolclass }} </td>
                                         <td>{{ $sc->schoolarm }}</td>
                                         <td>{{ $sc->term }}</td>
                                         <td>{{ $sc->session }}</td>
                                          <td>
                                             <div class="btn-group">
                                                 @can('view-student-list')
                                                 <a href="viewstudent/{{ $sc->schoolclassID }}/{{ $sc->termid }}/{{ $sc->sessionid }}" class="btn fa fa-eye" data-toggle="tooltip" title="View Students {{$sc->schoolclass}}  {{ $sc->schoolarm}} Class">View Students</a>
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

                <div class="tab-pane" id="myclasshistory">
                    <div class="card">
                        <div class="card-header">

                            <h3 class="card-title">My Class History</h3>


                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-striped table_custom">
                                    <thead>

                                            <tr>
                                                <th>SN</th>
                                                <th>Class</th>
                                                <th>Arm</th>
                                                <th>Term</th>
                                                <th>Session</th>
                                               <th>Action</th>

                                            </tr>

                                    </thead>
                                    <tbody>
                                        <?php $sn = 1; ?>
                                     @foreach ($myclasshistory as $sc)
                                     <tr id="sid{{ $sc->id }}">
                                         <td>{{ $sn++ }}</td>
                                         <td>{{ $sc->schoolclass }} </td>
                                         <td>{{ $sc->schoolarm }}</td>
                                         <td>{{ $sc->term }}</td>
                                         <td>{{ $sc->session }}</td>
                                          <td>
                                             <div class="btn-group">
                                                 @can('view-student-list')
                                                 <a href="viewstudent/{{ $sc->schoolclassID }}/{{ $sc->termid }}/{{ $sc->sessionid }}" class="btn fa fa-eye" data-toggle="tooltip" title="View Students {{$sc->schoolclass}}  {{ $sc->schoolarm}} Class"></a>
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



                <div class="tab-pane" id="myclasssettings">
                    <div class="card">
                        <div class="card-header">

                            <h3 class="card-title">My Class Settings</h3>


                        </div>

                        <div class="card-body">

                            <form  role="form" id="inline-validation" class="form-horizontal form-stripe" action="{{ route('myclass.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="staffid" value="{{ $sfid }}">


                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Select Class<span class="text-danger">*</span></label>
                                    <div class="col-md-7">
                                      <select name ="vschoolclassid" id="vschoolclassid"  class="form-control" required>
                                          <option value="" selected>Select Class </option>
                                           @foreach ($myclasses as $term => $name )
                                          <option value="{{$name->schoolclassID}}">{{ $name->schoolclass}} {{ $name->schoolarm}}</option>
                                         @endforeach
                                     </select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">No. of Time School Opened <span class="text-danger">*</span></label>
                                    <div class="col-md-7">
                                       <input type="number" name="noschoolopened" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Term ends <span class="text-danger">*</span></label>
                                    <div class="col-md-7">
                                        <input type="date" name="termends" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Next Term Begins <span class="text-danger">*</span></label>
                                    <div class="col-md-7">
                                        <input type="date" name="nexttermbegins" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Select Term<span class="text-danger">*</span></label>
                                    <div class="col-md-7">
                                      <select name ="termid" id="termid"  class="form-control" required>
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
                                        <button type="submit" class="btn btn-primary">Submit</button>

                                    </div>
                                </div>
                            </form>



                            <div class="card">

                                <table class="table table-hover js-basic-example dataTable table-striped table_custom   ">
                                    <thead>
                                        <tr>

                                                <th>SN</th>
                                                <th>No. Times Sch. Opened</th>
                                                <th>Terms Ends</th>
                                                <th>Next Term Begins</th>
                                                <th>Term</th>
                                                <th>Session</th>
                                                <th>Actions</th>
                                                <th>Date Registered</th>



                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $sn = 1; ?>
                                     @foreach ($classsetting as $s)

                                     <tr id="ssid{{ $s->id }}">
                                         <td>{{ $sn++ }}</td>
                                         <td>{{ $s->noschoolopened }}</td>
                                         <td>{{ $s->termends }}</td>
                                         <td>{{ $s->nexttermbegins }}</td>
                                         <td>{{ $s->term }}</td>
                                         <td>{{ $s->session }}</td>
                                         <td>
                                             <div class="btn-group">
                                             @can('delete-classsettings')
                                             <a href="javascript:void(0)" class="btn fa fa-trash delete"
                                             data-toggle="tooltip" title="Delete Class Settings " onClick="check({{ $s->id }})"></a>
                                         @endcan
                                         </div></td>
                                         <td>{{ $s->created_at }}</td>

                                     </tr>
                                     @endforeach
                                     </tbody>
                                </table>

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
          text: "Deleting this record cannot be reversed",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            spinner.show();
            $.ajax({

                url: 'ajaxclasssettings/'+id,
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
              'This Record is now Deleted. ',
              'success'
            )

            var myobj = document.getElementById("ssid"+id);
             myobj.remove();

          }
        })

        }
    </script>

    @endsection
