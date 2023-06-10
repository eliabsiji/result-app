@extends('layouts.master')
@section('content')

<div class="content">
    <div class="content-header">
        <div class="leftside-content-header">
            <ul class="breadcrumbs">
                <li><i class="fa fa-table" aria-hidden="true"></i><a href="{{ route('schoolclass.index') }}">School Class Management</a></li>
                <li><a>School Class Management</a></li>
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
    <a class="btn btn-primary  btn fa fa-plus" href="{{ route('schoolclass.create') }}">  Add School Class</a>
</span>
<div class="row animated fadeInRight">
        <div class="col-sm-12">
            <h4 class="section-subtitle">Registered School Class</h4>
            <div class="panel">
                <div class="panel-content">
                    <table id="responsive-table" class="data-table table table-striped table-hover responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>Class</th>
                            <th>Arm</th>
                            <th>Category</th>
                            <th>Action</th>
                            <th>Date Registered</th>
                        </tr>
                        </thead>
                        <tbody>
                           <?php $sn = 1; ?>
                        @foreach ($all_classes as $class)

                        <tr>
                            <td>{{ $sn++ }}</td>
                            <td>{{ $class->schoolclass }}</td>
                            <td>{{ $class->arm }}</td>
                            <td>{{ $class->description }}</td>
                            <td><div class="btn-group">
                                <a href="{{ route('schoolclass.create') }}" class="btn fa fa-plus" data-toggle="tooltip"  title="Add More Class"></a>
                                @can('edit-school-class')
                                <a href="{{ route('schoolclass.edit',$class->id) }}" class="btn fa fa-pencil" data-toggle="tooltip" title="Edit Class"></a>
                                @endcan
                                @can('delete-school-class')
                                {!! Form::open(['method' => 'DELETE','route' => ['schoolclass.destroy', $class->id],]) !!}
                                <button class="btn  fa fa-trash" data-toggle="tooltip" title="Delete Class"></button>
                                {!! Form::close() !!}
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
</div>
</div>

@endsection
