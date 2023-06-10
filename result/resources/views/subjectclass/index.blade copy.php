@extends('layouts.master')
@section('content')
<div class="content">
    <div class="content-header">
        <div class="leftside-content-header">
            <ul class="breadcrumbs">
                <li><i class="fa fa-table" aria-hidden="true"></i><a href="{{ route('subjectclass.index') }}">Subject Class </a></li>
                <li><a>Subject Class Management</a></li>
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
 @if (\Session::has('danger'))
    <div class="alert alert-warning fade in">
     <a href="#" class="close" data-dismiss="alert">&times;</a>
         <p>{{ \Session::get('danger') }}</p>
     </div>
 @endif
 <span class="float-right">
    <a class="btn btn-primary  btn fa fa-plus" href="{{ route('subjectclass.create') }}">  Assign Subject to Class</a>
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
                            <th>Class</th>
                            <th>Arm</th>
                            <th>Category</th>
                            <th>Subject</th>
                            <th>Subject Teacher</th>
                            <th>Profile Picture</Picture></th>
                            <th>Action</th>
                            <th>Date Registered</th>
                        </tr>
                        </thead>
                        <tbody>
                           <?php $sn = 1; ?>
                        @foreach ($subjectclasses as $sc)
                        <tr id="sid{{ $sc->scid }}">
                            <td>{{ $sn++ }}</td>
                            <td>{{ $sc->sclass }} </td>
                            <td>{{ $sc->sarm }}</td>
                            <td>{{ $sc->sdesc }}</td>
                            <td>{{ $sc->subjectname }} <h6 class="text-xs color-warning">({{ $sc->subjectcode }})</h6></td>
                            <td>{{ $sc->teachername }}</td>
                            <td> <img src="{{ $sc->picture }}" /></td>
                            <td>
                                <div class="btn-group">
                                    @can('subject-class-edit')
                                    <a href="{{ route('subjectclass.edit',$sc->scid) }}" class="btn fa fa-pencil" data-toggle="tooltip" title="Edit Subject Class"></a>
                                    @endcan
                                    </div>
                                <div class="btn-group">
                                @can('subject-class-delete')
                                <a href="javascript:void(0)" class="btn fa fa-trash delete"
                                    data-toggle="tooltip" title="Delete subject Class" onClick="check({{ $sc->scid }})"></a>
                                  @endcan
                            </div>
                        </td>
                            <td>{{ $sc->updated_at }}</td>
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
            url: 'ajaxsubclass/'+id,
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
