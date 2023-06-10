@extends('layouts.master')
@section('content')

<div class="content">
    <div class="content-header">
        <div class="leftside-content-header">
            <ul class="breadcrumbs">
                <li><i class="fa fa-table" aria-hidden="true"></i>
                    @can('add-school-arm')
                  <a href="{{ route('schoolarm.index') }}">School Arm</a>
                  @endcan
                  </li>
                <li><a>School Arm Management</a></li>
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
    <a class="btn btn-primary  btn fa fa-plus" href="{{ route('schoolarm.create') }}">  Add Arm</a>
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
                            <th>Arm</th>
                            <th>Description</th>
                            <th>Action</th>
                            <th>Date Registered</th>
                        </tr>
                        </thead>
                        <tbody>
                           <?php $sn = 1; ?>
                        @foreach ($all_arms as $arm)

                        <tr>
                            <td>{{ $sn++ }}</td>
                            <td>{{ $arm->arm }}</td>
                            <td>{{ $arm->description }}</td>
                            <td><div class="btn-group">
                                <a href="{{ route('schoolarm.create') }}" class="btn fa fa-plus" data-toggle="tooltip"  title="Add More Arm"></a>
                                @can('edit-school-arm')
                                <a href="{{ route('schoolarm.edit',$arm->id) }}" class="btn fa fa-pencil" data-toggle="tooltip" title="Edit Arm"></a>
                                @endcan
                                @can('delete-school-arm')
                                {!! Form::open(['method' => 'DELETE','route' => ['schoolarm.destroy', $arm->id],]) !!}
                                <button class="btn  fa fa-trash" data-toggle="tooltip" title="Delete Arm"></button>
                                {!! Form::close() !!}
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
</div>


    </div>
</div>


@endsection
