@php
$user = \Modules\Ums\Entities\User::find(auth()->user()->id);
@endphp

@if($data->status == 0)
    <span class="badge badge-soft-warning font-size-12">
        {{ 'Pending' }}
    </span>
@endif
@if($data->status == 1)
    <span class="badge badge-soft-info font-size-12">
        @if($user->hasRole('company'))
            {{ 'Assigned' }}
        @else
            {{ 'In Progress' }}
        @endif
    </span>
@endif
@if($data->status == 2)
    <span class="badge badge-soft-success font-size-12">
        @if($user->hasRole('company'))
            {{ 'In Progress' }}
        @else
            {{ 'Accepted' }}
        @endif
    </span>
@endif