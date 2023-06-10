@extends('layouts.master')
@section('content')

<div class="content">
    <div class="content-header">
        <div class="leftside-content-header">
            <ul class="breadcrumbs">
                <li><i class="fa fa-table" aria-hidden="true"></i><a href="{{ route('session.create') }}">School Session </a></li>
                <li><a>School Session Management</a></li>
            </ul>
        </div>
    </div>
    @if (\Session::has('danger'))
    <div class="alert alert-danger fade in">
     <a href="#" class="close" data-dismiss="alert">&times;</a>
         <p>{{ \Session::get('danger') }}</p>
     </div>
 @endif
     @if (\Session::has('success'))
    <div class="alert alert-success fade in">
     <a href="#" class="close" data-dismiss="alert">&times;</a>
         <p>{{ \Session::get('success') }}</p>
     </div>
 @endif
 <span class="float-right">
    <a class="btn btn-primary  btn fa fa-plus" href="{{ route('session.create') }}">  Add School Session</a>
</span>
<div class="row animated fadeInRight">
        <div class="col-sm-12">
            <h4 class="section-subtitle">Registered Subjects</h4>
            <div class="panel">
                <div class="panel-content">
                    <table id="responsive-table" class="data-table table table-striped table-hover responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>Session</th>
                            <th>Status</th>
                            <th>Action</th>
                            <th>Date Registered</th>
                            <th>Date Updated</th>
                        </tr>
                        </thead>
                        <tbody>
                           <?php $sn = 1; ?>
                        @foreach ($sessions as $session)

                        <tr>
                            <td>{{ $sn++ }}</td>
                            <td>{{ $session->session }}</td>
                            <td>{{ $session->status }}</td>

                            <td>
                                <div class="btn-group">
                                @can('edit-session')
                                <a href="{{ route('session.edit',$session->id) }}" class="btn fa fa-pencil" data-toggle="tooltip" title="Edit Session"></a>
                                @endcan
                                </div>
                                <div class="btn-group">
                                @can('delete-session')
                                {!! Form::open(['method' => 'DELETE','route' => ['session.destroy', $session->id],]) !!}
                                <button  class="btn fa fa-trash" data-toggle="tooltip"
                                title="Delete Session" ></button>
                                {!! Form::close() !!}
                            @endcan
                            </div></td>
                            <td>{{ $session->created_at }}</td>
                            <td>{{ $session->updated_at }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
