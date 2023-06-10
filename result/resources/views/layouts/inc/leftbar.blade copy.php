 <!-- Start Main leftbar navigation -->
 <div id="left-sidebar" class="sidebar">
    <h5 class="brand-name">Ericsson<a href="javascript:void(0)" class="menu_option float-right"><i class="icon-grid font-16" data-toggle="tooltip" data-placement="left" title="Grid & List Toggle"></i></a></h5>
    <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu-cbt">CBT</a></li>
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#menu-uni">School</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu-admin">Admin</a></li>

    </ul>
    <div class="tab-content mt-3">
        <div class="tab-pane fade" id="menu-cbt" role="tabpanel">
            <nav class="sidebar-nav">
                <ul class="metismenu">
                    @can('user-list')
                    <li><a href="{{ route('users.index') }}"><i class="fa fa-credit-card"></i><span>Users</span></a></li>
                    @endcan
                    @can('role-list')
                    <li><a href="{{ route('roles.index') }}"><i class="fa fa-dashboard"></i><span>Roles</span></a></li>
                    @endcan
                    @can('permission-list')
                    <li><a href="{{ route('permissions.index') }}"><i class="fa fa-list-ul"></i><span>Permisssions</span></a></li>
                    @endcan
                </ul>
            </nav>
        </div>
        <div class="tab-pane fade show active" id="menu-uni" role="tabpanel">
            <nav class="sidebar-nav">
                <ul class="metismenu">
                    @can('dashboard')
                    <li class="active"><a href="/dashboard"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
                    <li class="dropdown-btn"><i class="fa fa-dashboard"></i><span>Dashboard<i class="fa fa-caret-down"></i></span></li>
                      <div class="dropdown-container">
                        <a href="#">Link 1</a>
                        <a href="#">Link 2</a>
                        <a href="#">Link 3</a>
                      </div>
                    @endcan
                    @can('academic-operations-list')
                    @can('school-arm-list')
                    <li><a href="{{ route('staff.index') }}"><i class="fa fa-black-tie"></i><span>Staff</span></a></li>
                    @endcan
                    @can('student-list')
                         <li><a href="{{ route('student.index') }}"><i class="fa fa-user-circle-o"></i><span>Student</span></a></li>
                    @endcan
                    @can('parent-list')
                         <li><a href="{{ route('parent.index') }}"><i class="fa fa-users"></i><span>Parent</span></a></li>
                    @endcan
                    <li><a href="{{ route('classoperation.index') }}"><i class="fa fa-users"></i><span>Class Operations</span></a></li>
                    @can('subject-operation-list')
                          <li><a href="{{ route('subjectoperation.index') }}"><i class="fa fa-users"></i><span>Student Subject Reg.</span></a></li>
                    @endcan
                    <li><a href=""><i class="fa fa-users"></i><span>Bursary and Finance</span></a></li>
                    @can('myclass-list')
                         <li><a href="{{ route('myclass.index') }}"><i class="fa fa-users"></i><span>My Classes</span></a></li>
                    @endcan
                    @can('mysubject-list')
                    <li><a href="{{ route('mysubject.index') }}"><i class="fa fa-users"></i><span>My Subjects</span></a></li>
                    @endcan
                    @can('myresultroom-list')
                    <li><a href="{{ route('myresultroom.index') }}"><i class="fa fa-users"></i><span>My Result Room</span></a></li>
                    @endcan
                    @can('studentresults-list')
                    <li><a href="{{ route('studentresults.index') }}"><i class="fa fa-users"></i><span>Student Results</span></a></li>
                    @endcan
                    <li class="g_heading">School Administration Operation Managements</li>
                    @can('session-list')
                    <li><a href="{{ route('session.index') }}"><i class="fa fa-map"></i><span>Session </span></a></li>
                    @endcan
                    @can('term-list')
                    <li><a href="{{ route('term.index') }}"><i class="fa fa-camera-retro"></i><span>Term </span></a></li>
                    @endcan
                    @can('schoolhouse-list')
                    <li><a href="{{ route('schoolhouse.index') }}"><i class="fa fa-camera-retro"></i><span>School House </span></a></li>
                    @endcan
                    @can('classcategory-list')
                    <li><a href="{{ route('classcategories.index') }}"><i class="fa fa-camera-retro"></i><span>Class Category </span></a></li>
                    @endcan
                    @can('school-arm-list')
                    <li><a href="{{ route('schoolarm.index') }}"><i class="fa fa-calendar"></i><span>Arm </span></a></li>
                    @endcan
                    @can('school-class-list')
                    <li><a href="{{ route('schoolclass.index') }}"><i class="fa fa-comments-o"></i><span>Class</span></a></li>
                    @endcan
                    @can('subject-list')
                    <li><a href="{{ route('subject.index') }}"><i class="fa fa-address-book"></i><span>Subject </span></a></li>
                    @endcan
                    @can('subject-teacher-list')
                    <li><a href="{{ route('subjectteacher.index') }}"><i class="fa fa-folder"></i><span>Subject Teacher </span></a></li>
                    @endcan
                    @can('subject-class-list')
                    <li><a href="{{ route('subjectclass.index') }}"><i class="fa fa-map"></i><span> Class Subject</span></a></li>
                    @endcan
                    @can('class-teacher-list')
                    <li><a href="{{ route('classteacher.index') }}"><i class="fa fa-camera-retro"></i><span>Class Teacher</span></a></li>

                    @endcan

                    @endcan

                </ul>
            </nav>
        </div>
        <div class="tab-pane fade" id="menu-admin" role="tabpanel">
            <nav class="sidebar-nav">
                <ul class="metismenu">
                    @can('user-list')
                    <li><a href="{{ route('users.index') }}"><i class="fa fa-credit-card"></i><span>Users</span></a></li>
                    @endcan
                    @can('role-list')
                    <li><a href="{{ route('roles.index') }}"><i class="fa fa-dashboard"></i><span>Roles</span></a></li>
                    @endcan
                    @can('permission-list')
                    <li><a href="{{ route('permissions.index') }}"><i class="fa fa-list-ul"></i><span>Permisssions</span></a></li>
                    @endcan
                </ul>
            </nav>
        </div>
    </div>
</div>
