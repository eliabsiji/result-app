@extends('layouts.master')
@section('content')
<div class="content">
    <div class="content-header">
        <div class="leftside-content-header">
            <ul class="breadcrumbs">
                <li><i class="fa fa-table" aria-hidden="true"></i><a href="{{ route('subjectteacher.index') }}">Subject Teacher </a></li>
                <li><a>Subject Teacher Management</a></li>
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
    <div class="alert alert-success fade in">
     <a href="#" class="close" data-dismiss="alert">&times;</a>
         <p>{{ \Session::get('success') }}</p>
     </div>
 @endif
 <span class="float-right">
    <a class="btn btn-primary  btn fa fa-plus" href="{{ route('subjectteacher.create') }}">  Assign Subject to Teacher</a>
</span>

<div class="row animated fadeInRight">
    <div class="col-sm-12">


        <div class="panel">
            <div class="panel-content">
                <div class="table-responsive">

                    <table id="responsive-table" class="data-table table table-striped table-hover responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>Staff</th>
                            <th>Subject</th>
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
</div>


    </div>
</div>

<script>

function check(id){
var url = "{{URL('ajaxsubject')}}";
    var dltUrl = url+"/"+id;
    var id = id;


    Swal.fire({
  title: 'Are you sure?',
  text: "Deleting this record will affect other associated records (e.g Subject To Class Records etc)",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {

    $.ajax({
        url: 'ajaxsub/'+id,
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
               console.log("svssdvsdvs");
            }
        }
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
