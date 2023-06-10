@extends('layouts.master')
@section('content')
<!-- Start Page title and tab -->
<div class="section-body">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <div class="header-action">
                <h1 class="page-title">Dashboard</h1>
                <ol class="breadcrumb page-breadcrumb">

                    <li class="breadcrumb-item"><a href="#">School</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </div>
            <ul class="nav nav-tabs page-header-tab">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#admin-Dashboard">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#admin-Activity">Activity</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="section-body mt-4">
    <div class="container-fluid">
        <div class="row clearfix row-deck">
            <div class="col-6 col-md-4 col-xl-2">
                <div class="card">
                    <div class="card-body ribbon">
                        <div class="ribbon-box green" data-toggle="tooltip" title="New Professors">{{ $staff }}</div>
                        <a href="/staff" class="my_sort_cut text-muted">
                            <i class="fa fa-black-tie"></i>
                            <span>Staff</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-xl-2">
                <div class="card">
                    <div class="card-body ribbon">
                            <div class="ribbon-box green" data-toggle="tooltip" title="New Professors">{{ $student }}</div>
                        <a href="/student" class="my_sort_cut text-muted">
                            <i class="fa fa-address-book"></i>
                            <span>Student</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-xl-2">
                <div class="card">
                    <div class="card-body ribbon">
                        <div class="ribbon-box green" data-toggle="tooltip" title="New Staff">{{ $parent }}</div>
                        <a href="/parent" class="my_sort_cut text-muted">
                            <i class="fa fa-user-circle-o"></i>
                            <span>Parent</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-xl-2">
                <div class="card">
                    <div class="card-body ribbon">
                        <div class="ribbon-box green" data-toggle="tooltip" title="New Professors">{{ $subject }}</div>
                        <a href="/subject" class="my_sort_cut text-muted">
                            <i class="fa fa-folder"></i>
                            <span>Subjects</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-xl-2">
                <div class="card">
                    <div class="card-body ribbon">
                        <div class="ribbon-box green" data-toggle="tooltip" title="New Professors">{{ $schoolclass }}</div>
                        <a href="/schoolclass" class="my_sort_cut text-muted">
                            <i class="fa fa-address-book"></i>
                            <span>Classes</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-xl-2">
                <div class="card">
                    <div class="card-body ribbon">
                        <div class="ribbon-box green" data-toggle="tooltip" title="New Professors">5</div>
                        <a href="holiday.html" class="my_sort_cut text-muted">
                            <i class="fa fa-bullhorn"></i>
                            <span>Fees</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-content">





    </div>
</div>
@endsection
