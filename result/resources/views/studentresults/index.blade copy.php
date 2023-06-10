@extends('layouts.master')
@section('content')

<div class="content">
    <div class="content-header">
        <div class="leftside-content-header">
            <ul class="breadcrumbs">
                <li><i class="fa fa-table" aria-hidden="true"></i><a href="{{ route('classteacher.index') }}"> class Teacher</a></li>
                <li><a>Class Teacher  Management</a></li>
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
    <div class="alert alert-warning fade in">
     <a href="#" class="close" data-dismiss="alert">&times;</a>
         <p>{{ \Session::get('success') }}</p>
     </div>
 @endif
 <span class="float-right">
    <a class="btn btn-primary  btn fa fa-plus" href="{{ route('classteacher.create') }}">  Assign Class Teacher</a>
</span>
<div class="row animated fadeInRight">
        <div class="col-sm-12">
            <h4 class="section-subtitle">Registered Class Teacher</h4>
            <div class="panel">
                <div class="panel-content">
                    <table id="responsive-table" class="data-table table table-striped table-hover responsive nowrap" cellspacing="0" width="100%">
                        <thead>
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
                                @can('subject-teacher-delete')
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
    <div id="loader"></div>
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
          'This Record Has Been Deleted. You can Check Other Records to make neccessary Editing!',
          'success'
        )

        var myobj = document.getElementById("sid"+id);
         myobj.remove();

      }
    })

    }
    </script>

@endsection
