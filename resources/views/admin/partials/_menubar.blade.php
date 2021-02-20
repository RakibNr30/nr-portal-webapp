<div class="vertical-menu">
    <div class="h-100">
        @if (auth()->check())
            @php
                $user = \Modules\Ums\Entities\User::find(auth()->user()->id);
            @endphp
        <div class="user-wid text-center py-4">
            <div class="user-img">
                <img src="{{ asset('admin/images/users/avatar-2.jpg') }}" alt="" class="avatar-md mx-auto rounded-circle">
            </div>
            <div class="mt-3">
                <a href="#" class="text-dark font-weight-medium font-size-16">
                    {{ $user->basicInfo->first_name }} {{ $user->basicInfo->last_name }}
                </a>
                <p class="text-body mt-1 mb-0 font-size-13">{{ $user->basicInfo->designation }}</p>
            </div>
        </div>

        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                @foreach(config('core.admin_menu') as $nav)
                    @if ($user->can($nav['permission']))
                        @if(empty($nav['children']))
                            <li>
                                <a href="{{ $nav['url'] }}" class=" waves-effect">
                                    <i class="fas {{ $nav['icon'] }}"></i>
                                    <span>{{ $nav['name'] }}</span>
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="fas {{ $nav['icon'] }}"></i>
                                    <span>{{ $nav['name'] }}</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    @foreach($nav['children'] as $subNav)
                                        <li>
                                            <a href="{{ $subNav['url'] }}">
                                                <i style="font-size: 12px" class="fas {{ $subNav['icon'] }}"></i>
                                                {{ $subNav['name'] }}
                                            </a>
                                        </li>
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