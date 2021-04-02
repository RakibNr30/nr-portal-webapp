<header id="page-topbar">
    <div class="navbar-header">
        <div class="container-fluid">
            <div class="float-right">

              {{--  <div class="dropdown d-inline-block d-lg-none ml-2">
                    <button type="button" class="btn header-item noti-icon waves-effect"
                            id="page-header-search-dropdown" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                        <i class="mdi mdi-magnify"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                         aria-labelledby="page-header-search-dropdown">

                        <form class="p-3">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search ..."
                                           aria-label="Recipient's username">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>--}}

                <div class="dropdown d-none d-sm-inline-block">
                    <button type="button" class="btn header-item waves-effect" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                        <img class="" src="{{ asset('admin/images/flags/us.jpg') }}" alt="Header Language" height="16">
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <img src="{{ asset('admin/images/flags/us.jpg') }}" alt="user-image" class="mr-1"
                                 height="12"> <span class="align-middle">English</span>
                        </a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <img src="{{ asset('admin/images/flags/dutch.png') }}" alt="user-image" class="mr-1"
                                 height="12"> <span class="align-middle">Dutch</span>
                        </a>
                    </div>
                </div>

                <div class="dropdown d-none d-lg-inline-block ml-1">
                    <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                        <i class="mdi mdi-fullscreen"></i>
                    </button>
                </div>

                <?php
                    if(Auth::user()->role == 'admin'){
                        $notifications = App\Notification::where('status', 'unseen')->where('notification_to_type', 'admin')->orderBy('created_at', 'desc')->take(5)->get();
                        $notifications_count = App\Notification::where('status', 'unseen')->where('notification_to_type', 'admin')->count();

                    } else if(Auth::user()->role == 'client') {
                        $notifications = App\Notification::where('status', 'unseen')->where('notification_to_type', 'client')->where('notification_to', Auth::id())->orderBy('created_at', 'desc')->take(5)->get();
                        $notifications_count = App\Notification::where('status', 'unseen')->where('notification_to_type', 'client')->where('notification_to', Auth::id())->count();
                    } else {
                        $notifications = App\Notification::where('status', 'unseen')->where('notification_to_type', 'company')->where('notification_to', Auth::id())->orderBy('created_at', 'desc')->take(5)->get();
                        $notifications_count = App\Notification::where('status', 'unseen')->where('notification_to_type', 'company')->where('notification_to', Auth::id())->count();
                    }
                ?>

                <div class="dropdown d-inline-block">

                    <button type="button" class="btn header-item noti-icon waves-effect"
                            id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                        <i class="mdi mdi-bell-outline"></i>
                        @if($notifications_count > 0)
                            <span class="badge badge-danger badge-pill">

                                {{ $notifications_count }}

                            </span>
                        @endif
                    </button>

                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                         aria-labelledby="page-header-notifications-dropdown">
                        <div class="p-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0"> Notifications </h6>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ url('/notifications') }}" class="small"> View All</a>
                                </div>
                            </div>
                        </div>

                    @if($notifications_count > 0)
                        @foreach($notifications as $notification)
                        <?php
                            $user_avatar = App\User::where('id', $notification->notification_from)->first();
                            $url = '/';
                            if (isset($notification->project_id)) {
                                $project_id = \Modules\Cms\Entities\Project::where('project_id', $notification->project_id)->first()->id;
                                if ($notification->type == "ProjectCreation") $url = '/backend/project/pending/' . $project_id;
                                else if ($notification->type == "ProjectApproval") $url = '/backend/project/approved/' . $project_id;
                                else if ($notification->type == "ProjectClientApproval") $url = '/backend/project/accepted/' . $project_id;
                                else if ($notification->type == "ProjectCompanyFile") $url = '/backend/project/approved/' . $project_id;
                                else if ($notification->type == "ProjectAdminFile") $url = '/backend/project/approved/' . $project_id;
                            }
                        ?>
                            <div data-simplebar style="max-height: 230px;">
                                <a href="{{ $url }}" class="text-reset notification-item">
                                    <div class="media">
                                        <img src="{{ $user_avatar->avatar->file_url ?? config('core.image.default.avatar') }}"
                                             class="mr-3 rounded-circle avatar-xs" alt="user-pic">
                                        <div class="media-body">
                                            <div class="font-size-12 text-muted">
                                                <p class="mb-1" style="color: #495057; font-weight: 450;">{{ $notification->message }}</p>
                                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> {{ $notification->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <div data-simplebar style="max-height: 230px;">
                            <div class="text-reset notification-item">
                                <div class="media">
                                    <div class="media-body">
                                        <div class="font-size-14 text-muted">
                                            <p class="mb-1" style="color: #495057; font-weight: 450;">No new notification!</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                        <div class="p-2 border-top">
                            <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="{{ url('/notifications') }}">
                                <i class="mdi mdi-arrow-right-circle mr-1"></i> View More..
                            </a>
                        </div>
                    </div>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user"
                             src="{{ $user->avatar->file_url ?? config('core.image.default.avatar') }}" alt="">
                        <span class="d-none d-xl-inline-block ml-1">{{ $user->basicInfo->first_name }}</span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- item-->
                        <a class="dropdown-item" href="{{ url('/backend/profile/account-info') }}">
                            <i class="bx bx-user font-size-16 align-middle mr-1"></i>
                            My Profile
                        </a>
                        <a class="dropdown-item d-block" href="{{ url('/backend/profile/account-info') }}">
                            <i class="bx bx-wrench font-size-16 align-middle mr-1"></i>
                            Account Settings
                        </a>
                        <a class="dropdown-item d-block" href="{{ url('/backend/profile/change-password') }}">
                            <i class="bx bxs-key font-size-16 align-middle mr-1"></i>
                            Change Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                            <i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>

            <div>
                <div class="navbar-brand-box">
                    <a href="{{ '/backend/dashboard' }}" class="logo logo-light" style="display: initial">
                        <span class="logo-sm">
                            <img src="{{ $global_site->logo_sm->file_url ?? config('core.image.default.logo_sm') }}" alt="" height="20">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ $global_site->logo->file_url ?? config('core.image.default.logo') }}" alt="" height="19">
                        </span>
                    </a>
                </div>

              {{--  <button type="button" class="btn btn-sm px-3 font-size-16 header-item toggle-btn waves-effect"
                        id="vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>--}}

                {{--<form class="app-search d-none d-lg-inline-block">
                    <div class="position-relative">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="bx bx-search-alt"></span>
                    </div>
                </form>--}}
            </div>

        </div>
    </div>
</header>