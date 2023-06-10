<div class="left-sidebar">
            <!-- left sidebar HEADER -->
            <div class="left-sidebar-header">
                <div class="left-sidebar-title">Navigation</div>
                <div class="left-sidebar-toggle c-hamburger c-hamburger--htla hidden-xs" data-toggle-class="left-sidebar-collapsed" data-target="html">
                    <span></span>
                </div>
            </div>
            <!-- NAVIGATION -->
            <!-- ========================================================= -->
             <div id="left-nav" class="nano">
                <div class="nano-content">
                    <nav>
                        <ul class="nav" id="main-nav">
                            <!--HOME-->
                            @can('dashboard')
                            <li class="active-item"><a href="/dashboard"><i class="fa fa-home" aria-hidden="true"></i><span>Dashboard</span></a></li>
                            @endcan
                            <!--UI ELEMENTENTS-->
                            <li class="has-child-item close-item">
                                <a><i class="fa fa-cubes" aria-hidden="true"></i><span>Role Access Control</span></a>
                                <ul class="nav child-nav level-1">
                                 @can('user-list')
                                    <li>
                                    <a href="{{ route('users.index') }}">Users</a>
                                    </li>
                                @endcan
                                @can('role-list')
                                <li>
                                <a class="nav-link" href="{{ route('roles.index') }}">Roles</a>
                                </li>
                                @endcan
                                @can('permission-list')
                                <li>
                                <a class="nav-link" href="{{ route('permissions.index') }}">Permission</a>
                                </li>
                                @endcan
                                </ul>
                            </li>

                            <!--MENU LEVELS-->
                            <li class=" has-child-item close-item">
                                @can('academic-operations-list')
                                  <a>
                                    <i class="fa fa-sitemap" aria-hidden="true"></i>
                                    <span>Academic Operations</span>
                                </a>
                                @endcan

                                <ul class="nav child-nav level-1">


                                    <li class="has-child-item close-item">
                                      @can('arm-list')
                                       <a>Arm</a>
                                        <ul class="nav child-nav level-2 ">

                                            <li><a href="{{ route('schoolarm.index') }}">Arm Management</a></li>

                                        </ul>
                                        @endcan
                                    </li>
                                    <li class="has-child-item close-item">
                                        @can('school-class-list')<a>Class</a>
                                        <ul class="nav child-nav level-2 ">
                                            <li><a href="{{ route('schoolclass.index') }}">Class Management</a></li>
                                         </ul>
                                        @endcan
                                    </li>
                                    <li class="has-child-item close-item">
                                         @can('subject-list')<a>Subject</a>
                                        <ul class="nav child-nav level-2 ">

                                            <li><a href="{{ route('subject.index') }}">Subject Management</a></li>
                                         </ul>
                                         @endcan
                                    </li>
                                    <li class="has-child-item close-item">
                                        @can('subject-teacher-list')
                                         <a>Assign Subject Teacher</a>
                                        <ul class="nav child-nav level-2 ">

                                            <li><a href="{{ route('subjectteacher.index') }}">Manage Subject Teacher</a></li>

                                        </ul>
                                        @endcan
                                    </li>
                                    <li class="has-child-item close-item">
                                        @can('subject-class-list')
                                        <a>Assign Subject to Class</a>
                                        <ul class="nav child-nav level-2 ">

                                            <li><a href="{{ route('subjectclass.index') }}">Manage Subject Class</a></li>

                                        </ul>
                                        @endcan
                                    </li>


                                    <li class="has-child-item close-item">
                                       @can('class-teacher-list')
                                       <a>Assign Class Teacher</a>
                                        <ul class="nav child-nav level-2 ">

                                            <li><a href="{{ route('classteacher.index') }}">Manage Class Teacher</a></li>

                                        </ul>
                                        @endcan
                                    </li>
                                    <li class="has-child-item close-item">
                                       @can('session-list') <a>School Session</a>
                                        <ul class="nav child-nav level-2 ">

                                            <li><a href="{{ route('session.index') }}">Session Management</a></li>

                                        </ul>
                                        @endcan
                                    </li>
                                    <li class="has-child-item close-item">
                                       @can('term-list')
                                       <a>School Term</a>
                                        <ul class="nav child-nav level-2 ">

                                            <li><a href="{{ route('term.index') }}">Term Management</a></li>

                                        </ul>
                                        @endcan
                                    </li>

                                </ul>
                            </li>
                            <li class=" has-child-item close-item">
                                @can('staff-list')


                                <a>
                                    <i class="fa fa-sitemap" aria-hidden="true"></i>
                                    <span>Staff</span>
                                </a>
                                <ul class="nav child-nav level-1">

                                    <li class="has-child-item close-item">
                                        <a href="{{ route('staff.index') }}">Staff Management</a>

                                    </li>

                                </ul>
                            </li>
                            @endcan
                            <li class=" has-child-item close-item">
                                <a>
                                    <i class="fa fa-sitemap" aria-hidden="true"></i>
                                    <span>Student</span>
                                </a>
                                <ul class="nav child-nav level-1">

                                    <li class="has-child-item close-item">
                                        <a>Student</a>
                                        <ul class="nav child-nav level-2 ">
                                            @can('subject-list')
                                            <li><a href="{{ route('subject.index') }}">Student Management</a></li>
                                         @endcan

                                        </ul>
                                    </li>


                                </ul>
                            </li>
                            <li class=" has-child-item close-item">
                                <a>
                                    <i class="fa fa-sitemap" aria-hidden="true"></i>
                                    <span>Results and Reports</span>
                                </a>
                                <ul class="nav child-nav level-1">

                                    <li class="has-child-item close-item">
                                        <a>Result Operations</a>
                                        <ul class="nav child-nav level-2 ">
                                            @can('subject-list')
                                            <li><a href="{{ route('subject.index') }}">Result Management</a></li>
                                         @endcan

                                        </ul>
                                    </li>
                                    <li class="has-child-item close-item">
                                        <a>Report Operations</a>
                                        <ul class="nav child-nav level-2 ">
                                            @can('subject-list')
                                            <li><a href="{{ route('subject.index') }}">Report Management</a></li>
                                         @endcan

                                        </ul>
                                    </li>
                                    <li class="has-child-item close-item">
                                        <a>Promotion Operations</a>
                                        <ul class="nav child-nav level-2 ">
                                            @can('subject-list')
                                            <li><a href="{{ route('subject.index') }}">Promotion Management</a></li>
                                         @endcan

                                        </ul>
                                    </li>

                                </ul>
                            </li>
                            <li class=" has-child-item close-item">
                                <a>
                                    <i class="fa fa-sitemap" aria-hidden="true"></i>
                                    <span>Finance and Busary</span>
                                </a>
                                <ul class="nav child-nav level-1">

                                    <li class="has-child-item close-item">
                                        <a>F & B</a>
                                        <ul class="nav child-nav level-2 ">
                                            @can('subject-list')
                                            <li><a href="{{ route('subject.index') }}">F & B Management</a></li>
                                         @endcan

                                        </ul>
                                    </li>

                                </ul>
                            </li>
                            <!--MENU LEVELS-->
                            <li class=" has-child-item close-item">
                                <a>
                                    <i class="fa fa-sitemap" aria-hidden="true"></i>
                                    <span>Settings</span>
                                </a>
                                <ul class="nav child-nav level-1">


                                    <li class="has-child-item close-item">
                                        <a>School Session</a>
                                        <ul class="nav child-nav level-2 ">
                                            @can('subject-list-class')
                                            <li><a href="{{ route('subjectclass.index') }}">Session Management</a></li>
                                         @endcan
                                        </ul>
                                    </li>
                                    <li class="has-child-item close-item">
                                        <a>School Term</a>
                                        <ul class="nav child-nav level-2 ">
                                            @can('subject-list-class')
                                            <li><a href="{{ route('subjectclass.index') }}">Term Management</a></li>
                                         @endcan
                                        </ul>
                                    </li>

                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
</div>
