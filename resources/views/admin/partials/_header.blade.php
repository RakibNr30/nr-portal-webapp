<header id="page-topbar" style="background: #252627">
    <div class="navbar-header">
        <div class="container-fluid">
            <div class="float-right">
                <div class="dropdown d-none d-sm-inline-block">
                    <button type="button" class="btn header-item waves-effect" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                        @if(\Illuminate\Support\Facades\App::getLocale() == 'en')
                            <img class="" src="{{ asset('admin/images/flags/us.jpg') }}" alt="Header Language" height="16">
                        @else
                            <img class="" src="{{ asset('admin/images/flags/dutch.png') }}" alt="Header Language" height="16">
                        @endif
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- item-->
                        <a href="{{ '?lang=en' }}" class="dropdown-item notify-item">
                            <img src="{{ asset('admin/images/flags/us.jpg') }}" alt="user-image" class="mr-1"
                                 height="12"> <span class="align-middle">English</span>
                        </a>
                        <!-- item-->
                        <a href="{{ '?lang=dt' }}" class="dropdown-item notify-item">
                            <img src="{{ asset('admin/images/flags/dutch.png') }}" alt="user-image" class="mr-1"
                                 height="12"> <span class="align-middle">{{ __('admin/master.dutch') }}</span>
                        </a>
                    </div>
                </div>

                <div class="dropdown d-none d-lg-inline-block ml-1">
                    <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                        <i class="mdi mdi-fullscreen"></i>
                    </button>
                </div>

                @php
                    $user = \Modules\Ums\Entities\User::find(auth()->user()->id);
                    $unreadMsg = \App\Message::where('read', 0)->where('to', auth()->user()->id)->count();
                @endphp

                @if(!($user->hasRole('admin')))
                   @if(\Request::path() != 'inbox')
                        <div class="dropdown d-inline-block">
                            <button onclick="HitUrl()" class="btn header-item noti-icon waves-effect"
                                    id="page-header-notifications-dropdown">
                                <i class="mdi mdi-message-processing-outline"></i>
                                @if($unreadMsg)
                                    <span class="badge badge-danger badge-pill">
                                        {{ $unreadMsg }}
                                    </span>
                                @endif
                            </button>
                        </div>
                   @endif
                @endif
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
                                    <h6 class="m-0"> {{ __('admin/master.notifications') }} </h6>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ url('/backend/notifications') }}" class="small"> {{ __('admin/master.view_all') }}</a>
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
                                else if ($notification->type == "ClientApproval") $url = '/backend/project/pending/' . $project_id;
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
                                                @php
                                                    \Carbon\Carbon::setLocale('nl_NL');
                                                @endphp
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
                                            <p class="mb-1" style="color: #495057; font-weight: 450;">{{ __('admin/master.no_new_notification') }}!</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                        <div class="p-2 border-top">
                            <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="{{ url('/backend/notifications') }}">
                                <i class="mdi mdi-arrow-right-circle mr-1"></i> {{ __('admin/master.view_more') }}..
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
                            {{ __('admin/master.my_profile') }}
                        </a>
                        <a class="dropdown-item d-block" href="{{ url('/backend/profile/account-info') }}">
                            <i class="bx bx-wrench font-size-16 align-middle mr-1"></i>
                            {{ __('admin/master.account_setting') }}
                        </a>
                        <a class="dropdown-item d-block" href="{{ url('/backend/profile/change-password') }}">
                            <i class="bx bxs-key font-size-16 align-middle mr-1"></i>
                            {{ __('admin/master.change_password') }}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                            <i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i>
                            {{ __('admin/master.logout') }}
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
                            <img src="{{ $global_site->logo->file_url ?? config('core.image.default.logo') }}" alt="LOGO" height="24">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ $global_site->logo->file_url ?? config('core.image.default.logo') }}" alt="LOGO" height="48">
                        </span>
                    </a>
                </div>
                <button type="button" class="btn btn-sm px-3 font-size-16 header-item toggle-btn waves-effect"
                        id="vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
            </div>

        </div>
    </div>
</header>
