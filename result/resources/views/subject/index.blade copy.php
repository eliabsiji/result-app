@extends('layouts.master')
@section('content')

<div class="content">
    <div class="content-header">
        <div class="leftside-content-header">
            <ul class="breadcrumbs">
                <li><i class="fa fa-table" aria-hidden="true"></i><a href="{{ route('subject.index') }}">Subject</a></li>
                <li><a>Subject Management</a></li>
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
    <a class="btn btn-primary  btn fa fa-plus" href="{{ route('subject.create') }}">  Add Subject</a>
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

                        <tr>
                            <td>{{ $sn++ }}</td>
                            <td>{{ $subject->subject }}</td>
                            <td>{{ $subject->subject_code }}</td>
                            <td>{{ $subject->remark }}</td>
                            <td><div class="btn-group">
                                <a href="{{ route('subject.create') }}" class="btn fa fa-plus" data-toggle="tooltip"  title="Add More Subjects"></a>
                                @can('edit-subject')
                                <a href="{{ route('subject.edit',$subject->id) }}" class="btn fa fa-pencil" data-toggle="tooltip" title="Edit Subject"></a>
                                @endcan
                                @can('delete-subject')
                                {!! Form::open(['method' => 'DELETE','route' => ['subject.destroy', $subject->id],]) !!}
                                <button  class="btn fa fa-trash" data-toggle="tooltip"
                                title="Delete Subject" ></button>
                                {!! Form::close() !!}
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
</div>
@endsection
