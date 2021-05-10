<div class="vertical-menu">
    <div class="h-100">
        @if (auth()->check())
            @php
                $user = \Modules\Ums\Entities\User::find(auth()->user()->id);
            @endphp
        <div class="user-wid text-center py-4">
            <div class="user-img">
                <img src="{{ $user->avatar->file_url ?? config('core.image.default.avatar') }}" alt="" class="avatar-md mx-auto rounded-circle" style="height: 50px; width: 50px">
            </div>
            <div class="mt-3">
                <a href="{{ url('/backend/profile/account-info') }}" class="text-dark font-weight-medium font-size-14">
                    {{ $user->basicInfo->first_name }}
                    {{ $user->basicInfo->last_name }}
                </a>
            </div>
        </div>

        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                @foreach(config('core.admin_menu') as $nav)
                    @if ($user->can($nav['permission']))
                        @if(empty($nav['children']))
                            <li>
                                <a href="{!! $nav['url'] !!}" class=" waves-effect">
                                    <i class="fas {!! $nav['icon'] !!}"></i>
                                    @if($nav['id'] == 'project')
                                        @if($user->hasRole('client'))
                                            @if(\Illuminate\Support\Facades\App::getLocale() == 'en')
                                                {!! $nav['name_client'] !!}
                                            @else
                                                {!! $nav['name_client_dt'] !!}
                                            @endif
                                        @elseif($user->hasRole('company'))
                                            @if(\Illuminate\Support\Facades\App::getLocale() == 'en')
                                                {!! $nav['name_company'] !!}
                                            @else
                                                {!! $nav['name_company_dt'] !!}
                                            @endif
                                        @elseif($user->hasRole('admin'))
                                            @if(\Illuminate\Support\Facades\App::getLocale() == 'en')
                                                {!! $nav['name_admin'] !!}
                                            @else
                                                {!! $nav['name_admin_dt'] !!}
                                            @endif
                                        @elseif($user->hasRole('super_admin'))
                                            @if(\Illuminate\Support\Facades\App::getLocale() == 'en')
                                                {!! $nav['name_super_admin'] !!}
                                            @else
                                                {!! $nav['name_super_admin_dt'] !!}
                                            @endif
                                        @endif
                                    @else
                                        @if(\Illuminate\Support\Facades\App::getLocale() == 'en')
                                            {!! $nav['name'] !!}
                                        @else
                                            {!! $nav['name_dt'] !!}
                                        @endif
                                    @endif
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="fas {!! $nav['icon'] !!}"></i>
                                    @if($nav['id'] == 'project')
                                        @if($user->hasRole('client'))
                                            @if(\Illuminate\Support\Facades\App::getLocale() == 'en')
                                                {!! $nav['name_client'] !!}
                                            @else
                                                {!! $nav['name_client_dt'] !!}
                                            @endif
                                        @elseif($user->hasRole('company'))
                                            @if(\Illuminate\Support\Facades\App::getLocale() == 'en')
                                                {!! $nav['name_company'] !!}
                                            @else
                                                {!! $nav['name_company_dt'] !!}
                                            @endif
                                        @elseif($user->hasRole('admin'))
                                            @if(\Illuminate\Support\Facades\App::getLocale() == 'en')
                                                {!! $nav['name_admin'] !!}
                                            @else
                                                {!! $nav['name_admin_dt'] !!}
                                            @endif
                                        @elseif($user->hasRole('super_admin'))
                                            @if(\Illuminate\Support\Facades\App::getLocale() == 'en')
                                                {!! $nav['name_super_admin'] !!}
                                            @else
                                                {!! $nav['name_super_admin_dt'] !!}
                                            @endif
                                        @endif
                                    @else
                                        @if(\Illuminate\Support\Facades\App::getLocale() == 'en')
                                            {!! $nav['name'] !!}
                                        @else
                                            {!! $nav['name_dt'] !!}
                                        @endif
                                    @endif
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    @foreach($nav['children'] as $subNav)
                                        @if ($user->can($subNav['permission']))
                                            @if(empty($subNav['children']))
                                                <li>
                                                    <a href="{!! $subNav['url'] !!}">
                                                        <i style="font-size: 12px" class="fas {!! $subNav['icon'] !!}"></i>
                                                        @if(\Illuminate\Support\Facades\App::getLocale() == 'en')
                                                            {!! $subNav['name'] !!}
                                                        @else
                                                            {!! $subNav['name_dt'] !!}
                                                        @endif
                                                    </a>
                                                </li>
                                            @else
                                                <li>
                                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                                        <i style="font-size: 12px" class="fas {!! $subNav['icon'] !!}"></i>
                                                        <span>
                                                            @if(\Illuminate\Support\Facades\App::getLocale() == 'en')
                                                                {!! $subNav['name'] !!}
                                                            @else
                                                                {!! $subNav['name_dt'] !!}
                                                            @endif
                                                        </span>
                                                    </a>
                                                    <ul class="sub-menu" aria-expanded="true">
                                                        @foreach($subNav['children'] as $superSubNav)
                                                            @if ($user->can($superSubNav['permission']))
                                                                <li>
                                                                    <a href="{!! $superSubNav['url'] !!}">
                                                                        <i style="font-size: 12px" class="fas {!! $superSubNav['icon'] !!}"></i>
                                                                        @if(\Illuminate\Support\Facades\App::getLocale() == 'en')
                                                                            {!! $superSubNav['name'] !!}
                                                                        @else
                                                                            {!! $superSubNav['name_dt'] !!}
                                                                        @endif
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endif
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    @endif
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>