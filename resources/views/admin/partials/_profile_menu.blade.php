@php
    $user = \Modules\Ums\Entities\User::find(auth()->user()->id);
@endphp
<div class="profile-widgets py-3">
    <div class="text-center">
        <div class="">
            <img src="{{ $user->avatar->file_url ?? config('core.image.default.avatar') }}" alt="" class="avatar-lg mx-auto img-thumbnail rounded-circle">
            <div class="online-circle"><i class="fas fa-circle text-success"></i></div>
        </div>
        <div class="mt-3 ">
            <a href="{{ url('/backend/profile/account-info') }}" class="text-dark font-weight-medium font-size-16">
                {{ $user->basicInfo->first_name }} {{ $user->basicInfo->last_name }}
            </a>
            <p class="text-body mt-1 mb-1">{{ $user->basicInfo->designation }}</p>
        </div>

        <div class="row mt-4 border border-left-0 border-right-0 p-3">
            <ul class="nav nav-pills flex-column" style="width: 100%">
                @foreach(json_decode(json_encode(config('core.profile_menu'))) as $profile_menu_key => $profile_menu)
                    <li class="nav-item {{ $profile_menu_key == ($active ?? '') ? 'bg-light' : '' }}">
                        <a href="{{ $profile_menu->url }}" class="nav-link"
                           style="padding: 10px; font-size: 14px; color: #212543;">
                            {{ $profile_menu->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>