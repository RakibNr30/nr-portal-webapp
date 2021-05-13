@php
$user = \Modules\Ums\Entities\User::find(auth()->user()->id);
@endphp

@if($data->status == 0)
    <span class="badge badge-soft-warning font-size-12">
        {{ __('admin/my_project/index.pending') }}
    </span>
@endif
@if($data->status == 1)
    <span class="badge badge-soft-info font-size-12">
        @if($user->hasRole('company'))
            {{ __('admin/my_project/index.assigned') }}
        @else
            {{ __('admin/my_project/index.in_progress') }}
        @endif
    </span>
@endif
@if($data->status == 2)
    <span class="badge badge-soft-success font-size-12">
        @if($user->hasRole('company'))
            {{ __('admin/my_project/index.in_progress') }}
        @else
            {{ __('admin/my_project/index.accepted') }}
        @endif
    </span>
@endif