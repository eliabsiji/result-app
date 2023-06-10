 <!-- Start Page header -->
 <div class="section-body" id="page_top">
    <div class="container-fluid">
        <div class="page-header">
            <div class="left">

            </div>
            <div class="right">
                <ul class="nav nav-pills">

                </ul>
                <div class="notification d-flex">


                    <div class="dropdown d-flex">
                        <a href="javascript:void(0)" class="chip ml-3" data-toggle="dropdown">
                            <?php
                            use App\Models\StaffPicture;
                            use App\Models\User;
                            use App\Models\Staff;
                            $users = StaffPicture::where('staffid',1)->get();
                            foreach ($users as $key => $user) {
                                # code...
                            }

                            if ($user->picture == NULL || $user->picture =="" || !isset($user->picture) ){

                                  // $cimage =  $imageclass;
                                   $image =  'unnamed.png';
                            }else {

                               $image =  $user->picture;
                            }

                            ?>
                            <span class="avatar" style="background-image: url({{ asset('images/staffpics/'.$image) }})"></span> {{ Auth::user()->name }}</a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">


                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="dropdown-icon fe fe-log-out"></i>  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                                </form>Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
