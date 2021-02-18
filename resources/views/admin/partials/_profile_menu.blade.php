<div class="card card-gray-dark card-outline">
    <div class="card-body box-profile">
        @php
            $user = \Modules\Ums\Entities\User::find(auth()->user()->id);
        @endphp
        <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" style="height: 100px; width: 100px;"
                 src="{{ isset($user->avatar->file_url) ? $user->avatar->file_url : 'https://via.placeholder.com/128x128.jpg?text=' . $user->username}}" alt="{{ $user->username }}">
        </div>
        <h3 class="profile-username text-center">{{ $user->personalInfo->first_name }} {{ $user->personalInfo->last_name }}</h3>
        <p class="text-muted text-center">{{ $user->personalInfo->designation }}</p>
        <ul class="nav nav-pills flex-column">
            @foreach(json_decode(json_encode(config('core.profile_menu'))) as $profile_menu_key => $profile_menu)
                <li class="nav-item {{ $profile_menu_key == ($active ?? '') ? 'bg-light' : '' }}">
                    <a href="{{ $profile_menu->url }}" class="nav-link"
                       style="padding: 10px; font-size: 16px; color: #212543;">
                        {{ $profile_menu->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
